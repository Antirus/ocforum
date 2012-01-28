<div class="row max-width-none">
	<div class="ten columns">
		<h3><?php echo __('Comment Edit');?></h3>
	</div>
	<div class="two columns align-right">
		<a href="javascript:jQuery('#edit-comment').submit()" class="small blue button round"><?php echo _('save')?></a>&nbsp;<a href="<?php echo Router::url('/admin/comments/all/token:'.$token) ?>" class="small blue button round"><?php echo _('list')?></a>
	</div>
</div>
<?php echo $this->Form->create('Comment', 
		array('inputDefaults' => array(
	        'label' => false,
	        'div' => false
	    ),
	    'class' => 'nice',
	    'id' => 'edit-comment',
	    'default' => 'ajax'
    )
);?>
	
	<?php  echo $this->element('bbcode_description');?>
	<?php
		echo $this->Form->input('body', array('label' => false, 'class' => 'comment-body'));
	?>
<?php echo $this->Form->end(); ?>