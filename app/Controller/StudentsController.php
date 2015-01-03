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
    public $uses = array('Manual', 'User', 'Role', 'Studio', 'UserRoleStudio');
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

        //Typical mail data
        //$mail->AddAddress('sandystudio@shaolinarts.com');
        $mail->AddAddress('robatmywork@gmail.com');
        $mail->SetFrom("shaolinartsemailpta@gmail.com", "Robert Kevan");
        $mail->Subject = "Contact Form: ".$this->request->data['Contact']['subject'];
        $mail->Body = $this->request->data['Contact']['body'];
        try{
            $mail->Send();
            $this->Session->setFlash(__("Thankyou."), 'default', array('class'=>'flashmsg'));
            $this->redirect(array('controller'=>'pages', 'action' => 'contactUs'));
        } catch(Exception $e){
            //Something went bad
            $this->log("There was a problem sending the contact email: ".$mail);
            $this->log($e);
        }
        $this->Session->setFlash(__("Thankyou."), 'default', array('class'=>'flashmsg'));
        $this->redirect(array('controller'=>'pages', 'action' => 'contactUs'));
    }

}
