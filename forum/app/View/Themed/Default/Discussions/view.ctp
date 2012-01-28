<?php
//debug($discussion);
?>
<h4><?php echo $discussion['Discussion']['title'] ?></h4>
<p><?php echo __('Autor', true)?>: <?php echo $Members->userName($discussion['Discussion']['user_id'], $discussion['Discussion']['user_type']) ?>,
				<?php echo __('Category', true)?>: <?php echo $Categories->categoryName($discussion['Discussion']['category_id']) ?>,
				<?php echo __('Date', true)?>: <?php echo $discussion['Discussion']['date'] ?>
			<?php ?></p>
<div class='post-body' id="post-body">
	<?php $this->Bbcode->parsebbcode($discussion['Discussion']['body']); ?>
</div>
<?php if($Members->isOwner($discussion['Discussion']['user_id'], $discussion['Discussion']['user_type'])): ?>

<div class="row">
	<div class="eight columns ">
		
	</div>
	<div class="four columns align-right">
		<?php echo $this->Html->link('delete', array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'delete', $discussion['Discussion']['id']), array('class' => 'small white button')); ?>
		<?php echo $this->Html->link('edit', 'javascript:jQuery(".hidden-form").hide();jQuery("#edit-discussion").show()', array('class' => 'small white button')); ?>
	</div>
</div>


<?php echo $this->Form->create('Discussion', 
		array('inputDefaults' => array(
	        'label' => false,
	        'div' => false
	    ),
	    'class' => 'nice hidden-form',
	    'id' => 'edit-discussion'
    )
 ); ?>
<?php  echo $this->element('bbcode_description');?>
<?//php echo $this->Form->input('title', array('class' => 'input-text', 'label' => 'Title')); ?>
<?php echo $this->Form->input('body', array( 'type' => 'textarea', 'label' => false, 'class' => 'comment-body')); ?>

<div class="row">
	<div class="four columns ">
	<?php echo $this->Form->input('category_id', array( 'type' => 'select', 'label' => 'Category')); ?>

	</div>
	<div class="four columns ">

	<?php echo $this->Form->input('status', array('type' => 'select', 'label' => __('Status'), 
												 'options' => array(
																'1' => __('Open'),
																'0' => __('Closed'),
															),
													));
	?>
	</div>
	<div class="four columns align-right">
		<a href='javascript:jQuery("#edit-discussion").hide()' class="small blue button"><?php echo _('close')?></a>
		<a href="javascript:{}" class="small blue button" id="button-save-discussion"><?php echo _('save')?></a>
	</div>
</div>
<?php echo $this->Form->end(); ?>

<?php 
$data =  $this->Js->get('#edit-discussion')->serializeForm(array('isForm' => true, 'inline' => true));
$this->Js->get('#button-save-discussion')->event(
    'click',
    $this->Js->request(
        array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'edit', $discussion['Discussion']['id']),
        array('async' => true, 
        	'update' => '#post-body', 
        	'method' => 'post', 
        	'data' => $data,
        	'dataExpression' => true,
        	//'success' => '$("#ajax-loader").hide();',
        	//'before'  => '$("#ajax-loader").show();'
        )
    )
);
?>
<?php endif;?>

<hr />

<?php  echo $this->element('comments/comments', array( "comments" => $comments, "discussion" => $discussion['Discussion']));?>
<!--div class="paging">
	<?//php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?//php echo $this->Paginator->numbers();?>
	<?//php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div-->