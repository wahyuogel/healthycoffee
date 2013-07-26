<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Healthy Coffee - Website Administrator</title>
<link href="<?php echo base_url(); ?>css/admin/dashboard_style.css" rel="stylesheet" type="text/css"/>
<style>
	@font-face
	{
		font-family:"Droid Sans";
		src:url(<?php echo base_url(); ?>fonts/DroidSans.ttf);
	}
</style>
</head>

<body>
<div id="header_box">
	<?php echo $this->load->view('admin/header_view'); ?>
</div>

<div id="sidebar_box">
	<?php echo $this->load->view('admin/sidebar_view'); ?>
</div>

<div id="content_box">
	<?php echo $content; ?>
</div>

<div id="footer_box">
	<?php echo $this->load->view('admin/footer_view'); ?>
</div>
</body>
</html>
