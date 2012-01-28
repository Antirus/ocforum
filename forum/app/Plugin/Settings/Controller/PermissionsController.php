<?php
App::uses('Setting', 'Settings.Model');
App::uses('SettingsAppController', 'Settings.Controller');

class PermissionsController extends SettingsAppController {

	public function beforeFilter(){
		parent::beforeFilter();
		$this->loadModel('Settings.Setting');
	}

	private $permissions = array(
		'canviewmain' => array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'index'),
		'canview' => array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'view'),
		'createposts' => array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'create'),
		'commentposts' => array('plugin' => 'comments', 'controller' => 'comments', 'action' => 'add'),
		'removepost' => array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'delete'),
		'removecomment' => array('plugin' => 'comments', 'controller' => 'comments', 'action' => 'delete'),
		'editpost' => array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'edit'),
		'editcomment' => array('plugin' => 'comments', 'controller' => 'comments', 'action' => 'edit'),
		'userdiscussions' => array('plugin' => 'users', 'controller' => 'users', 'action' => 'discussions'),
		'usercomments' => array('plugin' => 'users', 'controller' => 'users', 'action' => 'comments'),
		'userlogin' => array('plugin' => 'users', 'controller' => 'users', 'action' => 'login'),
		'userlogout' => array('plugin' => 'users', 'controller' => 'users', 'action' => 'logout'),
	);

	private $guests_permissions = array(
		'canviewmain' => array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'index'),
		'canview' => array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'view'),
		'userlogin' => array('plugin' => 'users', 'controller' => 'users', 'action' => 'login'),
	);

	public function admin_permissions(){

		$this->Setting->id = 1;
		if ($this->request->is('post') || $this->request->is('put')) {
				//unset($this->data['Permissions']['token']);

				$admins_permissions = array();
				foreach ($this->data['Permissions']['admin'] as $admins_permission_key => $admins_permission_value) {
					if($admins_permission_value){
						$admins_permissions['routes'][$admins_permission_key] = $this->permissions[$admins_permission_key];				
					}
				}
				$this->Settings->update('admins_permissions', serialize($admins_permissions));


				$users_permissions = array();
				foreach ($this->data['Permissions']['user'] as $users_permission_key => $users_permission_value) {
					if($users_permission_value){
						$users_permissions['routes'][$users_permission_key] = $this->permissions[$users_permission_key];				
					}
				}
				$this->Settings->update('users_permissions', serialize($users_permissions));

				$guests_permissions = array();
				foreach ($this->data['Permissions']['guest'] as $guests_permission_key => $guests_permission_value) {
					if($guests_permission_value){
						$guests_permissions['routes'][$guests_permission_key] = $this->guests_permissions[$guests_permission_key];				
					}
				}
				$this->Settings->update('guests_permissions', serialize($guests_permissions));
		}

		$settings = $this->Settings->read();
		$this->set('admins_permissions', unserialize($settings['Setting']['admins_permissions']));
		$this->set('users_permissions', unserialize($settings['Setting']['users_permissions']));
		$this->set('guests_permissions', unserialize($settings['Setting']['guests_permissions']));
	}
}