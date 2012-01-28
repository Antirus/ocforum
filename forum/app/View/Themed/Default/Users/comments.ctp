<?php echo $this->element('menu/user_tabs', array('active' => 'comments', 'user_id' => $user_id, 'user_type' => $user_type));?>
<p>&nbsp;</p>
<div class="row">
	<div class="twelve columns align-right">	
		Sort by:  <?php echo $this->Paginator->sort('date');?>
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
<?php foreach ($comments as $comment):?>		
		<?php  echo $this->element('comments/comment', array( "comment" => $comment, 'discussion_link' => true));?>
				
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
  	<?php echo $this->Paginator->numbers(array('tag' => 'li', 'separator' => false));?>
	<?php echo $this->Paginator->next('»', array('tag' => 'li'), null, array('class'=>'disabled', 'tag' => 'li'));?>
</ul>
<?php endif; ?>