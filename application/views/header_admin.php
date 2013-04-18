<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $page_title;?></title>
	<script language="JavaScript" type="text/javascript" src="<?php echo base_url();?>assets/jquery.js"></script>
	<script language="JavaScript" type="text/javascript" src="<?php echo base_url();?>assets/wysiwyg.js"></script>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/wysiwyg.css"/>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/styles.css"/>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css"/>
</head>
<body>

<div id="container">
<div id="admin_menu">
<ul>
	<li><a href="<?php echo base_url()?>index.php/admin/">Dashboard</a></li>
	<li><a href="<?php echo base_url()?>index.php/admin/manage_users">Manage Users</a></li>
	<li><?php echo anchor('user/logout', 'Logout'); ?></li>
</ul>
</div>