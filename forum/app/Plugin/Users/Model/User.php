<?php
App::uses('UsersAppModel', 'Users.Model');
/**
 * Discussion Model
 *
 * @property Categories.Category $Categories.Category
 */
class User extends UsersAppModel {
	public $useTable = 'customer';

	function afterFind($results) {
	    foreach ($results as $key => $val) {
	        $results[$key]['User']['id'] = $val['User']['customer_id']; 
	        unset($results[$key]['User']['customer_id']);
	        $results[$key]['User']['group_id'] = $val['User']['customer_group_id']; 
	        unset($results[$key]['User']['customer_group_id']);
	        $results[$key]['User']['username'] = $val['User']['email']; 
	        $results[$key]['User']['type'] = 'user';
	    }
	    return $results;
	}
}