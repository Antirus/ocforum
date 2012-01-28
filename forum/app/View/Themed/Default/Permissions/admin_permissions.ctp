<p></p>
<div class="row max-width-none">
	<div class="ten columns">
		<h3><?php echo __('Permissions');?></h3>
	</div>
	<div class="two columns align-right">
		<a href="javascript:jQuery('#set-permissions').submit()" class="small blue button round"><?php echo _('save')?></a>
	</div>
</div>
<?php echo $this->Form->create('Permissions', 
		array('inputDefaults' => array(
	        'label' => false,
	        'div' => false
	    ),
	    'class' => 'nice',
	    'id' => 'set-permissions'
    )
 );?>

<?php echo $this->Form->input('token', array('type' => 'hidden', 'value' => $token)); ?>

<div class="row max-width-none">
	<div class="four columns">
		<h4><?php echo __("Users Permissions"); ?></h4>
		<?php $this->Permission->renderAdminPermissions($admins_permissions); ?>
	</div>
	<div class="four columns">
		<h4><?php echo __("Customers Permissions"); ?></h4>
		<?php $this->Permission->renderUserPermissions($users_permissions); ?>
	</div>
	<div class="four columns">
		<h4><?php echo __("Guest Permissions"); ?></h4>
		<?php $this->Permission->renderGuestPermissions($guests_permissions); ?>
	</div>
<div>
<!--div class="row max-width-none">
	<div class="twelve columns align-right">
		<a href="javascript:jQuery('#set-permissions').submit()" class="small blue button round"><?php echo _('save')?></a>
	</div>
</div-->
<?php echo $this->Form->end();?>