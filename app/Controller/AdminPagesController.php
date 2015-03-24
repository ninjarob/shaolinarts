<?php
App::uses('AppController', 'Controller');
class AdminPagesController extends AppController {
    public $uses = array('User', 'Role', 'Studio', 'UserRoleStudio');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'admin';
    }

    public function isAuthorized($user) {
        if (in_array($this->action, array('admin_home'))) {
            $userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$user['id'], 'role_id = 10')));
            if (count($userRoleStudio)>0) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }

    function admin_home() {

    }
}
?>