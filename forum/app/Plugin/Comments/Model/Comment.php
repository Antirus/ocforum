<?php
App::uses('CommentsAppModel', 'Comments.Model');
/**
 * Discussion Model
 *
 * @property Categories.Category $Categories.Category
 */
class Comment extends CommentsAppModel {
/**
 * Display field
 *
 * @var string
 */
	//public $displayField = 'title';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		// 'title' => array(
		// 	'alphanumeric' => array(
		// 		'rule' => array('alphanumeric'),
		// 		//'message' => 'Your custom message here',
		// 		//'allowEmpty' => false,
		// 		//'required' => false,
		// 		//'last' => false, // Stop validation after this rule
		// 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// 	),
		// ),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
        'Discussion' => array(
            'className' => 'Discussions.Discussion',
            'foreignKey' => 'discussion_id'
        )
    );

    public $actsAs = array('Timeformat');
}
