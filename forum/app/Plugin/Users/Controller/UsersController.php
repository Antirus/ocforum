<?php

App::uses('User', 'Users.Model');
App::uses('Admin', 'Users.Model');
App::uses('Admin', 'Users.Model');
App::uses('UsersAppController', 'Users.Controller');

class UsersController extends UsersAppController {

	public $name = 'Users';
	public $helpers = array('Html', 'Form');

	//public $components = array('Auth');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->loadModel('Users.Admin');
		$this->loadModel('Discussions.Discussion');
		$this->loadModel('Comments.Comment');
	}

	public function index() {
		$users = $this->Admin->find('all');
	}

	public function discussions($user_id, $user_type){
		$category = $this->request->params['named'];
		$this->Discussion->recursive = 0;
		if(isset($this->request->params['named']['category'])){
			$this->paginate = array(
		        'Discussion' => array('conditions' => 
			        				array(
				        				'Discussion.category_id' => $category, 
			        					'Discussion.user_id' => $user_id,
			        					'Discussion.user_type' => $user_type,
			        				),
									'order' => 'Discussion.date DESC' ,
									'limit' =>Configure::read('pagination_limit')
								)
		    );
		}else{
			$this->paginate = array(
				'Discussion' => array('conditions' => 
			        				array(
			        					'Discussion.user_id' => $user_id,
			        					'Discussion.user_type' => $user_type,
			        				),
									'order' => 'Discussion.date DESC',
									'limit' =>Configure::read('pagination_limit')
								)
		    );
		}

		$this->set('user_id', $user_id);
		$this->set('user_type', $user_type);
        $this->set('discussions', $this->paginate('Discussion'));
	}

	public function comments($user_id, $user_type){
		$this->Comment->recursive = 0;
		
		$this->paginate = array(
			'Comment' => array('conditions' => 
		        				array(
		        					'Comment.user_id' => $user_id,
		        					'Comment.user_type' => $user_type,
		        				),
								'order' => 'Comment.date DESC' ,
								'limit' =>Configure::read('pagination_limit')
							)
	    );
		

		$this->set('user_id', $user_id);
		$this->set('user_type', $user_type);
        $this->set('comments', $this->paginate('Comment'));
	}

	public function login(){
		$this->layout= 'ajax';
		if ($this->request->is('ajax') && isset($this->request->data['User']['username']) && isset($this->request->data['User']['password'])){
			$this->Members->login($this->request->data['User']['username'], $this->request->data['User']['password']);
		}
	}

	public function logout(){
		$this->Members->logout();
		$this->redirect(array('plugin' => 'discussions', 'controller' => 'discussions', 'action'=>'index'));
	}
}