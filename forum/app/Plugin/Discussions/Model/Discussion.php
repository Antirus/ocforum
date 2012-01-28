<?php
App::uses('DiscussionsAppModel', 'Discussions.Model');
/**
 * Discussion Model
 *
 * @property Categories.Category $Categories.Category
 */
class Discussion extends DiscussionsAppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';
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
        'Category' => array(
            'className' => 'Categories.Category',
            'foreignKey' => 'category_id'
        )
    );

    public $hasMany = array(
		'Comment' => array(
			'className' => 'Comments.Comment',
			'foreignKey' => 'discussion_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

    public $actsAs = array('Timeformat');
}
