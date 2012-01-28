<?php
App::uses('Discussion', 'Discussions.Model');

class DiscussionsComponent extends Component {
	private $controller;

	public function initialize($controller){
		$controller->loadModel('Discussions.Discussion');
		$this->controller = $controller;
	}

	public function beforeRender($controller){
		$controller->set('Discussions', $this);
	}

	public function getTotal(){
		return $this->controller->Discussion->find('count');
	}

	public function getLatest(){
		return $this->controller->Discussion->find('all', array(
				'order' => array('Discussion.date DESC'),
				'limit' => '5'
			));
	}
}