<?php
/**
 * Copyright 2010, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('CategoriesAppModel', 'Categories.Model');
/**
 * Category model
 *
 * @package categories
 * @subpackage categories.models
 */
class Category extends CategoriesAppModel {

/**
 * Name
 *
 * @var string $name
 */
	public $name = 'Category';



	public $validate = array();

    public $hasMany = array('Discussion');
 
    function parentNode() {
    	if (!$this->id) {
            return null;
        }
     	$data = $this->read();
        if (!$data['Category']['category_id']){
            return null;
        } else {
            return array('model' => 'Category', 'foreign_key' => $data['Category']['category_id']);
        }
    }
}
