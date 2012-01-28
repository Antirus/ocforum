<?php echo $this->element('menu/user_tabs', array('active' => 'discussions', 'user_id' => $user_id, 'user_type' => $user_type));?>
<p>&nbsp;</p>
<div class="row">
	<div class="six columns ">	
		<?php echo $this->Html->link('Add New Discussion', '/create'); ?><br />
	</div>
	<div class="six columns align-right">	
		Sort by: <?php echo $this->Paginator->sort('title');?>, <?php echo $this->Paginator->sort('date');?>, <?php echo $this->Paginator->sort('views');?>, <?php echo $this->Paginator->sort('comments');?>
	</div>
</div>
<p>
<?php
//echo $this->Paginator->counter(array(
//'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
//));
?>
</p>
<table cellpadding="0" cellspacing="0" class='long-table list'>
<!--tr>
	<th><?php echo $this->Paginator->sort('id');?></th>
	<th><?php echo $this->Paginator->sort('name');?></th>
	<th><?php echo $this->Paginator->sort('pid');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr-->
<?php foreach ($discussions as $discussion):?>
	<tr>
		
		<td>

			<h4 class='discussion-title'><?php echo $this->Html->link($discussion['Discussion']['title'], array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'view', $discussion['Discussion']['id'])); ?></h4>
			<div><?php echo __('Autor', true)?>: <?php echo $Members->userName($discussion['Discussion']['user_id'], $discussion['Discussion']['user_type']) ?>,
				<?php echo __('Category', true)?>: <?php echo $Categories->categoryName($discussion['Discussion']['category_id']) ?>,
				<?php echo __('Date', true)?>: <?php echo $discussion['Discussion']['date'] ?>
			<?php ?></div>
		</td>
		<td class='td-comments'>
			<?php echo  __('Views', true);?> <br />
			<?php echo  $discussion['Discussion']['views'];?> 
		</td>
		<td class='td-comments'>
			<?php echo  __('Comments', true);?> <br />
			<?php echo  $discussion['Discussion']['comments'];?> 
		</td>
		<!--td class="actions">
			<?//php echo $this->Html->link(__('View', true), array('action'=>'view', $category['Category']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action'=>'edit', $discussion['Category']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action'=>'delete', $discussion['Category']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $discussion['Category']['id'])); ?>
		</td-->
	</tr>
<?php endforeach; ?>
</table>
<?php if($this->Paginator->hasPage(2)): ?>
<ul class="pagination">
	<?php echo $this->Paginator->prev('«', array('tag' => 'li',), null, array('class'=>'disabled', 'tag' => 'li'));?>
  	<?php echo $this->Paginator->numbers(array('tag' => 'li', 'separator' => '',));?>
	<?php echo $this->Paginator->next(' »', array('tag' => 'li'), null, array('class'=>'disabled', 'tag' => 'li'));?>
</ul>
<?php endif; ?>