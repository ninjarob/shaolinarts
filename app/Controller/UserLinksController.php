<?php
App::uses('AppController', 'Controller');
/**
 * UserLinks Controller
 */
class UserLinksController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $uses = array('User', 'UserInfo', 'UserLink', 'Studio', 'UserRoleStudio');
	public $components = array('Paginator');


    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'user_admin';
    }

    public function isAuthorized($user) {
        $userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$user['id'])));
        if (count($userRoleStudio)>0) {
            $userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$user['id'], 'role_id = 10')));
            if (count($userRoleStudio)>0 && in_array($this->action, array('index', 'edit', 'delete', 'add', 'view'))) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('userLinks', $this->UserLink->find('all'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserLink->create();
			if ($this->UserLink->save($this->request->data)) {
				$this->Session->setFlash(__('The user link has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user link could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserLink->exists($id)) {
			throw new NotFoundException(__('Invalid user link'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserLink->save($this->request->data)) {
				$this->Session->setFlash(__('The user link has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user link could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserLink.' . $this->UserLink->primaryKey => $id));
			$this->request->data = $this->UserLink->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserLink->id = $id;
		if (!$this->UserLink->exists()) {
			throw new NotFoundException(__('Invalid user link'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserLink->delete()) {
			$this->Session->setFlash(__('The user link has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user link could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
