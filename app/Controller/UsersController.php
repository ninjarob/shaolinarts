<?php
App::uses('AppController', 'Controller');
class UsersController extends AppController {
    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('User.username' => 'asc' )
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','add','logout');
        $this->layout = 'user';
    }

    public function isAuthorized($user) {
       if (isset($user['role_id']) && $user['role_id'] >=0) {
            if (in_array($this->action, array('user_home', 'change_info', 'learn', 'play', 'train'))) {
                return true;
            }
       }
       if (isset($user['role_id']) && $user['role_id'] >=6) {
           if (in_array($this->action, array('user_management', 'edit', 'delete'))) {
               return true;
           }
      }
       return parent::isAuthorized($user);
    }

    public function login() {
        //if already logged-in, redirect
        if($this->Session->check('Auth.User')){
            $this->redirect(array('action' => 'index'));
        }
        // if we get the post information, try to authenticate
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->setFlash(__('Welcome, '. $this->Auth->user('email')));
                $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash(__('Invalid email or password'));
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function user_management() {

        $this->paginate = array(
            'limit' => 10,
            'order' => array('User.username' => 'asc' )
        );
        $users = $this->paginate('User');
        $this->set(compact('users'));
    }

    public function user_home() {}
    public function change_info() {}
    public function learn() {}
    public function play() {}
    public function train() {}

    public function add() {
        $roleData = $this->User->Role->find('list', array('fields' => array('id', 'name'),'order'=>'id ASC'));
        $studioData = $this->User->Studio->find('list', array('fields' => array('id', 'name'),'order'=>'id ASC'));
        $kungFuRank = $this->User->KungFuRank->find('list', array('fields' => array('id', 'name'),'order'=>'id ASC'));
        $taiChiRank = $this->User->TaiChiRank->find('list', array('fields' => array('id', 'name'),'order'=>'id ASC'));
        $this->set('roles', $roleData);
        $this->set('kfrs', $kungFuRank);
        $this->set('tcrs', $taiChiRank);
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

            if (!$id) {
                $this->Session->setFlash('Please provide a user id');
                $this->redirect(array('action'=>'index'));
            }

            $user = $this->User->findById($id);
            if (!$user) {
                $this->Session->setFlash('Invalid User ID Provided');
                $this->redirect(array('action'=>'index'));
            }

            if ($this->request->is('post') || $this->request->is('put')) {
                $this->User->id = $id;
                if ($this->User->save($this->request->data)) {
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

}
?>