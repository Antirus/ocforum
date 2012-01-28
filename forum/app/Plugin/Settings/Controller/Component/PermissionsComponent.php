<?php
App::uses('Setting', 'Settings.Model');

class PermissionsComponent extends Component {

	public $components = array('Session', 'Users.Membersession', 'Settings.Settings');
	private $controller;

	public function initialize($controller){
		$this->controller = $controller;
		$this->controller->loadModel('Settings.Setting');
		
	}

	public function getGroup($type){
		
		$group = array('id' => 1,
					   'title' => $type,
					   'permissions' => array(
					   		'routes' => array()
						)
					);
		
		$settings = $this->Settings->readByType($type.'s_permissions');

		$permissions = unserialize($settings['Setting'][$type.'s_permissions']);
		$group['permissions']['routes'] = $permissions['routes'];

		return $group;
	}
}