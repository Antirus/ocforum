<?php
App::uses('Comment', 'Comments.Model');

class CommentsComponent extends Component {
	private $controller;

	public function initialize($controller){
		$controller->loadModel('Comments.Comment');
		$this->controller = $controller;
	}

	public function beforeRender($controller){
		$controller->set('Comments', $this);
	}

	public function getLatest(){
		return $this->controller->Comment->find('all', array(
				'order' => array('Discussion.date DESC'),
				'limit' => '5'
			));
	}
}