<div id="discussion-comments">
<?php if(count($comments)):?>
	<table cellpadding="0" cellspacing="0" class='long-table list'>
	<?php foreach ($comments as $comment): ?>
		<?php  echo $this->element('comments/comment', array( "comment" => $comment, "discussion" => $discussion ));?>
	<?php endforeach; ?>
	</table>
<?php endif;?>
</div>

<?php if($discussion['status']):?>
<?php  echo $this->element('comments/comment_form', array("discussion" => $discussion));?>
<?php endif;?>