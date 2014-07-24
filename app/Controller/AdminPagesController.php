<?php
App::uses('AppController', 'Controller');
class AdminPagesController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'admin';
    }

    public function isAuthorized($user) {
       if (isset($user['role_id']) && $user['role_id'] >=6) {
            if (in_array($this->action, array('admin_home'))) {
                return true;
            }
       }
       return parent::isAuthorized($user);
    }

    function admin_home() {

    }

    function manual_management() {
    }

    function role_management() {
    }
}
?>