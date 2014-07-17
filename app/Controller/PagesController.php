<?php
App::uses('AppController', 'Controller');
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('Contact');
    public $helpers = array('form');

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('display');
    }

	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}

    function sendContactMessage() {
        if ($this->request->is('post')) {
            $this->Contact->set($this->data);
            if ($this->Contact->validates()) {
                //send email using the Email component
                $this->Email->to = 'robatmywork@gmail.com';
                $this->Email->subject = 'Contact message from ' . $this->data['Contact']['name'] . ' in the city of' . $this->data['Contact']['city'];
                $this->Email->from = $this->data['Contact']['email'];

                $this->Email->send($this->data['Contact']['message']);
            }
        }
    }
}
?>