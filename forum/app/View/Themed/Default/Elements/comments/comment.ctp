<tr id="comment_<?php echo $comment['Comment']['id']?>">
	<td>
		<?php if(isset($discussion_link) && $discussion_link): ?>
			<?php echo $this->Html->link($comment['Discussion']['title'], array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'view', $comment['Discussion']['id'])); ?>
		<?php endif; ?>
		<p><?php echo __('Autor', true)?>: <?php echo $Members->userName($comment['Comment']['user_id'], $comment['Comment']['user_type']) ?>, 
		<?php echo __('Date', true)?>: <?php echo $comment['Comment']['date'] ?>
		</p>
		<div id="body_comment_<?php echo $comment['Comment']['id']?>">
		<?php $this->Bbcode->parsebbcode($comment['Comment']['body']) ?>
		</div>
		<?php if($Members->isOwner($comment['Comment']['user_id'], $comment['Comment']['user_type'])): ?>
		<div class="row">
			<div class="eight columns ">
				
			</div>
			<div class="four columns align-right">
				<a href="javascript:{}" class="small white button" id="button-delete-comment_<?php echo $comment['Comment']['id']?>"><?php echo _('delete')?></a>
				<?php echo $this->Html->link('edit', 'javascript:jQuery(".hidden-form").hide(); jQuery("#edit-comment_'.$comment['Comment']['id'].'").show()', array('class' => 'small white button')); ?>
			</div>
		</div>

		<div class="comment-edit form">
			<?php echo $this->Form->create('Comment', 
					array('inputDefaults' => array(
				        'label' => false,
				        'div' => false
				    ),
				    'class' => 'nice hidden-form',
				    'id' => 'edit-comment_'. $comment['Comment']['id'],
				    'default' => 'ajax'
			    )
			);?>
			<?php  echo $this->element('bbcode_description');?>
			<?php
				echo $this->Form->input('body', array('label' => false, 'class' => 'comment-body', 'value' => $comment['Comment']['body']));
			?>
			<div class="row">
				<div class="eight columns ">
					
				</div>
				<div class="four columns align-right">
					<a href='javascript:jQuery("#edit-comment_<?php echo $comment['Comment']['id']?>").hide()' class="small blue button"><?php echo _('close')?></a>
					<a href="javascript:{}" class="small blue button" id="button-add-comment_<?php echo $comment['Comment']['id']?>"><?php echo _('save')?></a>
				</div>
			</div>
			<?php echo $this->Form->end(); ?>
			</div>

			<?php 
			$data =  $this->Js->get('#edit-comment_'. $comment['Comment']['id'])->serializeForm(array('isForm' => true, 'inline' => true));
			// echo $this->Html->scriptBlock(
			//     'var $j = jQuery.noConflict();',
			//     array('inline' => false)
			// );
			$this->Js->get('#button-add-comment_'.$comment['Comment']['id'])->event(
			    'click',
			    $this->Js->request(
			        array('plugin' => 'comments', 'controller' => 'comments', 'action' => 'edit', $comment['Comment']['id']),
			        array('async' => true, 
			        	'update' => '#body_comment_'.$comment['Comment']['id'], 
			        	'method' => 'post', 
			        	'data' => $data,
			        	'dataExpression' => true
			        )
			    )
			);


			$this->Js->get('#button-delete-comment_'.$comment['Comment']['id'])->event(
			    'click',
			    $this->Js->request(
			        array('plugin' => 'comments', 'controller' => 'comments', 'action' => 'delete', $comment['Comment']['id']),
			        array('async' => true, 
			        	'update' => '#discussion-comments', 
			        	'method' => 'post', 
			        	//'data' => '',
			        	'dataExpression' => true
			        )
			    )
			);
			?>
		<?php endif;?>

	</td>
</tr>
<!--hr /-->

