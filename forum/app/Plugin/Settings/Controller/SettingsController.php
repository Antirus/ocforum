<?php
App::uses('Sanitize', 'Utility');
App::uses('Setting', 'Comments.Model');
App::uses('SettingsAppController', 'Settings.Controller');

class SettingsController extends SettingsAppController {
	public function general(){

		$this->set('token', $this->Session->read('token'));
		if (!empty($this->request->data) && $this->request->data['Setting']['token'] == $this->Session->read('token')) {
			$this->Setting->id = 1;
			if (!$this->Setting->exists()) {
				throw new NotFoundException(__('Invalid Setting'));
			}

			if(!$this->Members->isLogin() || !$this->Members->isAdmin()){
				return; //подумать над этим
			}

			if ($this->request->is('post') || $this->request->is('put')) {
				unset($this->request->data['Setting']['token']);
				//die();

				$this->Settings->updateAll(Sanitize::clean($this->request->data, array('encode' => false)));
				
			} else {
				//$this->request->data = $this->Discussion->read(null, $id);
			}
			
		}
		

		$this->request->data = $this->Settings->read();
	}
}