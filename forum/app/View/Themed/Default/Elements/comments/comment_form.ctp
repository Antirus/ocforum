<?php if($Members->isLogin()): ?>
<div class="create-comment form">

<?php echo $this->Form->create('Comment', 
		array('inputDefaults' => array(
	        'label' => false,
	        'div' => false
	    ),
	    'class' => 'nice',
	    'id' => 'create-comment',
	    'default' => 'ajax'
    )
);?>
	<h5><?php echo __('Add Comment'); ?></h5>
	<?php  echo $this->element('bbcode_description');?>
	<?php
		echo $this->Form->input('body', array('label' => false, 'class' => 'comment-body'));
	?>
<div class="row">
	<div class="ten columns ">
		
	</div>
	<div class="two columns align-right">
		<a href="javascript:{}" class="small blue button" id="add-comment"><?php echo _('add')?></a>
	</div>
</div>
<?php echo $this->Form->end(); ?>
</div>
<?php endif; ?>
<?php 
$data =  $this->Js->get('#create-comment')->serializeForm(array('isForm' => true, 'inline' => true));
// echo $this->Html->scriptBlock(
//     'var $j = jQuery.noConflict();',
//     array('inline' => false)
// );
$this->Js->get('#add-comment')->event(
    'click',
    $this->Js->request(
        array('plugin' => 'comments', 'controller' => 'comments', 'action' => 'add', $discussion['id']),
        array('async' => true, 
        	'update' => '#discussion-comments', 
        	'method' => 'post', 
        	'data' => $data,
        	'dataExpression' => true
        )
    )
);
?>