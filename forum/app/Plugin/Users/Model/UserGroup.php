<?php
App::uses('UsersAppModel', 'Users.Model');

class UserGroup extends UsersAppModel {
	 public $useTable = 'users_groups';

	function afterFind($results) {
	    foreach ($results as $key => $val) {
	        $results[$key]['UserGroup']['permissions'] = array(
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