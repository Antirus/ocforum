<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
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
		<!-- header -->
		<div class="row" id="header">
			<div class="twelve columns">
				<div class="six columns">
					<h2><a href='/forum'><?php echo $forum_name ?></a></h2>
					<p><?php echo $forum_slogan ?></p>
				</div>
				<div class="six columns">
					<?php echo $this->element('menu/main_menu');?>
					
				</div>
				<hr />
			</div>
		</div>

		<div class="row" id="flash">
			<div class="twelve columns">
				<?php echo $this->Session->flash(); ?>
			</div>
		</div>
		<!--div class="row" id="flash">
			<div class="eleven columns">
						
			</div>
			<div class="one columns">
				<img src="<?php echo $this->Html->url('/theme/Default/images/ajax-loader.gif', true); ?>" id="ajax-loader"/>	
			</div>
		</div-->
		
		<!-- end header -->
		<div class="row" id="content">
			<!-- sidebar -->
			<div class="eight columns" id="left-content">
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
			</div>
			<!-- end content -->
			<!-- sidebar -->
			<div class="four columns" id="right-content">			
				
				<?php echo $this->element('sidebar/category_list');?>
				<?php echo $this->element('sidebar/lates_discussions');?>
				<?php echo $this->element('sidebar/lates_comments');?>

				<p><?php echo $sidebar_text; ?></p>

				<!--h4>Other Resources</h4>
				<p>Once you've exhausted the fun in this document, you should check out:</p>
				<ul class="disc">
					<li><a href="http://foundation.zurb.com/docs">Foundation Documentation</a><br />Everything you need to know about using the framework.</li>
					<li><a href="http://github.com/zurb/foundation">Foundation on Github</a><br />Latest code, issue reports, feature requests and more.</li>
					<li><a href="http://twitter.com/foundationzurb">@foundationzurb</a><br />Ping us on Twitter if you have questions. If you build something with this we'd love to see it (and send you a totally boss sticker).</li>
				</ul-->
			</div>
			<!-- end sidebar -->
		</div>

		<div class="row">
			<div class="twelve columns">	
				<hr>
			</div>
		</row>
		<div class="row" id="footer">
			<?php echo $footer_text ?>
		</div>
		<div class="row">
			<div class="twelve columns">	
				<hr>
			</div>
		</row>
		<div class="row" id="footer">
			<div class="two columns">
				
			</div>
			
			<div class="ten columns align-right">
				<?php echo $this->Html->link(
						$this->Html->image('cake.power.gif', array('alt' => '', 'border' => '0')),
						'http://www.cakephp.org/',
						array('target' => '_blank', 'escape' => false)
					);
				?>
			</div>
			
		</div>

	</div>
	<?//php echo $this->element('sql_dump'); ?>
</body>
</html>