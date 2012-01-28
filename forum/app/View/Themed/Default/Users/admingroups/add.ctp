<div class="row max-width-none">
	<div class="ten columns">
		<h3><?php echo __('Add Group');?></h3>
	</div>
	<div class="two columns align-right">
		<a href="<?php echo Router::url('/admin/groups/admins/all/token:'.$token) ?>" class="small blue button round"><?php echo _('list')?></a>
	</div>
</div>
<?php echo $this->Form->create('Group', 
		array('inputDefaults' => array(
	        'label' => false,
	        'div' => false
	    ),
	    'class' => 'nice',
	    'id' => 'create-group'
    )
 );?>

<?php echo $this->Form->input('token', array('type' => 'hidden', 'value' => $token)); ?>
<?php echo $this->Form->input('title', array('class' => 'input-text', 'label' => 'Group Title')); ?>

<h4><?php echo __("Permissions"); ?></h4>

<label>
<?php echo $this->Form->input('title', array('type' => 'checkbox', 'label' => false, 'name' => 'data[Permissions][createposts]')); ?>
<?php echo __("Can create posts"); ?>
</label>

<label>
<?php echo $this->Form->input('title', array('type' => 'checkbox', 'label' => false, 'name' => 'data[Permissions][commentposts]')); ?>
<?php echo __("Can comment posts"); ?>
</label>

<label>
<?php echo $this->Form->input('title', array('type' => 'checkbox', 'label' => false, 'name' => 'data[Permissions][removepost]')); ?>
<?php echo __("Can remove posts"); ?>
</label>

<label>
<?php echo $this->Form->input('title', array('type' => 'checkbox', 'label' => false, 'name' => 'data[Permissions][removecomment]')); ?>
<?php echo __("Can remove comments"); ?>
</label>

<label>
<?php echo $this->Form->input('title', array('type' => 'checkbox', 'label' => false, 'name' => 'data[Permissions][editpost]')); ?>
<?php echo __("Can edit posts"); ?>
</label>

<label>
<?php echo $this->Form->input('title', array('type' => 'checkbox', 'label' => false, 'name' => 'data[Permissions][editcomment]')); ?>
<?php echo __("Can edit comments"); ?>
</label>

<!-- 
<?php echo $this->Form->input('category_id', array('class' => 'text',  'label' => 'Parent')); ?>
 -->
<a href="javascript:jQuery('#create-group').submit()" class="small blue button round"><?php echo _('save')?></a>
<?php echo $this->Form->end();?>