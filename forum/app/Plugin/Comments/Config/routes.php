<?php
Router::connect('/admin/comments/all/*', array('plugin' => 'comments', 'controller' => 'comments', 'action' => 'admin_index'));
Router::connect('/admin/comments/edit/*', array('plugin' => 'comments', 'controller' => 'comments', 'action' => 'admin_edit',));
Router::connect('/admin/comments/delete/*', array('plugin' => 'comments', 'controller' => 'comments', 'action' => 'admin_delete',));
?>