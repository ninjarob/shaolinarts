<?php
App::uses('AppController', 'Controller');
class ContentForPagesController extends AppController {

    public $uses = array('User', 'Role', 'Studio', 'UserRoleStudio', 'ContentForPage');

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function isAuthorized($user) {
        $userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$user['id'])));
        if (count($userRoleStudio)>0) {
            if (in_array($this->action, array('edit'))) {
                $userRoleStudio = $this->UserRoleStudio->find('first', array('conditions'=>array('user_id'=>$user['id'], 'role_id'=>5)));
                if (count($userRoleStudio)>0) {
                    return true;
                }
            }
        }
        return parent::isAuthorized($user);
    }

    public function edit() {
            $id = $this->params['data']['ContentForPage']['id'];
            if (!$id) {
                $this->Session->setFlash('Error Saving Content', 'default', array('class'=>'flasherrormsg'));
                $this->redirect($this->referer());
            }

            $content = $this->ContentForPage->findById($id);
            if (!$content) {
                $this->Session->setFlash('Error Saving Content (not found)', 'default', array('class'=>'flasherrormsg'));
                $this->redirect($this->referer());
            }

            if ($this->request->is('post') || $this->request->is('put')) {
                $this->ContentForPage->id = $id;
                if ($this->ContentForPage->save($this->request->data)) {
                    $this->Session->setFlash(__('The content has been updated'), 'default', array('class'=>'flashmsg'));
                    $this->redirect($this->referer());
                }else{
                    $this->Session->setFlash(__('Unable to update your content.'), 'default', array('class'=>'flasherrormsg'));
                }
            }

            if (!$this->request->data) {
                $this->request->data = $content;
            }
    }

}
?>