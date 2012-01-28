<?php
App::uses('UsersAppModel', 'Users.Model');

class Admin extends UsersAppModel {
	public $useTable = 'user';

	function afterFind($results) {
	    foreach ($results as $key => $val) {
	        $results[$key]['Admin']['id'] = $val['Admin']['user_id']; 
	        unset($results[$key]['Admin']['user_id']);
	        $results[$key]['Admin']['group_id'] = $val['Admin']['user_group_id']; 
	        unset($results[$key]['Admin']['user_group_id']);
	        $results[$key]['Admin']['type'] = 'admin';
	    }
	    return $results;
	}
}