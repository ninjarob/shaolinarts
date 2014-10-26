<?php
App::uses('AppController', 'Controller');
class ManualsController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'user';
    }

    public function isAuthorized($user) {
       if (isset($user['role_id']) && $user['role_id'] >=0) {
            if (in_array($this->action, array('download', 'show'))) {
                return true;
            }
       }
       return parent::isAuthorized($user);
    }

    function download($id) {
        $this->ProjectFile->recursive=-1;
        $file = $this->Manual->findById($id);
        Configure::write('debug', 0);
       //just in case its been deleted, or someone is getting frisky
        if(!isset($file['Manual']['name'])){
            $this->Session->setFlash("Problem. Either;<ul><li>We no longer have that file</li><li>We never did.</li><li>You don't have rights</li></ul>", 'default', array('class'=>'flasherrormsg'));
            $this->redirect('/');

        }
        //set the file variable up for use in our view
        $this->set('file',$file);

        // we'll use a new layout, file, that will allow custom headers
        $this->render(null,'file');
    }

    function show($id) {
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
        $this->render('download','file');
    }

    function view($id) {
        $this->set("manualId",$id);
    }

}
?>