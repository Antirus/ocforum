<dl class="nice contained tabs">
  <dd><a href="<?php echo $Members->getUserDiscussionsLink( $Members->getUserById($user_id, $user_type)) ?>" <?php if($active == 'discussions'){?> class="active" <?php }?>><?php echo __('Discussions') ?></a></dd>
  <dd><a href="<?php echo $Members->getUserCommentsLink($Members->getUserById($user_id, $user_type)) ?>" <?php if($active == 'comments'){?> class="active" <?php }?>><?php echo __('Comments') ?></a></dd>
</dl>