<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'users',
                'action' => 'user_home'
            ),
            'logoutRedirect' => array(
                'controller' => 'pages',
                'action' => 'display',
                'home'
            ),
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email')
                )
            ),
            'authorize' => array('Controller')
        )
    );

    public function isAuthorized($user) {
        // Admin can access every action

        if (isset($user['role_id']) && $user['role_id'] === 6) {
            return true;
        }

        // Default deny
        return false;
    }

    public function beforeFilter() {
        //$this->Auth->allow('index', 'view');
        $this->__checkSSL();
    }

    public $secureControllers = array('users','adminPages');

    /**
     * Check SSL connection.
     */
    function __checkSSL() {
        /** Make sure we are secure when we need to be! **/
        if (!empty($this->loggedUser)) {
            if (in_array($this->params['controller'], $this->secureControllers) && !env('HTTPS')) {
                $this->__forceSSL();
            }

            if (!in_array($this->params['controller'], $this->secureControllers) && env('HTTPS')) {
                $this->__unforceSSL();
            }
        } else {
            // Always force HTTPS if user is logged in.
            if (!env('HTTPS')) {
                $this->__forceSSL();
            }
        }
    }

    /**
     * Redirect to a secure connection
     * @return unknown_type
     */
    function __forceSSL() {
       // if (strstr(env('SERVER_NAME'), 'www.')) {
            $this->redirect('https://' . env('SERVER_NAME') . $this->here);
        //} else {
         //   $this->redirect('https://www.' . env('SERVER_NAME') . $this->here);
        //}
    }

    /**
     * Redirect to an unsecure connection
     * @return unknown_type
     */
    function __unforceSSL() {
        //if (strstr(env('SERVER_NAME'), 'www.')) {
           // $server = substr(env('SERVER_NAME'), 4);
            $this->redirect('http://' . env('SERVER_NAME') . $this->here);
        //} else {
       //     $this->redirect('http://' . env('SERVER_NAME') . $this->here);
        //}
    }





    protected function setFlashAndRedirect($flashMessage, $redirectAction=null, $errorFlag=true, $appendString="") {
        $this->Session->setFlash(__($flashMessage).$appendString, 'default', array('class'=>$errorFlag?'flasherrormsg':'flashmsg'));
        if ($redirectAction != null) {
            $this->redirect(array('action' => $redirectAction));
        }
    }

    protected function getManualsWithAccess($id) {
        $model = new UserRoleStudio();
        $userRoleStudios = $model->find("all", array('conditions'=>array('user_id'=>$id)));
        if (count($userRoleStudios) >= 1) {
            $roleTypes = array();
            $isAdmin = false;
            foreach ($userRoleStudios as $userRole) {
                if ($userRole['Role']['id']==5) {
                    $isAdmin=true;
                    break;
                }
                $roleTypes[] = $userRole['Role']['role_type_id'];
            }
            $manuals = array();
            if (!$isAdmin) {
                $manuals = $this->Manual->find('all', array('conditions'=>array('Manual.role_type_id'=>$roleTypes)));
            }
            else {
                $manuals = $this->Manual->find('all');
            }
            return $manuals;
        }
        else {
            return array();
        }
    }

    protected function hasManualAccess($id, $manualRoleType) {
        $model = new UserRoleStudio();
        $userRoleStudios = $model->find("all", array('conditions'=>array('user_id'=>$id)));
        if (count($userRoleStudios) >= 1) {
            $roleTypes = array();
            foreach ($userRoleStudios as $userRole) {
                if ($userRole['Role']['id']==5) {
                    return true;
                }
                if ($userRole['Role']['role_type_id'] == $manualRoleType) {
                    return true;
                }
            }
        }
        return false;
    }

    protected function sendEmail($to, $subject, $body) {
        $mail = new PHPMailer(true);
        $pass_through_email_account = $this->SystemProperty->findByName("pass_through_email_account");
        $pass_through_email_from = $this->SystemProperty->findByName("pass_through_email_from");
        $pass_through_email_account_pw = $this->SystemProperty->findByName("pass_through_email_account_pw");
        $smtp_host = $this->SystemProperty->findByName("smtp_host");
        $smtp_port = $this->SystemProperty->findByName("smtp_port");



        $emailPassThroughAddress = ['SystemProperty']['value'];
        $emailPassThroughFrom = $pass_through_email_from['SystemProperty']['value'];
        $emailPassThroughPw = $pass_through_email_account_pw['SystemProperty']['value'];
        $smtpHost = $smtp_host['SystemProperty']['value'];
        $smtpPort = $smtp_port['SystemProperty']['value'];

        //Send mail using gmail
        if(true){
            $mail->IsSMTP(); // telling the class to use SMTP
            $mail->SMTPAuth = true; // enable SMTP authentication
            $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
            $mail->Host = $smtpHost; // sets GMAIL as the SMTP server
            $mail->Port = $smtpPort ; // set the SMTP port for the GMAIL server
            $mail->Username = $emailPassThroughAddress; // GMAIL username
            $mail->Password = $emailPassThroughPw; // GMAIL password
        }

        //Typical mail data
        $mail->AddAddress($to);
        $mail->SetFrom($emailPassThroughAddress, $emailPassThroughFrom);
        $mail->Subject = $subject;
        $mail->Body = $body;
        try{
            $containsBadStuff = false;
            $containsBadStuff = $containsBadStuff && contains_bad_str($to);
            $containsBadStuff = $containsBadStuff && contains_bad_str($subject);
            $containsBadStuff = $containsBadStuff && contains_bad_str($body);

            $containsBadStuff = $containsBadStuff && contains_newlines($subject);
            $containsBadStuff = $containsBadStuff && contains_newlines($body);

            if (!$containsBadStuff) {
                $mail->Send();
            }
            else {
                $this->log("There was a problem with the email process.");
            }
            return true;
        } catch(Exception $e){
            //Something went bad
            $this->log("There was a problem with the email process.".$mail);
            $this->log($e);
        }
        return false;
    }

    private function contains_bad_str($str_to_test) {
        $bad_strings = array(
                    "content-type:"
                    ,"mime-version:"
                    ,"multipart/mixed"
                    ,"Content-Transfer-Encoding:"
                    ,"bcc:"
                    ,"cc:"
                    ,"to:"
        );

        foreach($bad_strings as $bad_string) {
            if(eregi($bad_string, strtolower($str_to_test))) {
                $this->log("Contains a Bad String");
                return true;
            }
        }
        return false;
    }

    function contains_newlines($str_to_test) {
       if(preg_match("/(%0A|%0D|\\n+|\\r+)/i", $str_to_test) != 0) {
            $this->log("Contains a Newline");
         return false;
       }
       return true;
    }

}
