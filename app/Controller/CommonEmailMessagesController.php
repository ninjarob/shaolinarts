<?php
App::uses('AppController', 'Controller');
/**
 * CommonEmailMessages Controller
 *
 * @property CommonEmailMessage $CommonEmailMessage
 * @property PaginatorComponent $Paginator
 */
class CommonEmailMessagesController extends AppController {

     public $uses = array('User', 'UserRoleStudio', 'CommonEmailMessage');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'user_admin';
    }

    public function isAuthorized($user) {
        $userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$user['id'])));
        if (count($userRoleStudio)>0) {
            $userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$user['id'], 'role_id = 5')));
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
	    $this->set('commonEmailMessages', $this->CommonEmailMessage->find('all'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CommonEmailMessage->create();
			if ($this->CommonEmailMessage->save($this->request->data)) {
				$this->Session->setFlash(__('The common email message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The common email message could not be saved. Please, try again.'));
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
		if (!$this->CommonEmailMessage->exists($id)) {
			throw new NotFoundException(__('Invalid common email message'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CommonEmailMessage->save($this->request->data)) {
				$this->Session->setFlash(__('The common email message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The common email message could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CommonEmailMessage.' . $this->CommonEmailMessage->primaryKey => $id));
			$this->request->data = $this->CommonEmailMessage->find('first', $options);
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
		$this->CommonEmailMessage->id = $id;
		if (!$this->CommonEmailMessage->exists()) {
			throw new NotFoundException(__('Invalid common email message'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CommonEmailMessage->delete()) {
			$this->Session->setFlash(__('The common email message has been deleted.'));
		} else {
			$this->Session->setFlash(__('The common email message could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
