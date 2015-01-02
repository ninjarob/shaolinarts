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
    public $helpers = array('User','Js' => array('Jquery'));
    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'user_admin';
    }

    public function isAuthorized($user) {
        $userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$user['id'])));
        if (count($userRoleStudio)>0) {
            $userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$user['id'], 'role_id = 5')));
            if (count($userRoleStudio)>0 && in_array($this->action, array('index', 'view', 'add', 'edit', 'delete', 'show'))) {
                return true;
            }
            if (in_array($this->action, array('show', 'manual'))) {
                $manual = $this->Manual->findById($this->request->params['pass'][0]);

                if (count($manual) > 0 && $this->hasManualAccess($this->Auth->user('id'), $manual['Manual']['role_type_id'])) {
                    return true;
                }
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
// if (!empty($this->data) &&
//              is_uploaded_file($this->data['MyFile']['File']['tmp_name'])) {
//             $fileData = fread(fopen($this->data['MyFile']['File']['tmp_name'], "r"),
//                                      $this->data['MyFile']['File']['size']);
//
//             $this->data['MyFile']['name'] = $this->data['MyFile']['File']['name'];
//             $this->data['MyFile']['type'] = $this->data['MyFile']['File']['type'];
//             $this->data['MyFile']['size'] = $this->data['MyFile']['File']['size'];
//             $this->data['MyFile']['data'] = $fileData;
//
//             $this->MyFile->save($this->data);
//
//             $this->redirect('somecontroller/someaction');
//         }


	public function add() {
        $roleTypes = $this->Manual->RoleType->find('list');
        $this->set(compact('roleTypes'));
		if ($this->request->is('post') &&
		    !empty($this->data) &&
            is_uploaded_file($this->data['Manual']['data']['tmp_name'])) {

            //check size
            if ($this->data['Manual']['data']['size'] >= 16000000) {
                 $this->setFlashAndRedirect(Configure::read('Manual.tooBig'), null, true);
                 return;
            }
            //check filetype
            $fileType = $this->data['Manual']['data']['type'];
            if($fileType != "image/jpeg" && $fileType != "image/gif" && $fileType != "image/png" && $fileType != "application/pdf") {
                $this->setFlashAndRedirect(Configure::read('Manual.typeProblem'), null, true);
                return;
            }

            //get data
            $fileData = fread(fopen($this->data['Manual']['data']['tmp_name'], "r"), $this->data['Manual']['data']['size']);
            $this->Manual->create();

            //create manual object
            $manual = array(
                            'Manual'=>array('name'=>$this->data['Manual']['name'],
                                            'description'=>$this->data['Manual']['description'],
                                            'role_type_id'=>$this->data['Manual']['role_type_id'],
                                            'type'=>$fileType,
                                            'data'=>$fileData
                                            )
                            );

            //save to the database
            if ($this->Manual->save($manual)) {
                $this->Session->setFlash(__('The manual has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->setFlashAndRedirect(Configure::read('Manual.typeProblem'), null, true);
            }
		}
		else if (!empty($this->data) && $this->data['Manual']['data']['size'] == 0) {
            $this->setFlashAndRedirect(Configure::read('Manual.typeProblem'), null, true);
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
	}


	function show($id) {
	    $this->layout = null;
        $this->set('manualId', $id);
        $manual = $this->Manual->find('first', array('conditions' => array('Manual.id'=>$id), 'fields'=>array('Manual.name')));
        $this->set('manualName', $manual['Manual']['name']);
    }

    function manual($id) {
        //set up a variable, so the view well knwo to show it, not prompt to download
        $this->set('inpage',true);

        //in my actual controller i do some logic here to set up an array of ''allowed file ids''  but to kepp it simple, well assume everyone can see

       //IMPORTANT!  turn off debug output, will corrupt filestream.
        Configure::write('debug', 0);
        $this->Manual->recursive=-1;
        $file = $this->Manual->findById($id);
        //if(!isset($file['Manual']['name'])){
        //    $this->redirect('/');
       // }
        //set the file variable up for use in our view
        $this->set('file',$file);

        // we'll use our new layout, file,BUT well also use the same view, download
        $this->render(null, 'file');
    }


}
