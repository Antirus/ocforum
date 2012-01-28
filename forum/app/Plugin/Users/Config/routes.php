<?php
Router::connect('/users', array('plugin' => 'users', 'controller' => 'users', 'action' => 'index',));
Router::connect('/login', array('plugin' => 'users', 'controller' => 'users', 'action' => 'login',));

Router::connect('/admin/groups/admins/all/*', array('plugin' => 'users', 'controller' => 'admingroups', 'action' => 'admin_list',));
Router::connect('/admin/groups/admins/add/*', array('plugin' => 'users', 'controller' => 'admingroups', 'action' => 'admin_add',));
Router::connect('/admin/groups/admins/edit/*', array('plugin' => 'users', 'controller' => 'admingroups', 'action' => 'admin_edit',));
Router::connect('/admin/groups/admins/delete/*', array('plugin' => 'users', 'controller' => 'admingroups', 'action' => 'admin_delete',));
Router::connect('/admin/groups/admins/adduser/*', array('plugin' => 'users', 'controller' => 'admingroups', 'action' => 'admin_adduser',));
Router::connect('/admin/groups/admins/deluser/*', array('plugin' => 'users', 'controller' => 'admingroups', 'action' => 'admin_deluser',));

Router::connect('/admin/groups/users/all/*', array('plugin' => 'users', 'controller' => 'usergroups', 'action' => 'admin_list',));
Router::connect('/admin/groups/users/add/*', array('plugin' => 'users', 'controller' => 'usergroups', 'action' => 'admin_add',));
Router::connect('/admin/groups/users/edit/*', array('plugin' => 'users', 'controller' => 'usergroups', 'action' => 'admin_edit',));
Router::connect('/admin/groups/users/delete/*', array('plugin' => 'users', 'controller' => 'usergroups', 'action' => 'admin_delete',));
Router::connect('/admin/groups/users/adduser/*', array('plugin' => 'users', 'controller' => 'usergroups', 'action' => 'admin_adduser',));
Router::connect('/admin/groups/users/deluser/*', array('plugin' => 'users', 'controller' => 'usergroups', 'action' => 'admin_deluser',));
