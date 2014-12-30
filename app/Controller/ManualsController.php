<?php
App::uses('AppController', 'Controller');
/**
 * Manuals Controller
 *
 * @property Manual $Manual
 * @property PaginatorComponent $Paginator
 */
class ManualsController extends AppController {
    public $uses = array('Manual', 'User', 'Role', 'Studio', 'UserRoleStudio');
    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'user_admin';
    }

    public function isAuthorized($user) {
        $userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$user['id'])));
        if (count($userRoleStudio)>0) {
            $userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$user['id'], 'role_id = 5')));
            if (count($userRoleStudio)>0 && in_array($this->action, array('index', 'view', 'add', 'edit', 'delete'))) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Manual->recursive = 0;
		$this->set('manuals', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Manual->exists($id)) {
			throw new NotFoundException(__('Invalid manual'));
		}
		$options = array('conditions' => array('Manual.' . $this->Manual->primaryKey => $id));
		$this->set('manual', $this->Manual->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Manual->create();
			if ($this->Manual->save($this->request->data)) {
				$this->Session->setFlash(__('The manual has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The manual could not be saved. Please, try again.'));
			}
		}
		$roleTypes = $this->Manual->RoleType->find('list');
		$this->set(compact('roleTypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Manual->exists($id)) {
			throw new NotFoundException(__('Invalid manual'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Manual->save($this->request->data)) {
				$this->Session->setFlash(__('The manual has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The manual could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Manual.' . $this->Manual->primaryKey => $id));
			$this->request->data = $this->Manual->find('first', $options);
		}
		$roleTypes = $this->Manual->RoleType->find('list');
		$this->set(compact('roleTypes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Manual->id = $id;
		if (!$this->Manual->exists()) {
			throw new NotFoundException(__('Invalid manual'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Manual->delete()) {
			$this->Session->setFlash(__('The manual has been deleted.'));
		} else {
			$this->Session->setFlash(__('The manual could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
