<?php
App::uses('User', 'Users.Model');
App::uses('Admin', 'Users.Model');

class MembersComponent extends Component {

	public $components = array('Session', 'Users.Membersession', 'Permissions');
	private $controller;

	public function initialize($controller){
		$controller->loadModel('Users.Admin');
		$controller->loadModel('Users.User');
		$controller->loadModel('Users.UserGroup');
		$controller->loadModel('Users.AdminGroup');
		$this->controller = $controller;	
	}

	function beforeRender($controller){
		$controller->set('Members', $this);
	}

	public function userName($id, $type, $link = true, $blank = false){


		$user = $this->getUserById($id, $type);
		$output = '';
		if($user['User']['username']){
			if($link){
				$output .= '<a href="'.Router::url('/users/users/discussions/'.$user['User']['id'].'/'.$user['User']['type']).'"';
				if($blank){
					$output .= ' target="_blank" ';
				}
				$output .= '">'.$user['User']['username'].'</a>';
			}else{
				$output = $user['User']['username'];
			}
		}else{
			$output = '...';
		}
		return $output;
	}

	public function getUserById($id, $type = 'user'){
		if($type == 'user'){
			$user = $this->controller->User->find('first', array(
		        'conditions' => array('User.customer_id' => $id)
		    ));
		    if($user){

		    	$user = array(
		    		'User' => $user['User'],
		    		'Group' => $this->Permissions->getGroup('user')
				);

				return $user;
		    }else{

		    }
		}elseif($type == 'admin'){
			$user = $this->controller->Admin->find('first', array(
		        	'conditions' => array('Admin.user_id' => $id)
		    	));
		    	
		    	if($user){
			    	$user = array(
			    		'User' => $user['Admin'],
			    		'Group' => $this->Permissions->getGroup('admin')
					);
					return $user;
				}else{
					
				}
		}elseif($type == 'guest'){
			return array(
						'User' => array('id' => 0,
										'username' => 'guest',
										'type' => 'guest'),
						'Group' => $this->Permissions->getGroup('guest')
					);
		}
	}

	public function isLogin(){
		if(!is_null($this->Membersession->get('user_id')) || !is_null($this->Membersession->get('customer_id'))){
			return true;
		}
		return false;
	}

	public function getViewer(){
		if($this->Membersession->get('customer_id')){	
		 	return $this->getUserById($this->Membersession->get('customer_id'), 'user');
		}elseif($this->Membersession->get('user_id')){
			return $this->getUserById($this->Membersession->get('user_id'), 'admin');
		}else{
			return $this->getUserById(0, 'guest');
		}
	}

	public function getViwerName(){
		$viewer = $this->getViewer();
		if($viewer['User']['username']){
			return $viewer['User']['username'];
		}else{
			return '...';
		}
	}

	public function getUserDiscussionsLink($user){
		if($user['User']['id']){
			return Router::url('/users/users/discussions/'.$user['User']['id'].'/'.$user['User']['type']);
		}else{
			return '#';
		}
	}

	public function getUserCommentsLink($user){
		if($user['User']['id']){
			return Router::url('/users/users/comments/'.$user['User']['id'].'/'.$user['User']['type']);
		}else{
			return '#';
		}
	}

	public function getViwerDiscussionsLink(){
		return $this->getUserDiscussionsLink($this->getViewer());
	}

	public function getViwerCommentsLink(){
		return $this->getUserCommentsLink($this->getViewer());
	}

	public function isOwner($id, $type){
		$viewer = $this->getViewer();
		if($id == $viewer['User']['id'] && $type == $viewer['User']['type']){
			return true;
		}
		return false;
	}


	public function isAllow(){

		if($this->adminPanel()){ //если это панель администратора и админ залогинен, то отображаем все
			return true;
		}

		$plugin = $this->controller->request->plugin;
		$controller = $this->controller->request->controller;
		$action = $this->controller->request->action;

		$user = $this->getViewer();

		if(!isset($user['Group']['permissions']['routes'])){
			return false;
		}

		foreach($user['Group']['permissions']['routes'] as $route){
			if($route['plugin'] == $plugin &&
			   $route['controller'] == $controller &&
			   $route['action'] == $action){
				return true;
			}
		}
		return false;
		
	}

	public function adminPanel(){
		$params = $category = $this->controller->request->params['named'];
        if(!isset($params['token']) || $params['token'] != $this->Membersession->get('token')){ //проверка, как загружается фрейм
            return false;
        }

        if(!$this->isLogin() || !$this->isAdmin()){//проверка пользователя
         	return false;
        }

        $this->controller->set('token', $this->Session->read('token'));
        $this->controller->layout= 'iframe';

        return true;
	}


	public function isAdmin(){
		if($this->Membersession->get('token') && $this->Membersession->get('user_id')){
			return true;
		}
		return false;
	}

	public function getAdminLink(){
		if(!is_null($this->Membersession->get('token'))){
			return Router::url(Configure::read('shop_url')).'admin?token='.$this->Membersession->get('token');
		}
	}

	public function getRegisterLink(){
		return Router::url(Configure::read('shop_url')).'index.php?route=account/register';
		
	}

	public function login($username, $password){
		$user = $this->controller->User->find('first', array(
		        	'conditions' => array('User.email' => $username,
		        						  'User.password' => md5($password))
		    	));
		  
		if($user){
			$this->Membersession->set('customer_id', $user['User']['id']);
			if( $user['User']['cart'] && is_string($user['User']['cart'])){
				$cart = unserialize($user['User']['cart']);
				
				$user_cart = $this->Membersession->get('cart');
				foreach ($cart as $key => $value) {
					if (!array_key_exists($key, $user_cart)){
						$user_cart[$key] = $value;
					} else {
						$user_cart[$key] += $value;
					}
				}

				$this->Membersession->set('cart', $user_cart);
			}
			return true;
		}

		$user = $this->controller->Admin->find('first', array(
		        	'conditions' => array('Admin.username' => $username,
		        						  'Admin.password' => md5($password))
		    	));

		if($user){
			$this->Membersession->set('user_id', $user['Admin']['id']);
			$this->Membersession->set('token', md5(mt_rand()));
			return true;
		}
	}

	public function logout(){
		$this->Membersession->destroy();
	}

}
