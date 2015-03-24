<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'PhpMailer', array('file' => 'phpmailer' . DS . 'PHPMailerAutoload.php'));
App::import('Helper', 'UserHelper');
class UsersController extends AppController {
    public $uses = array('User', 'UserInfo', 'Role', 'Studio', 'UserRoleStudio', 'Status', 'Ticket', 'Manual', 'SystemProperty', 'CommonEmailMessage', 'Photo', 'KungFuRank', 'TaiChiRank');
    var $components = array('Tickets'); //  use component email

    public $helpers = array('User','Js' => array('Jquery'));
    public $paginate = array(
        'limit' => 25,
            'conditions' => array('status' => '1'),
            'order' => array('User.email' => 'asc')
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','add','logout', 'forgot_password', 'password_reset', 'resendEmailForNewUser','userRegisterConfirm', 'sendEmailForPasswordRenewal');
        $this->layout = 'user';
    }

    public function isAuthorized($user) {
        if (in_array($this->action, array('user_home', 'account', 'extra'))) {
            return true;
        }
        $userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$user['id'])));
        if (count($userRoleStudio)>0) {
            if (in_array($this->action, array('learn', 'play', 'train', 'record', 'account'))) {
                return true;
            }
            $userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$user['id'], 'role_id = 5')));
            if (count($userRoleStudio)>0 && in_array($this->action, array('user_management', 'edit', 'delete', 'ajax_add_role', 'ajax_delete_role', 'activate', 'disable'))) {
                return true;
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
                //$userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$this->Auth->user('id'))));
                $user = $this->User->find('first', array('conditions'=>array('User.id'=>$this->Auth->user('id'))));
                //if they have any roles, send them to the welcome
                if (/*count($userRoleStudio)>0 && */$user['User']['status_id'] > 1 && $user['User']['status_id'] != 4) {
                    $this->Session->setFlash(__('Welcome, '. $this->Auth->user('email')), 'default', array('class'=>'flashmsg'));
                    $this->redirect($this->Auth->redirectUrl());
                }
                //otherwise log them back out.  They've got to have roles first.
                else {
                    if ($user['User']['status_id'] == 1) {
                        $resendLink = ' <a href="resendEmailForNewUser/'.$this->Auth->user('id').'" style="font-size:10px;">(Resend Email)</a>';
                        $this->Auth->logout();
                        $this->setFlashAndRedirect(Configure::read('User.loginFailedEmailReg'), 'login', true, $resendLink);
                    }
                    else {
                        $this->Auth->logout();
                        $this->setFlashAndRedirect(Configure::read('User.loginFailed'), 'login', true);
                    }
                }
            } else {
                $this->setFlashAndRedirect(Configure::read('User.loginInvalid'), 'login', true);
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
        $mrRoleData = $this->Role->find('list', array('fields' => array('id', 'name'),/*'conditions'=>array('id in '),*/'order'=>'id ASC'));
        $kfRankData = $this->KungFuRank->find('list', array('fields' => array('id', 'name'),/*'conditions'=>array('role_type_id in (2,3,4,8,9)'),*/'order'=>'id ASC'));
        $tcRankData = $this->TaiChiRank->find('list', array('fields' => array('id', 'name'),/*'conditions'=>array('role_type_id in (5,6,7,10,11)'),*/'order'=>'id ASC'));
        $studioData = $this->Studio->find('list', array('fields' => array('id', 'name'), 'order'=>'id ASC'));
        $statusData = $this->Status->find('list', array('fields' => array('id', 'name'), 'order'=>'id ASC'));

        $this->set('mrroles', $mrRoleData);
        $this->set('kfranks', $kfRankData);
        $this->set('tcranks', $tcRankData);
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
            'contain' => array('UserRoleStudio','UserInfo','Status','KungFuRank','TaiChiRank'),
            'order' => array('UserInfo.fname' => 'asc' ),
            'group' => 'User.id',
            'conditions' => $conditions
        );
        $users = $this->paginate('User');
        $this->set(compact('users'));
    }

    public function user_home() {}
    public function extra() {}
    public function account() {
        $id = $this->Auth->user('id');
        $user = $this->userIdProblems($id);

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->User->id = $id;
            if ($user['User']['email'] == $this->request->data['User']['email']) {
                unset($this->request->data['User']['email']);
            }
            if ($this->User->saveAll($this->request->data)) {
                $this->setFlashAndRedirect(Configure::read('User.editSuccess'), null, false);
                $this->redirect(array('action' => 'account', $id));
            }else{
                $this->setFlashAndRedirect(Configure::read('User.editFailed'));
                $this->redirect(array('action' => 'account', $id));
            }
        }
        if (!$this->request->data) {
            $this->request->data = $user;
        }
    }

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
                    $mailSent = $this->sendEmailForNewUser($this->User->id);
                    if ($mailSent) {
                        $this->setFlashAndRedirect(Configure::read('User.successfullyRegistered'), 'login', false);
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
        $kungFuData = $this->KungFuRank->find('list', array('fields' => array('id', 'name'),'order'=>'id ASC'));
        $taiChiData = $this->TaiChiRank->find('list', array('fields' => array('id', 'name'),'order'=>'id ASC'));
        $this->set('roles', $roleData);
        $this->set('studios', $studioData);
        $this->set('kungFuRanks', $kungFuData);
        $this->set('taiChiRanks', $taiChiData);

        $user = $this->userIdProblems($id);

        $userRoleInfo = $this->UserRoleStudio->find('all', array('conditions'=>array('user_id'=>$user['User']['id'])));

        //Photo stuff
        $photo_id = $this->Photo->find('first', array('conditions'=>array('user_id'=>$id), 'fields' => array('id'),'order'=>'id ASC'));
        $this->set('photoId', null);
        if (isset($photo_id) && !empty($photo_id)) {
            $this->set('photoId', $photo_id['Photo']['id']);
        }

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
                $this->log($this->User->invalidFields());
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

    public function userRegisterConfirm($hash) {
        if ($email = $this->Tickets->get($hash) )
        {
            $authUser = $this->User->findByEmail($email);
            if (is_array($authUser))
            {
                $this->User->id = $authUser['User']['id'];
                if ($this->User->saveField('status_id', 3))
                {
                    $this->Tickets->del($hash);
                    $mailSent = $this->sendEmailToNotifyOfNewUser($email);
                    $this->setFlashAndRedirect(Configure::read('User.successfullyVerified'), 'login', false);
                }else{
                    $this->setFlashAndRedirect(Configure::read('User.confirmRegistrationFailed'), 'login', true);
                }
            }
        }
        $this->setFlashAndRedirect(Configure::read('User.confirmRegistrationFailed'), 'login', true);
    }

    public function forgot_password() {
        if ($this->request->is('post')) {
            if (is_array($this->params['data']))
            {
                $user = $this->User->findByEmail($this->params['data']['User']['email']);
                if(is_array($user) && is_array($user['User']))
                {
                    $ticket = $this->Tickets->set($user['User']['email']);
                    $messageLink = 'https://'.$_SERVER['HTTP_HOST'].$this->webroot.$this->params['controller'].'/password_reset/'.$ticket;
                    $cem = $this->CommonEmailMessage->findByName("reset_password_message");
                    $subject = $cem['CommonEmailMessage']['subject'];
                    $body = $cem['CommonEmailMessage']['body'];

                    $emailSent = $this->sendEmail($user['User']['email'], $subject, $body.' '.$messageLink);
                    if ($emailSent) {
                        $this->setFlashAndRedirect(Configure::read('User.passwordResetEmailSent'), 'login', false);
                    }
                    else {
                        $this->rollBackAddUser();
                        $this->setFlashAndRedirect(Configure::read('User.passwordResetEmailFailed'), 'login');
                    }
                }else{
                    // no user found for address
                    $this->setFlashAndRedirect(Configure::read('User.passwordResetNoUserWithThatEmailAddress'), 'forgot_password');
                }
            }
        }
    }

    // uses the ticket to reset the password for the correct user.
    public function password_reset($hash = null)
    {
        if ($email = $this->Tickets->get($hash))
        {
            $user = $this->User->findByEmail($email);
            if (is_array($user))
            {
                $this->set('hash', $hash);
                $this->set('id', $user['User']['id']);
                if (isset($this->params['data']['User']))
                {
                    if ($this->User->save($this->params['data']))
                    {
                        $this->Tickets->del($hash);
                        $this->setFlashAndRedirect(Configure::read('User.passwordResetSuccess'), 'login', false);
                    } else{

                    }
                }
            }
            else {
                $this->Tickets->del($hash);
                $this->setFlashAndRedirect(Configure::read('User.passwordResetErrorLoadingUser'), 'login');
            }
        }
        else {
            $this->Tickets->del($hash);
            $this->setFlashAndRedirect(Configure::read('User.passwordResetInvalidHash'), 'login');
        }
    }

    public function resendEmailForNewUser($userId) {
        $this->sendEmailForNewUser($userId);
        $this->redirect(array('action' => 'login'));
    }

    /***********************************
    *   PRIVATE UTILITY FUNCTIONS
    ************************************/
    // creates a ticket and sends an email
    private function sendEmailForNewUser($userId)
    {
        if (!$this->User->hasAny(array('User.id'=>$userId))) {
            $this->log("User doesn't exist. ");
            return false;
        }

        $user = $this->User->findById($userId);

        $ticket = $this->Tickets->set($user['User']['email']);
        $messageLink = 'https://'.$_SERVER['HTTP_HOST'].$this->webroot.$this->params['controller'].'/userRegisterConfirm/'.$ticket;
        $cem = $this->CommonEmailMessage->findByName("email_verification_message");
        $subject = $cem['CommonEmailMessage']['subject'];
        $body = $cem['CommonEmailMessage']['body'];

        return $this->sendEmail($user['User']['email'], $subject, $body.' '.$messageLink);

    }

    private function sendEmailToNotifyOfNewUser($email) {
        $new_user_notification_email = $this->SystemProperty->findByName("new_user_notification_email");
        $contactUsEmail  = $new_user_notification_email['SystemProperty']['value'];

        $cem = $this->CommonEmailMessage->findByName("new_user_notification_email");
        $subject = $cem['CommonEmailMessage']['subject'];
        $body = $cem['CommonEmailMessage']['body'];

        return $this->sendEmail($contactUsEmail, $subject, $body.' '.$email);
    }

    private function setupUserSearchConditions($fnameFilter, $lnameFilter, $mroleFilter, $kfroleFilter, $tcroleFilter, $studioFilter, $statusFilter) {
        $loggedInUserURS = $this->UserRoleStudio->find('all', array('conditions'=>array('user_id'=>$this->Auth->user('id'))));
        $viewStudioRights = $this->getStudioViewRights($loggedInUserURS);
        $conditions = array();
        if ($viewStudioRights != "admin") {
            $conditions = array("UserRoleStudio.studio_id in (".$viewStudioRights.")");
        }
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
            $conditions[]="KungFuRank.id = ".$kfroleFilter;
        }
        if (!empty($tcroleFilter)) {
            $conditions[]="TaiChiRank.id = ".$tcroleFilter;
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
                if ($urs['UserRoleStudio']['role_id'] == 5) return "admin";//"1,2,3";
                $studios = $studios.$urs['UserRoleStudio']['studio_id'].',';
            }
            $studios = rtrim($studios, ',');
        }
        else {
            if ($userRoleStudios['UserRoleStudio']['role_id'] == 5) return "admin";//"1,2,3";
            $studios = $userRoleStudios['UserRoleStudio']['studio_id'];
        }
        return trim($studios);
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