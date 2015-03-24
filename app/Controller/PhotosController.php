<?php
App::uses('AppController', 'Controller');
/**
 * Manuals Controller
 *
 * @property Photo $photo
 */
class PhotosController extends AppController {
    public $uses = array('Photo', 'User', 'Role', 'Studio', 'UserRoleStudio');
    public $helpers = array('User','Js' => array('Jquery'));
    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'user_admin';
    }

    public function isAuthorized($user) {
        $userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$user['id'])));
        if (count($userRoleStudio)>0) {
            $userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$user['id'], 'role_id = 10')));
            if (count($userRoleStudio)>0 && in_array($this->action, array('photo'))) {
                return true;
            }
            $userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$user['id'], 'role_id = 10')));
            if (count($userRoleStudio)>0 && in_array($this->action, array('add', 'edit', 'delete'))) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }

	public function add() {
		if ($this->request->is('post') &&
		    !empty($this->data) &&
            is_uploaded_file($this->data['Photo']['data']['tmp_name'])) {

            //check size
            if ($this->data['Photo']['data']['size'] >= 1000000) {
                 $this->Session->setFlash(__('Too big.'));
                 return;
            }
            //check filetype
            $fileType = $this->data['Photo']['data']['type'];
            if($fileType != "image/jpeg" && $fileType != "image/gif" && $fileType != "image/png" && $fileType != "application/pdf") {
                $this->Session->setFlash(__('Not a good image type.'));
                return;
            }
            //get data
            $fileData = fread(fopen($this->data['Photo']['data']['tmp_name'], "r"), $this->data['Photo']['data']['size']);
            $this->Photo->create();

            //create photo object
            $photo = array(
                            'Photo'=>array('user_id'=>$this->data['User']['id'],
                                            'type'=>$fileType,
                                            'data'=>$fileData
                                            )
                            );

            //save to the database
            if ($this->Photo->save($photo)) {
                $this->Session->setFlash(__('The photo has been saved.'));
            } else {
                $this->Session->setFlash(__('There was a problem saving the photot.'));
            }
		}
		else if (!empty($this->data) && $this->data['Photo']['data']['size'] == 0) {
            $this->Session->setFlash(__('There was a problem.'));
		}
		return $this->redirect($this->referer());
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Photo->id = $id;
		if (!$this->Photo->exists()) {
			throw new NotFoundException(__('Invalid photo'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Photo->delete()) {
			$this->Session->setFlash(__('The photo has been deleted.'));
		} else {
			$this->Session->setFlash(__('The photo could not be deleted. Please, try again.'));
		}
		return $this->redirect($this->referer());
	}

    function photo($id) {
        $this->layout = 'photo';
        //set up a variable, so the view will know to show it, not prompt to download
        $this->set('inpage',true);

        //in my actual controller i do some logic here to set up an array of ''allowed file ids''  but to kepp it simple, well assume everyone can see

       //IMPORTANT!  turn off debug output, will corrupt filestream.
        Configure::write('debug', 0);
        $this->Photo->recursive=-1;
        $file = $this->Photo->findById($id);

        //set the file variable up for use in our view
        $this->set('file',$file);

        // we'll use our new layout, file,BUT will also use the same view, download
        $this->render(null, 'photo');
    }


}
