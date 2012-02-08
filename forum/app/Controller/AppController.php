<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {

	public $components = array('Users.Members', 'Session', 'Users.Membersession', 'Discussions.Discussions', 'Categories.Categories', 'Comments.Comments', 'Settings.Settings', 'Settings.Permissions');
	public $helpers = array('Js' => array('Jquery'), 'Form', 'Html', 'Time', 'Session', 'Discussions.Discussion', 'Categories.Category', 'Bbcode', 'Comments.Comment', 'Settings.Permission');
	public $viewClass = 'Theme';
    public $theme = 'Default'; //это в конфиг

    public function beforeFilter(){
		
		$settings = $this->Settings->read();

		Configure::write('pagination_limit', $settings['Setting']['pagination_limit']);
	

		if(!$this->Members->isAllow()){
			if(!$this->request->is('ajax')){
				//$this->redirect(array('plugin' => 'users', 'controller' => 'users', 'action' => 'login'));
				die('404');
			}else{
				die('deny'); //тут обработка запрета при ajax запросе
			}
		}

		Configure::write('pagination_limit', $settings['Setting']['pagination_limit']);
		Configure::write('shop_url', $settings['Setting']['shop_url']);

		$this->set('shop_url', $settings['Setting']['shop_url']);
		$this->set('forum_name', $settings['Setting']['forum_name']);
		$this->set('forum_slogan', $settings['Setting']['forum_slogan']);
		$this->set('sidebar_text', $settings['Setting']['sidebar_text']);
		$this->set('footer_text', $settings['Setting']['footer_text']);
	}
}
