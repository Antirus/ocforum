<div class="row max-width-none">
	<div class="ten columns">
		<h3><?php echo __('Edit Category');?></h3>
	</div>
	<div class="two columns align-right">
		<a href="<?php echo Router::url('/admin/category/all/token:'.$token) ?>" class="small blue button round"><?php echo _('list')?></a>
	</div>
</div>
<div class="categories form">
<?php echo $this->Form->create('Category', 
		array('inputDefaults' => array(
	        'label' => false,
	        'div' => false
	    ),
	    'class' => 'nice',
	    'id' => 'edit-category'
    )
 );?>
	
<?php echo $this->Form->input('id', array('class' => 'text'));//нужно указывать при редактировании в форме будет скрытый?>
<?php echo $this->Form->input('name', array('class' => 'input-text', 'label' => 'Category Name')); ?>

<?//php echo $this->Form->input('category_id', array('class' => 'text', 'div' => false, 'label' => 'Parent')); ?>

<a href="javascript:jQuery('#edit-category').submit()" class="small blue button round"><?php echo _('save')?></a>
<?php echo $this->Form->end();?>
</div>