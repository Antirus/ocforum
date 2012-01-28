<?php
App::uses('Setting', 'Settings.Model');

class SettingsComponent extends Component {

	public $components = array('Session', 'Users.Membersession');
	private $controller;

	public function initialize($controller){
		$this->controller = $controller;
		$this->controller->loadModel('Settings.Setting');
		
	}

	public function update($name, $value){
		$this->controller->Setting->updateAll(
			    array('Setting.value' => "'".$value."'"),
			    array('Setting.name =' => $name)
		);
	}

	public function updateAll($data){
		foreach ($data['Setting'] as $key => $value) {
			$this->controller->Setting->updateAll(
			    array('Setting.value' => '"'.$value.'"'),
			    array('Setting.name =' => $key)
			);
		}

		
	}

	public function read(){
		$all_settings = $this->controller->Setting->find('all');
		$settings = array();
		foreach ($all_settings as $key => $value) {
					$settings['Setting'][$value['Setting']['name']] = $value['Setting']['value'];
		}

		return $settings;
	}

	public function readByType($type){
		$settings = $this->controller->Setting->find('first', array(
			'conditions' => array('Setting.name' => $type)
		));

		if($settings){
			return array('Setting' => array($type => $settings['Setting']['value']));
		}else{
			return null;
		}
	}
}