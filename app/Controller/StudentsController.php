<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'PhpMailer', array('file' => 'phpmailer' . DS . 'PHPMailerAutoload.php'));
/**
 * Manuals Controller
 *
 * @property Manual $Manual
 * @property PaginatorComponent $Paginator
 */
class StudentsController extends AppController {
    public $uses = array('Manual', 'User', 'Role', 'Studio', 'UserRoleStudio', 'SystemProperty');
    public $helpers = array('User','Js' => array('Jquery'));
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('sendContactMessage');
        $this->layout = 'user';
    }

    public function isAuthorized($user) {
        $userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$user['id'])));
        if (count($userRoleStudio)>0) {
            if (in_array($this->action, array('learn', 'play', 'train', 'record'))) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }

    public function learn() {
        $manuals = $this->getManualsWithAccess($this->Auth->user('id'));
        $this->set('manuals', $manuals);
    }

    public function play() {}
    public function train() {}
    public function record() {}
    public function extra() {}

    public function sendContactMessage() {
        $contactUsEmail  = $this->SystemProperty->findByName("contact_us_email")['SystemProperty']['value'];
        $this->sendEmail($contactUsEmail, "Contact Form: ".$this->request->data['Contact']['subject'], $this->request->data['Contact']['body']);
        $this->Session->setFlash(__("Thankyou."), 'default', array('class'=>'flashmsg'));
        $this->redirect(array('controller'=>'pages', 'action' => 'contactUs'));
    }
}