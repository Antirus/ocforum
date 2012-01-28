<?php
Router::connect('/settings/general/*', array('plugin' => 'settings', 'controller' => 'settings', 'action' => 'general'));

Router::connect('/admin/permissions/*', array('plugin' => 'settings', 'controller' => 'permissions', 'action' => 'admin_permissions',));