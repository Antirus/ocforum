<?php

App::uses('User', 'Users.Model');
App::uses('Admin', 'Users.Model');
App::uses('UsersAppController', 'Users.Controller');

class UsergroupsController extends UsersAppController {
	public $name = 'Users';
	public $helpers = array('Html', 'Form');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->loadModel('Users.AdminGroup');
		$this->loadModel('Users.UserGroup');
	}

	public function admin_list(){
		$this->Members->adminPanel();
        $this->AdminGroup->recursive = 0;
        $this->set('groups', $this->paginate('UserGroup'));

        $this->render('usergroups/list');
	}
}