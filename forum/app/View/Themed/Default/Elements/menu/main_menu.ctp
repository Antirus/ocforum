<ul class="nav-bar">
	<li><a href="<?php echo Router::url($shop_url) ?>"><?php echo __('Shop'); ?></a></li>
	
	<li><a href="<?php echo Router::url('/') ?>"><?php echo __('Discussions'); ?></a></li>
	<!--li class="has-flyout "><a href="#">Nav Item 3</a>
		<div class="flyout">
  			Content...
  		</div>
	</li-->
	<?php if($Members->isLogin()): ?>
	<li class="has-flyout"><a href="<?php echo $Members->getViwerDiscussionsLink() ?>"><?php echo $Members->getViwerName() ?></a>
		<div class="flyout small ">
			<!--h5>Small Example (200px)</h5>
			<p>This is example text. This is example text. This is example text. This is example text. This is example text. This is example text. This is example text. This is example text. </p-->
			<ul>
			<li><a href="<?php echo $Members->getViwerDiscussionsLink() ?>"><?php echo __('Discussions'); ?></a></li>
			<li><a href="<?php echo $Members->getViwerCommentsLink() ?>"><?php echo __('Comments'); ?></a><br /></li>
			<li><a href="<?php echo Router::url(array('plugin' => 'users', 'controller' => 'users', 'action' => 'logout')) ?>"><?php echo __('Log out'); ?></a></li>
			</ul>
		</div>
	</li>
		<?php if($Members->isAdmin()): ?>
		<li class="last"><a href="<?php echo $Members->getAdminLink() ?>"><?php echo __('Admin panel'); ?></a>
		</li>
		<?php endif; ?>
	<?php else: ?>
	<li class="has-flyout"><a href="#"><?php echo __('Log in'); ?></a>
		<div class="flyout login ">
			<?php echo $this->Form->create('User', 
					array('inputDefaults' => array(
				        'label' => false,
				        'div' => false
				    ),
				    'class' => 'nice',
				    'id' => 'user-login'
			    )
			 ); ?>
			<?php echo $this->Form->input('username', array('class' => 'input-text', 'label' => 'Username')); ?>
			<?php echo $this->Form->input('password', array('class' => 'input-text', 'label' => 'Password')); ?>
			<div class="row">
				<div class="eight columns ">
					
				</div>
				<div class="four columns">
					<a href="javascript:{}" class="small blue button" id="button-log-in"><?php echo _('log in')?></a>
				</div>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</li>
	<li class="last"><a href="<?php echo $Members->getRegisterLink() ?>"><?php echo __('Sign in'); ?></a></li>
	<?php endif; ?>
</ul>

<?php 
$data =  $this->Js->get('#user-login')->serializeForm(array('isForm' => true, 'inline' => true));
$this->Js->get('#button-log-in')->event(
    'click',
    $this->Js->request(
        array('plugin' => 'users', 'controller' => 'users', 'action' => 'login'),
        array('async' => true, 
        	//'update' => '#post-body', 
        	'method' => 'post', 
        	'data' => $data,
        	'dataExpression' => true,
        	'success' => 'window.location.href=window.location.href',
        	//'before'  => '$("#ajax-loader").show();'
        )
    )
);

echo $this->Js->writeBuffer();
?>