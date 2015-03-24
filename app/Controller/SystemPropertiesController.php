<?php
App::uses('AppController', 'Controller');
/**
 * SystemProperties Controller
 *
 * @property SystemProperty $SystemProperty
 * @property PaginatorComponent $Paginator
 */
class SystemPropertiesController extends AppController {

    public $uses = array('User', 'UserRoleStudio', 'SystemProperty');

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
		$this->set('systemProperties', $this->SystemProperty->find('all'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SystemProperty->create();
			if ($this->SystemProperty->save($this->request->data)) {
				$this->Session->setFlash(__('The system property has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The system property could not be saved. Please, try again.'));
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
		if (!$this->SystemProperty->exists($id)) {
			throw new NotFoundException(__('Invalid system property'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SystemProperty->save($this->request->data)) {
				$this->Session->setFlash(__('The system property has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The system property could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SystemProperty.' . $this->SystemProperty->primaryKey => $id));
			$this->request->data = $this->SystemProperty->find('first', $options);
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
		$this->SystemProperty->id = $id;
		if (!$this->SystemProperty->exists()) {
			throw new NotFoundException(__('Invalid system property'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SystemProperty->delete()) {
			$this->Session->setFlash(__('The system property has been deleted.'));
		} else {
			$this->Session->setFlash(__('The system property could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
