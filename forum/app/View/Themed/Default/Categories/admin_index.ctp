<p>
<?php
//echo $this->Paginator->counter(array(
//'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
//));
?>

</p>
<div class="row max-width-none">
	<div class="ten columns">
		<h3><?php echo __('Categories');?></h3>
	</div>
	<div class="two columns align-right">
		<a href="<?php echo Router::url('/admin/category/add/token:'.$token) ?>" class="small blue button round"><?php echo _('add')?></a>
	</div>
</div>
<table cellpadding="0" cellspacing="0" class='long-table'>
<tr>
	<th><?php echo $this->Paginator->sort('id');?></th>
	<th><?php echo $this->Paginator->sort('name');?></th>
	<th><?php echo $this->Paginator->sort('count');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php foreach ($categories as $category): ?>
	<tr>
		<td>
			<?php echo $category['Category']['id']; ?>
		</td>
		<td>
			<?php echo $category['Category']['name']; ?>
		</td>
		<td>
			<?php echo $category['Category']['count']; ?>
		</td>
		<td class="actions align-right">
			<?//php echo $this->Html->link(__('View', true), array('action'=>'view', $category['Category']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true),'/admin/category/edit/'.$category['Category']['id'].'/token:'.$token); ?> | 
			<?php echo $this->Html->link(__('Delete', true), '/admin/category/delete/'.$category['Category']['id'].'/token:'.$token, null, sprintf(__('Are you sure you want to delete # %s?', true), $category['Category']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<ul class="pagination">
	<?php echo $this->Paginator->prev('«', array('tag' => 'li',), null, array('class'=>'disabled', 'tag' => 'li'));?>
  	<?php echo $this->Paginator->numbers(array('tag' => 'li', 'separator' => '',));?>
	<?php echo $this->Paginator->next(' »', array('tag' => 'li'), null, array('class'=>'disabled', 'tag' => 'li'));?>
</ul>