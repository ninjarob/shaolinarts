<?php
App::uses('AppController', 'Controller');
class UsersController extends AppController {
    public $uses = array('User', 'Role', 'Studio', 'UserRoleStudio');
    public $helpers = array('User','Js' => array('Jquery'));
    public $paginate = array(
        'limit' => 25,
            'conditions' => array('status' => '1'),
            'order' => array('User.email' => 'asc' )
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','add','logout');
        $this->layout = 'user';
    }

    public function isAuthorized($user) {
        $userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$user['id'])));
        if (count($userRoleStudio)>0) {
            if (in_array($this->action, array('user_home', 'change_info', 'learn', 'play', 'train'))) {
                return true;
            }
            if (in_array($this->action, array('user_management', 'edit', 'delete', 'add_role'))) {
                $userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$user['id'], 'role_id in'=>array(1, 3, 4, 5))));
                if (count($userRoleStudio)>0) {
                    return true;
                }
            }
        }
        return parent::isAuthorized($user);
    }

    public function login() {
        //if already logged-in, redirect
        if($this->Session->check('Auth.User')){
            $this->redirect(array('action' => 'user_home'));
        }
        // if we get the post information, try to authenticate
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$this->Auth->user('id'))));
                //if they have any roles, send them to the welcome
                if (count($userRoleStudio)>0) {
                    $this->Session->setFlash(__('Welcome, '. $this->Auth->user('email')));
                    $this->redirect($this->Auth->redirectUrl());
                }
                //otherwise log them back out.  They've got to have roles first.
                else {
                    $this->Session->setFlash(__('There was a problem processing your login.  You may not yet have rights to access the ShaolinArts user pages'));
                    $this->redirect(array('action' => 'logout'));
                }
            } else {
                $this->Session->setFlash(__('Invalid email or password'));
                $this->log($this->Auth->ValidationErrors());
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function user_management() {
        $this->layout = 'user_admin';

        $fnameFilter = "";
        $lnameFilter = "";
        $mroleFilter = "";
        $kfroleFilter = "";
        $tcroleFilter = "";
        $studioFilter = "";

        if (isset($this->params['data']['User'])) {
            $fnameFilter = $this->params['data']['User']['fnfilter'];
            $lnameFilter = $this->params['data']['User']['lnfilter'];
            $mroleFilter = $this->params['data']['User']['mrfilter'];
            $kfroleFilter = $this->params['data']['User']['kfrfilter'];
            $tcroleFilter = $this->params['data']['User']['tcrfilter'];
            $studioFilter = $this->params['data']['User']['sfilter'];
            $this->set('fnfilter', $fnameFilter);
            $this->set('lnfilter', $lnameFilter);
            $this->set('mrfilter', $mroleFilter);
            $this->set('kfrfilter', $kfroleFilter);
            $this->set('tcrfilter', $tcroleFilter);
            $this->set('sfilter', $studioFilter);
        }

        $roleData = $this->Role->find('list', array('fields' => array('id', 'name'),'order'=>'id ASC'));
        $studioData = $this->Studio->find('list', array('fields' => array('id', 'name'),'order'=>'id ASC'));
        $this->set('roles', $roleData);
        $this->set('studios', $studioData);
        $this->User->Behaviors->load('Containable');
        $conditions = $this->setupConditions($fnameFilter, $lnameFilter, $mroleFilter, $kfroleFilter, $tcroleFilter, $studioFilter);
        $this->paginate = array(
            'limit' => 25,
            'joins' =>  array(
                array(
                  'table' => 'user_role_studios',
                  'alias' => 'UserRoleStudio',
                  'type' => 'left',
                  'conditions' => array(
                      'UserRoleStudio.user_id = User.id'
                   )
                 )
             ),
            'contain' => array('UserRoleStudio','UserInfo'),
            'order' => array('UserInfo.fname' => 'asc' ),
            'group' => 'User.id',
            'conditions' => $conditions
        );
        $users = $this->paginate('User');
        $this->set(compact('users'));
    }

    private function setupConditions($fnameFilter, $lnameFilter, $mroleFilter, $kfroleFilter, $tcroleFilter, $studioFilter) {
        $loggedInUserURS = $this->UserRoleStudio->find('all', array('conditions'=>array('user_id'=>$this->Auth->user('id'))));
        $conditions = array("UserRoleStudio.studio_id in (".$this->getStudioViewRights($loggedInUserURS).")");
        if (!empty($fnameFilter)) {
            $conditions[]="UserInfo.fname like '%".$fnameFilter."%'";
        }
        if (!empty($lnameFilter)) {
            $conditions[]="UserInfo.lname like '%".$lnameFilter."%'";
        }
        if (!empty($mroleFilter)) {
            $conditions[]="UserRoleStudio.role_id = ".$mroleFilter;
        }
        if (!empty($kfroleFilter)) {
            $conditions[]="UserRoleStudio.role_id = ".$kfroleFilter;
        }
        if (!empty($tcroleFilter)) {
            $conditions[]="UserRoleStudio.role_id = ".$tcroleFilter;
        }
        if (!empty($studioFilter)) {
            $conditions[]="UserRoleStudio.studio_id = ".$studioFilter;
        }
        return $conditions;
    }

    public function user_home() {}
    public function change_info() {}
    public function learn() {}
    public function play() {}
    public function train() {}

    public function add() {
        $this->layout = 'user_admin';
        $roleData = $this->Role->find('list', array('fields' => array('id', 'name'),'order'=>'id ASC'));
        $studioData = $this->Studio->find('list', array('fields' => array('id', 'name'),'order'=>'id ASC'));
        $this->set('roles', $roleData);
        $this->set('studios', $studioData);

        if ($this->request->is('post')) {
            $this->User->create();
            if (in_array('KungFuRank', $this->request->data) && "0" === $this->request->data['KungFuRank']['id']) {
                $this->request->data['KungFuRank'] = null;
            }
            if (in_array('TaiChiRank', $this->request->data) && "0" === $this->request->data['TaiChiRank']['id']) {
                $this->request->data['TaiChiRank'] = null;
            }
            if ($this->User->saveAll($this->request->data)) {
                $this->Session->setFlash(__('The user has been created'));
                if($this->Session->check('Auth.User')){
                    $this->redirect(array('action' => 'add'));
                }
                else {
                    $this->redirect(array('action' => 'login'));
                }
            } else {
                $this->Session->setFlash(__('The user could not be created. Please, try again.'));
            }
        }
    }

    public function edit($id = null) {
        $this->layout = 'user_admin';
        if (!$id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }
        $user = $this->User->findById($id);
        if (!$user) {
            $this->Session->setFlash('Invalid User ID Provided');
            $this->redirect(array('action'=>'index'));
        }

        $roleData = $this->Role->find('list', array('fields' => array('id', 'name'),'order'=>'id ASC'));
        $studioData = $this->Studio->find('list', array('fields' => array('id', 'name'),'order'=>'id ASC'));
        $this->set('roles', $roleData);
        $this->set('studios', $studioData);

        $userRoleInfo = $this->UserRoleStudio->find('all', array('conditions'=>array('user_id'=>$user['User']['id'])));
        $this->set("userRoleInfo", $userRoleInfo);
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->User->id = $id;
            if ($user['User']['email'] == $this->request->data['User']['email']) {
                unset($this->request->data['User']['email']);
            }
            if ($this->User->saveAll($this->request->data)) {
                $this->Session->setFlash(__('The user has been updated'));
                $this->redirect(array('action' => 'edit', $id));
            }else{
                $this->Session->setFlash(__('Unable to update your user.'));
            }
        }
        if (!$this->request->data) {
            $this->request->data = $user;
        }
    }

    public function add_role() {
         if ($this->request->is('ajax')) {
             $roleData = $this->Role->find('list', array('fields' => array('id', 'name'),'order'=>'id ASC'));
             $studioData = $this->Studio->find('list', array('fields' => array('id', 'name'),'order'=>'id ASC'));
             $this->set('roles', $roleData);
             $this->set('studios', $studioData);
             $user = $this->User->findById($id);
             $userRoleInfo = $this->UserRoleStudio->find('all', array('conditions'=>array('user_id'=>$user['User']['id'])));
             $this->set("userRoleInfo", $userRoleInfo);
            // Use data from serialized form
            // print_r($this->request->data['Contacts']); // name, email, message
             $this->render('user-role-ajax-response', 'ajax'); // Render the contact-ajax-response view in the ajax layout
         }
    }

    public function delete($id = null) {

        if (!$id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }

        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('status', 0)) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function activate($id = null) {

        if (!$id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }

        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('status', 1)) {
            $this->Session->setFlash(__('User re-activated'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not re-activated'));
        $this->redirect(array('action' => 'index'));
    }

    private function getStudioViewRights($userRoleStudios) {
        $studios = "";
        if (count($userRoleStudios) >= 1) {
            foreach ($userRoleStudios as $urs) {
                //catch admin
                if ($urs['UserRoleStudio']['role_id'] == 5) return "1,2,3";
                $studios = $studios.$urs['UserRoleStudio']['studio_id'].',';
            }
            $studios = rtrim($studios, ',');
        }
        else {
            if ($userRoleStudios['UserRoleStudio']['role_id'] == 5) return "1,2,3";
            $studios = $userRoleStudios['UserRoleStudio']['studio_id'];
        }
        return trim($studios);
    }

    // creates a ticket and sends an email
    public function send()
    {
        if (!empty($this->params['data']))
        {
            $theUser = $this->User->findByEmail($this->params['data']['User']['email']);

            if(is_array($theUser) && is_array($theUser['User']))
            {
                $ticket = $this->Tickets->set($theUser['User']['email']);

                $to      = $theUser['User']['email']; // users email
                $subject = utf8_decode('Password reset information');
                $message = 'http://'.$_SERVER['SERVER_NAME'].'/'.$this->params['controller'].'/password/'.$ticket;
                $from    = 'noreply@shaolinarts.com';
                $headers = 'From: ' . $from . "\r\n" .
                   'Reply-To: ' . $from . "\r\n" .
                   'X-Mailer: CakePHP PHP ' . phpversion(). "\r\n" .
                   'Content-Type: text/plain; charset=ISO-8859-1';

                if(mail($to, $subject, utf8_decode( sprintf($this->Lang->show('recover_email'), $message) ."\r\n"."\r\n" ), $headers))
                {
                    $this->set('message', 'A recovery email was sent. Check your inbox.');
                } else {
                    // internal error, sorry
                    $this->set('message', 'Server error, please try again later.');
                }
            }else{
                // no user found for address
                $this->set('message', 'No user with that email address');
            }
        }
    }

    // uses the ticket to reset the password for the correct user.
    public function password($hash = null)
    {
        if ( $email = $this->Tickets->get($this->params['controller'], $hash) )
        {
            $authUser = $this->User->findByEmail($email);
            if (is_array($authUser))
            {
                if (!empty($this->params['data']))
                {
                    $theUser = $this->User->findById($this->params['data']['User']['id']);

                    if ($this->User->save($this->params['data']))
                    {
                        $this->set('message', 'Your new password was saved.');
                    }else{
                        $this->set('message', 'User could not be saved');
                    }
                    $this->Tickets->del($hash);
                    $this->redirect( '/' );
                }
                unset($authUser['User']['pass']);
                $this->params['data'] = $authUser;
                $this->render();
                return;
            }
        }
        $this->Tickets->del($hash);
        $this->set('message', 'No hash provided');
        $this->redirect('/');
    }

}
?>