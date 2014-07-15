<?php
class UsersController extends AppController {
    var $name = 'Users';
    var $scaffold;
    public $components = array('Acl');
    function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
                // Prior to 2.3 use
                // `return $this->redirect($this->Auth->redirect());`
            } else {
                $this->Session->setFlash(
                    __('Username or password is incorrect'),
                    'default',
                    array(),
                    'auth'
                );
            }
        }
        //debug(Security::hash('bar', 'sha1', true));
        //debug($this->Auth->authError);
    }

    function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function any_action() {

    }
}