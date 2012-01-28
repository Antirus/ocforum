<p></p>
<div class="row max-width-none">
	<div class="ten columns">
		<h3><?php echo __('General');?></h3>
	</div>
	<div class="two columns align-right">
		<a href="javascript:jQuery('#save-settings').submit()" class="small blue button round"><?php echo _('save')?></a>
	</div>
</div>
<?php echo $this->Form->create('Setting', 
				array('inputDefaults' => array(
			        'label' => false,
			        'div' => false
			    ),
			    'class' => 'nice',
			    'id' => 'save-settings'
		    )
		 ); ?>
<div class="row max-width-none">
	<div class="four columns">
		<?php echo $this->Form->input('token', array('type' => 'hidden', 'value' => $token)); ?>
		<?php echo $this->Form->input('shop_url', array('class' => 'input-text', 'label' => 'Shop url')); ?>
		<?php echo $this->Form->input('forum_name', array('type' => 'text', 'class' => 'input-text', 'label' => 'Forum Name')); ?>
		<?php echo $this->Form->input('forum_slogan', array('type' => 'text', 'class' => 'input-text', 'label' => 'Forum Slogan')); ?>
		<?php echo $this->Form->input('pagination_limit', array('class' => 'input-text', 'label' => 'Pagination Count', 
																'options' => array('10' => '10', 
																					'15' => '15',
																					'20' => '20',
																					'25' => '25',
																					'30' => '30',
																					)
																)); ?>
	</div>
	<div class="four columns">
	<?php echo $this->Form->input('sidebar_text', array('type' => 'textarea', 'label' => 'Sidebar Text', 'class' => 'admin-body',)); ?>
	<?php echo $this->Form->input('footer_text', array('type' => 'textarea', 'label' => 'Fotter Text', 'class' => 'admin-body',)); ?>
	</div>
	<div class="four columns">
	
	</div>
</div>

<?php echo $this->Form->end(); ?>