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
	<th><?php echo $this->Paginator->sort('title');?></th>
	<th><?php echo $this->Paginator->sort('comments');?></th>
	<th><?php echo $this->Paginator->sort('views');?></th>
	<th><?php echo $this->Paginator->sort('user_id');?></th>
	<th><?php echo $this->Paginator->sort('category_id');?></th>
	<th><?php echo $this->Paginator->sort('date');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php foreach ($discussions as $discussion): ?>
	<tr>
		<td>
			<?php echo $discussion['Discussion']['id']; ?>
		</td>
		<td>
			<?php echo $this->Html->link($discussion['Discussion']['title'],'/view/'.$discussion['Discussion']['id'], array('target' => '_blank')); ?>
		</td>
		<td>
			<?php echo $discussion['Discussion']['comments']; ?>
		</td>
		<td>
			<?php echo $discussion['Discussion']['views']; ?>
		</td>
		<td>
			<?php echo $Members->userName($discussion['Discussion']['user_id'], $discussion['Discussion']['user_type'], true, true) ?>
		</td>
		<td>
			<?php echo $Categories->categoryName($discussion['Discussion']['category_id'], true, true) ?>
		</td>
		<td>
			<?php echo $discussion['Discussion']['date'] ?>
		</td>
		<td class="actions align-right">
			<?//php echo $this->Html->link(__('View', true), array('action'=>'view', $discussion['Discussion']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true),'/admin/discussions/edit/'.$discussion['Discussion']['id'].'/token:'.$token); ?> | 
			<?php echo $this->Html->link(__('Delete', true), '/admin/discussions/delete/'.$discussion['Discussion']['id'].'/token:'.$token, null, sprintf(__('Are you sure you want to delete # %s?', true), $discussion['Discussion']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<ul class="pagination">
	<?php echo $this->Paginator->prev('«', array('tag' => 'li',), null, array('class'=>'disabled', 'tag' => 'li'));?>
  	<?php echo $this->Paginator->numbers(array('tag' => 'li', 'separator' => '',));?>
	<?php echo $this->Paginator->next(' »', array('tag' => 'li'), null, array('class'=>'disabled', 'tag' => 'li'));?>
</ul>