<?php
App::uses('AppController', 'Controller');
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

}
