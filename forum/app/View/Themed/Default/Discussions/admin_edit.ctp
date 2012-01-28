<p></p>
<div class="row max-width-none">
	<div class="ten columns">
		<h3><?php echo __('Discussion Edit');?></h3>
	</div>
	<div class="two columns align-right">
		<a href="javascript:jQuery('#edit-discussion').submit()" class="small blue button round"><?php echo _('save')?></a>&nbsp;<a href="<?php echo Router::url('/admin/discussions/all/token:'.$token) ?>" class="small blue button round"><?php echo _('list')?></a>
	</div>
</div>
<?php echo $this->Form->create('Discussion', 
		array('inputDefaults' => array(
	        'label' => false,
	        'div' => false
	    ),
	    'class' => 'nice',
	    'id' => 'edit-discussion'
    )
); ?>
<?php echo $this->Form->input('id', array( 'type' => 'hidden')); ?>
<?php echo $this->Form->input('title', array('class' => 'input-text', 'label' => 'Title')); ?>
<p></p>
<?php  echo $this->element('bbcode_description');?>
<?php echo $this->Form->input('body', array( 'type' => 'textarea', 'label' => false, 'class' => 'comment-body')); ?>
<?php echo $this->Form->input('category_id', array( 'type' => 'select', 'label' => 'Category')); ?>
<?php echo $this->Form->input('status', array('type' => 'select', 'label' => __('Status'), 
												 'options' => array(
																'1' => __('Open'),
																'0' => __('Closed'),
															),
													));?>												
<div class="row">
	<div class="ten columns ">
		
	</div>
	<div class="two columns align-right">
		
	</div>
</div>
<?php echo $this->Form->end(); ?>