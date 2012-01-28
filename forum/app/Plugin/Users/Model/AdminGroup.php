<?php
App::uses('UsersAppModel', 'Users.Model');

class AdminGroup extends UsersAppModel {
	public $useTable = 'admins_groups';

	function afterFind($results) {
	    foreach ($results as $key => $val) {
	        $results[$key]['AdminGroup']['permissions'] = array(
									'routes' => array(
										array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'create'),
										array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'index'),
										array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'view'),

										array('plugin' => 'comments', 'controller' => 'comments', 'action' => 'add')
									)
								); 
	    }
	    return $results;
	}
}