<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'PhpMailer', array('file' => 'phpmailer' . DS . 'PHPMailerAutoload.php'));
class UsersController extends AppController {
    public $uses = array('User', 'UserInfo', 'Role', 'Studio', 'UserRoleStudio', 'Status', 'Ticket');
    //var $components = array('Email'); //  use component email

    public $helpers = array('User','Js' => array('Jquery'));
    public $paginate = array(
        'limit' => 25,
            'conditions' => array('status' => '1'),
            'order' => array('User.email' => 'asc')
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','add','logout');
        $this->layout = 'user';
    }

    public function isAuthorized($user) {
        $userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$user['id'])));
        if (count($userRoleStudio)>0) {
            if (in_array($this->action, array('user_home', 'change_info', 'learn', 'play', 'train', 'extra'))) {
                return true;
            }
            if (in_array($this->action, array('user_management', 'edit', 'delete', 'ajax_add_role', 'ajax_delete_role', 'activate', 'disable'))) {
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
                    $this->Session->setFlash(__('Welcome, '. $this->Auth->user('email')), 'default', array('class'=>'flashmsg'));
                    $this->redirect($this->Auth->redirectUrl());
                }
                //otherwise log them back out.  They've got to have roles first.
                else {
                    $this->Session->setFlash(__('There was a problem processing your login.  You may not yet have rights to access the ShaolinArts user pages'), 'default', array('class'=>'flasherrormsg'));
                    $this->redirect(array('action' => 'logout'));
                }
            } else {
                $this->Session->setFlash(__('Invalid email or password'), 'default', array('class'=>'flasherrormsg'));
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
        $statusFilter = "";

        if (isset($this->params['data']['User'])) {
            $fnameFilter = $this->params['data']['User']['fnfilter'];
            $lnameFilter = $this->params['data']['User']['lnfilter'];
            $mroleFilter = $this->params['data']['User']['mrfilter'];
            $kfroleFilter = $this->params['data']['User']['kfrfilter'];
            $tcroleFilter = $this->params['data']['User']['tcrfilter'];
            $studioFilter = $this->params['data']['User']['sfilter'];
            $statusFilter = $this->params['data']['User']['statfilter'];
            $this->set('fnfilter', $fnameFilter);
            $this->set('lnfilter', $lnameFilter);
            $this->set('mrfilter', $mroleFilter);
            $this->set('kfrfilter', $kfroleFilter);
            $this->set('tcrfilter', $tcroleFilter);
            $this->set('sfilter', $studioFilter);
            $this->set('statusfilter', $statusFilter);
        }

        $roles = $this->Role->find('list', array('fields' => array('id', 'name'),'order'=>'id ASC'));
        $mrRoleData = $this->Role->find('list', array('fields' => array('id', 'name'),'conditions'=>array('role_type_id'=>1),'order'=>'id ASC'));
        $kfRoleData = $this->Role->find('list', array('fields' => array('id', 'name'),'conditions'=>array('role_type_id in (2,3,4,8,9)'),'order'=>'id ASC'));
        $tcRoleData = $this->Role->find('list', array('fields' => array('id', 'name'),'conditions'=>array('role_type_id in (5,6,7,10,11)'),'order'=>'id ASC'));
        $studioData = $this->Studio->find('list', array('fields' => array('id', 'name'), 'order'=>'id ASC'));
        $statusData = $this->Status->find('list', array('fields' => array('id', 'name'), 'order'=>'id ASC'));

        $this->set('mrroles', $mrRoleData);
        $this->set('kfroles', $kfRoleData);
        $this->set('tcroles', $tcRoleData);
        $this->set('roles', $roles);
        $this->set('studios', $studioData);
        $this->set('statuses', $statusData);
        $this->User->Behaviors->load('Containable');
        $conditions = $this->setupUserSearchConditions($fnameFilter, $lnameFilter, $mroleFilter, $kfroleFilter, $tcroleFilter, $studioFilter, $statusFilter);
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
            'contain' => array('UserRoleStudio','UserInfo','Status'),
            'order' => array('UserInfo.fname' => 'asc' ),
            'group' => 'User.id',
            'conditions' => $conditions
        );
        $users = $this->paginate('User');
        $this->set(compact('users'));
    }

    public function user_home() {}
    public function change_info() {}
    public function learn() {}
    public function play() {}
    public function train() {}
    public function extra() {}

    public function add() {
        if($this->Session->check('Auth.User')){
            $this->layout = 'user_admin';
        }
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
            //roles get saved too, so this is tricky.
            if ($this->User->saveAll($this->request->data)) {
                //checking admin rights
                if($this->Session->check('Auth.User')){
                    $userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id'), 'role_id in'=>array(1, 3, 4, 5))));
                    if (count($userRoleStudio)>0) { //give role selected by manager
                        $newId = $this->User->id;
                        $ursData = array('User'=>array('id'=>$newId), 'Role'=>array('id'=>$this->request->data['Role']['id']), 'Studio'=>array('id'=>$this->request->data['Studio']['id']));
                        if ($this->UserRoleStudio->saveAll($ursData)) {
                            $this->setFlashAndRedirect(Configure::read('User.adminSuccessfullyRegistered'), 'add', false);
                        }
                        else {
                            $this->rollBackAddUser();
                            $this->setFlashAndRedirect(Configure::read('User.failedRegistration'), 'add');
                        }
                    }
                }
                else {
                    $newId = $this->User->id;
                    $ursData = array('User'=>array('id'=>$newId), 'Role'=>array('id'=>6), 'Studio'=>array('id'=>2));
                    if ($this->UserRoleStudio->saveAll($ursData)) {
                        //send email
                        $mailSent = $this->sendEmailForNewUser($this->User->id);
                        if ($mailSent) {
                            $this->setFlashAndRedirect(Configure::read('User.successfullyRegistered'), 'login', false);
                        }
                        else {
                            $this->rollBackAddUser();
                            $this->setFlashAndRedirect(Configure::read('User.failedRegistration'), 'login');
                        }
                    }
                    else {
                        $this->rollBackAddUser();
                        $this->setFlashAndRedirect(Configure::read('User.failedRegistration'), 'login');
                    }
                }
            } else {
                if (!empty($this->User->validationErrors))
                {
                    $this->setFlashAndRedirect(Configure::read('User.failedRegistrationWithVE'));
                }
                else {
                    $this->setFlashAndRedirect(Configure::read('User.failedRegistration'));
                }
            }
        }
    }

    public function edit($id = null) {
        $this->layout = 'user_admin';
        $roleData = $this->Role->find('list', array('fields' => array('id', 'name'),'order'=>'id ASC'));
        $studioData = $this->Studio->find('list', array('fields' => array('id', 'name'),'order'=>'id ASC'));
        $this->set('roles', $roleData);
        $this->set('studios', $studioData);

        $user = $this->userIdProblems($id);

        $userRoleInfo = $this->UserRoleStudio->find('all', array('conditions'=>array('user_id'=>$user['User']['id'])));
        $this->set("userRoleInfo", $userRoleInfo);

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->User->id = $id;
            if ($user['User']['email'] == $this->request->data['User']['email']) {
                unset($this->request->data['User']['email']);
            }
            if ($this->User->saveAll($this->request->data)) {
                $this->setFlashAndRedirect(Configure::read('User.editSuccess'), null, false);
                $this->redirect(array('action' => 'edit', $id));
            }else{
                $this->setFlashAndRedirect(Configure::read('User.editFailed'));
                $this->redirect(array('action' => 'edit', $id));
            }
        }
        if (!$this->request->data) {
            $this->request->data = $user;
        }
    }

    public function ajax_add_role() {
        if ($this->request->is('ajax')) {
            if (!$this->UserRoleStudio->saveAll($this->request->data)) {
                if (isset($this->UserRoleStudio->validationErrors['unique'])) {
                    $this->setFlashAndRedirect(Configure::read('User.ajaxAddRoleFailedExisting'));
                }
                else {
                    $this->setFlashAndRedirect(Configure::read('User.ajaxAddRoleFailedWithVE'));
                }
            }
            $roleData = $this->Role->find('list', array('fields' => array('id', 'name'),'order'=>'id ASC'));
            $studioData = $this->Studio->find('list', array('fields' => array('id', 'name'),'order'=>'id ASC'));
            $this->set('roles', $roleData);
            $this->set('studios', $studioData);
            $userRoleInfo = $this->UserRoleStudio->find('all', array('conditions'=>array('user_id'=>$this->request->data['User']['id']), 'recursive'=>1));
            $this->set("userRoleInfo", $userRoleInfo);
            $this->render('user-role-ajax-response', 'ajax');
        }
    }

    public function delete($id = null) {
        $this->layout = 'user_admin';
        $this->userIdProblems($id);
        $this->User->id = $id;
        if ($this->User->delete($id, true)) {
            $this->setFlashAndRedirect('User successfully deleted', null, false);
        }
        else {
            $this->Session->setFlash('Invalid user id provided', 'default', array('class'=>'flasherrormsg'));
        }
        $this->redirect(array('action' => 'user_management'));
    }

    public function activate($id = null) {
        $this->layout = 'user_admin';
        $this->userIdProblems($id);
        $this->User->id = $id;
        if ($this->User->saveField('status_id', 3)) {
            $this->setFlashAndRedirect('User re-activated', null, false);
        }
        else {
            $this->Session->setFlash('Invalid user id provided', 'default', array('class'=>'flasherrormsg'));
        }
        $this->redirect(array('action' => 'user_management'));
    }

    public function disable($id = null) {
        $this->layout = 'user_admin';
        $this->userIdProblems($id);
        $this->User->id = $id;
        if ($this->User->saveField('status_id', 4)) {
            $this->setFlashAndRedirect('User successfully disabled', null, false);
        }
        else {
            $this->Session->setFlash('Invalid user id provided', 'default', array('class'=>'flasherrormsg'));
        }
        $this->redirect(array('action' => 'user_management'));
    }

    public function userRegisterConfirm() {
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

    // creates a ticket and sends an email
    public function sendEmailForPasswordRenewal()
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


    /***********************************
    *   PRIVATE UTILITY FUNCTIONS
    ************************************/
    // creates a ticket and sends an email
    private function sendEmailForNewUser($userId)
    {
        $user = $this->User->findById($userId);
//        $ticket = $this->Ticket->set($user['User']['email']);
//        $to      = $user['User']['email']; // users email
//        $subject = utf8_decode('New User Registration');
//        $this->log($_SERVER['SERVER_NAME']);
//        $message = 'http://'.$_SERVER['SERVER_NAME'].'/users/userRegisterConfirm/'.$ticket;
//        //$from    = 'noreply@shaolinarts.com';
//        $from    = 'robatmywork@gmail.com';
//        $headers = 'From: ' . $from . "\r\n" .
//           'Reply-To: ' . $from . "\r\n" .
//           'X-Mailer: CakePHP PHP ' . phpversion(). "\r\n" .
//           'Content-Type: text/plain; charset=ISO-8859-1';


        $mail = new PHPMailer(true);

        //Send mail using gmail
        if(true){
            $mail->IsSMTP(); // telling the class to use SMTP
            $mail->SMTPAuth = true; // enable SMTP authentication
            $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
            $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
            $mail->Port = 465; // set the SMTP port for the GMAIL server
            $mail->Username = "shaolinartsemailpta@gmail.com"; // GMAIL username
            $mail->Password = "KungFuPanda"; // GMAIL password
        }
        $this->log($user['User']['email']);
        //Typical mail data
        $mail->AddAddress($user['User']['email']);
        $mail->SetFrom("shaolinartsemailpta@gmail.com", "Robert Kevan");
        $mail->Subject = "My Subject";
        $mail->Body = "Mail contents";

        try{
            $mail->Send();
            echo "Success!";
        } catch(Exception $e){
            //Something went bad
            $this->log($mail);
        }



        //if(mail($to, $subject, utf8_decode($message ."\r\n"."\r\n" ), $headers))
        //{

        //} else {

        //}
    }

    private function setupUserSearchConditions($fnameFilter, $lnameFilter, $mroleFilter, $kfroleFilter, $tcroleFilter, $studioFilter, $statusFilter) {
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
        if (!empty($statusFilter)) {
            $conditions[]="status_id = ".$statusFilter;
        }
        return $conditions;
    }

    private function rollBackAddUser() {
        $this->UserInfo->deleteAll(array('user_id'=>$this->User->id), false);
        $this->UserRoleStudio->deleteAll(array('user_id'=>$this->User->id), false);
        $this->User->delete($this->User->id);
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

    private function setFlashAndRedirect($flashMessage, $redirectAction=null, $errorFlag=true) {
        $this->Session->setFlash(__($flashMessage), 'default', array('class'=>$errorFlag?'flasherrormsg':'flashmsg'));
        if ($redirectAction != null) {
            $this->log($redirectAction);
            $this->redirect(array('action' => $redirectAction));
        }
    }

    private function userIdProblems($id) {
        if (!$id) {
            $this->setFlashAndRedirect(Configure::read('User.missingUserId'), 'user_management');
        }
        $user = $this->User->findById($id);
        if (!$user) {
            $this->setFlashAndRedirect(Configure::read('User.invalidUserId'), 'user_management');
        }
        return $user;
    }

    /****************************
    *   AJAX FUNCTIONS
    *****************************/
    public function ajax_delete_role($id=null) {
        // set default class & message for setFlash
        $class = 'flash_bad';
        $msg   = 'Invalid List Id';

        // check id is valid
        if($id!=null && is_numeric($id)) {
            // get the Item
            $usr = $this->UserRoleStudio->findById($id);
            // check Item is valid
            if(!empty($usr)) {
                // try deleting the item
                if($this->UserRoleStudio->delete($id)) {
                    $class = 'flashmsg';
                    $msg   = 'Role deleted';
                } else {
                    $msg = 'There was a problem deleting your Item, please try again';
                }
            }
        }

        // output JSON on AJAX request
        if($this->request->is('ajax')) {
            $this->autoRender = $this->layout = false;
            echo json_encode(array('success'=>($class=='flasherrormsg') ? FALSE : TRUE));
            exit;
        }

        // set flash message & redirect
        $this->Session->setFlash($msg,'default',array('class'=>$class));
        $this->redirect(array('action'=>'index'));
    }
}
?>