<?php
Router::connect('/category', array('plugin' => 'categories', 'controller' => 'categories', 'action' => 'index',));
Router::connect('/category/view/*', array('plugin' => 'categories', 'controller' => 'categories', 'action' => 'view',));
Router::connect('/admin/category/all/*', array('plugin' => 'categories', 'controller' => 'categories', 'action' => 'admin_index',));
Router::connect('/admin/category/add/*', array('plugin' => 'categories', 'controller' => 'categories', 'action' => 'admin_add',));
Router::connect('/admin/category/delete/*', array('plugin' => 'categories', 'controller' => 'categories', 'action' => 'admin_delete',));
Router::connect('/admin/category/edit/*', array('plugin' => 'categories', 'controller' => 'categories', 'action' => 'admin_edit',));