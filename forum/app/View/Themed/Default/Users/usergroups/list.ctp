<p>
<?php
//echo $this->Paginator->counter(array(
//'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
//));
?>

</p>
<div class="row max-width-none">
	<div class="ten columns">
		<h3><?php echo __('Users Groups');?></h3>
	</div>
	<div class="two columns align-right">
		<a href="<?php echo Router::url('/admin/groups/admins/add/token:'.$token) ?>" class="small blue button round"><?php echo _('add')?></a>
	</div>
</div>
<table cellpadding="0" cellspacing="0" class='long-table'>
<tr>
	<th><?php echo $this->Paginator->sort('id');?></th>
	<th><?php echo $this->Paginator->sort('title');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>

<?php foreach ($groups as $group): ?>
	<tr>
		<td>
			<?php echo $group['UserGroup']['id']; ?>
		</td>
		<td>
			<?php echo $group['UserGroup']['title']; ?>
		</td>
		<td class="actions align-right">
			<?//php echo $this->Html->link(__('View', true), array('action'=>'view', $category['Category']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true),'/admin/category/edit/'.$group['UserGroup']['id'].'/token:'.$token); ?>
			<?php echo $this->Html->link(__('Delete', true), '/admin/category/delete/'.$group['UserGroup']['id'].'/token:'.$token, null, sprintf(__('Are you sure you want to delete # %s?', true), $group['UserGroup']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>