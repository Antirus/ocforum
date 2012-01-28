
<?php echo $header; ?>
<style>
iframe{
  border: none;
  width: 100%;
  height: 100%;
}
</style>
<div id="content">
<div class="breadcrumb">
  <?php foreach ($breadcrumbs as $breadcrumb) { ?>
  <?php echo $breadcrumb["separator"]; ?><a href="<?php echo $breadcrumb["href"]; ?>"><?php echo $breadcrumb["text"]; ?></a>
  <?php } ?>
</div>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?> 
<div class="box">
  <div class="heading">
    <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
    <div class="buttons"><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
  </div>
  <div class="content">
      <div id="tabs" class="htabs">
        <a href="#tab-general"><?php echo $tab_general; ?></a>
        <a href="#tab-categories"><?php echo $tab_categories; ?></a>
        <a href="#tab-permissions"><?php echo $tab_permissions; ?></a>
        <a href="#tab-discussions"><?php echo $tab_discussions; ?></a>
        <a href="#tab-comments"><?php echo $tab_comments; ?></a>
      </div>
      <div id="tab-general">
        <iframe src="/forum/settings/general/token:<?php echo $token ?>"></iframe>
      </div>
      <div id="tab-categories">
        <iframe src="/forum/admin/category/all/token:<?php echo $token ?>"></iframe>
      </div>
      <div id="tab-permissions">
        <iframe src="/forum/admin/permissions/token:<?php echo $token ?>"></iframe>
      </div>
      <div id="tab-discussions">
        <iframe src="/forum/admin/discussions/all/token:<?php echo $token ?>"></iframe> 
      </div>
      <div id="tab-comments">
        <iframe src="/forum/admin/comments/all/token:<?php echo $token ?>"></iframe>
      </div>
  </div>
</div>

<script type="text/javascript"><!--
$('#tabs a').tabs(); 
//--></script> 