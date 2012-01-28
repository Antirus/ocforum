<?php if(count($comments)):?>
<div id="discussion-comments">
<table cellpadding="0" cellspacing="0" class='long-table list'>
<?php foreach ($comments as $comment): ?>
<?php  echo $this->element('comments/comment', array( "comment" => $comment ));?>
<?php endforeach; ?>
</table>
</div>
<?php endif; ?>