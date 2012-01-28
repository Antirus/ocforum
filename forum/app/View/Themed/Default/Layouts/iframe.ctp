<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
	//jquery-1.7.1.min
		echo $this->Html->meta('icon');

		echo $this->Html->css(array('globals', 'typography', 'grid', 'ui', 'forms', 'orbit', 'reveal', 'mobile', 'app'));
		echo $this->Html->script(array('jquery-1.7.1.min'));
		echo $this->Js->writeBuffer();
		echo $scripts_for_layout;
	?>
</head>
<body>
	<div class="container">
	
			<!--
				<h3>The Grid</h3>
				<div class="row">
					<div class="twelve columns">
						<div class="panel">
							<p>This is a twelve column section in a row. Each of these includes a div.panel element so you can see where the columns are - it's not required at all for the grid.</p>
							
						</div>
					</div>
				</div> -->
				<?php echo $content_for_layout; ?>
			
			
				<hr>
			
	</div>
	<?//php echo $this->element('sql_dump'); ?>
</body>
</html>