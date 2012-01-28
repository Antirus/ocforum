<?php
Router::connect('/create', array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'create',));
Router::connect('/view/*', array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'view',));
Router::connect('/admin/discussions/all/*', array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'admin_index',));
Router::connect('/admin/discussions/view/*', array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'admin_view',));
Router::connect('/admin/discussions/edit/*', array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'admin_edit',));
Router::connect('/admin/discussions/delete/*', array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'admin_delete',));