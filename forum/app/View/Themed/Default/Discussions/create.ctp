<?php echo $this->Form->create('Discussion', 
		array('inputDefaults' => array(
	        'label' => false,
	        'div' => false
	    ),
	    'class' => 'nice',
	    'id' => 'create-discussion'
    )
 ); ?>
<?php echo $this->Form->input('title', array('class' => 'input-text', 'label' => 'Title')); ?>
<p></p>
<?php  echo $this->element('bbcode_description');?>
<?php echo $this->Form->input('body', array( 'type' => 'textarea', 'label' => false, 'class' => 'comment-body')); ?>
<?php echo $this->Form->input('category_id', array( 'type' => 'select', 'label' => 'Category')); ?>
<div class="row">
	<div class="ten columns ">
		
	</div>
	<div class="two columns align-right">
		<a href="javascript:jQuery('#create-discussion').submit()" class="small blue button"><?php echo _('save')?></a>
	</div>
</div>
<?php echo $this->Form->end(); ?>