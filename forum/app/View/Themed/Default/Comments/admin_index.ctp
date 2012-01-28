<p>
<?php
//echo $this->Paginator->counter(array(
//'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
//));
?>

</p>
<div class="row max-width-none">
	<div class="ten columns">
		<h3><?php echo __('Discussions');?></h3>
	</div>
	<div class="two columns align-right">
	</div>
</div>
<table cellpadding="0" cellspacing="0" class='long-table'>
<tr>
	<th><?php echo $this->Paginator->sort('id');?></th>
	<th><?php echo $this->Paginator->sort('body');?></th>
	<th><?php echo $this->Paginator->sort('discussion_id');?></th>
	<th><?php echo $this->Paginator->sort('user_id');?></th>
	<th><?php echo $this->Paginator->sort('date');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php foreach ($comments as $comment): ?>
	<tr>
		<td>
			<?php echo $comment['Comment']['id']; ?>
		</td>
		<td>
			<?php echo $this->Html->link($comment['Comment']['body'],'/view/'.$comment['Comment']['discussion_id'], array('target' => '_blank')); ?>
		</td>
		<td>
			<?php echo $this->Html->link($comment['Discussion']['title'], array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'view', $comment['Discussion']['id']), array('target' => '_blank')); ?>
		</td>
		<td>
			<?php echo $Members->userName($comment['Comment']['user_id'], $comment['Comment']['user_type'], true, true) ?>
		</td>
		<td>
			<?php echo $comment['Comment']['date'] ?>
		</td>
		<td class="actions align-right">
			<?//php echo $this->Html->link(__('View', true), array('action'=>'view', $discussion['Discussion']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true),'/admin/comments/edit/'.$comment['Comment']['id'].'/token:'.$token); ?> | 
			<?php echo $this->Html->link(__('Delete', true), '/admin/comments/delete/'.$comment['Comment']['id'].'/token:'.$token, null, sprintf(__('Are you sure you want to delete # %s?', true), $comment['Comment']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<ul class="pagination">
	<?php echo $this->Paginator->prev('«', array('tag' => 'li',), null, array('class'=>'disabled', 'tag' => 'li'));?>
  	<?php echo $this->Paginator->numbers(array('tag' => 'li', 'separator' => '',));?>
	<?php echo $this->Paginator->next(' »', array('tag' => 'li'), null, array('class'=>'disabled', 'tag' => 'li'));?>
</ul>