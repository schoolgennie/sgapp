
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Admin</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title><?=SITE_NAME.' | Website Control Panel'?></title>
	<link href="<?=DIR_WS_SITE_CONTROL_CSS.'all.css'?>" media="screen" rel="stylesheet" type="text/css">
	<script src="<?php echo DIR_WS_SITE.ADMIN_FOLDER?>/js/jquery-1.2.6.min.js"></script>
	<script src="<?php echo DIR_WS_SITE.ADMIN_FOLDER?>/js/javascript.js"></script>
	<script src="<?php echo DIR_WS_SITE.ADMIN_FOLDER?>/js/validation.js"></script>
	<script type="text/javascript" src="<?=DIR_WS_SITE_JAVASCRIPT?>gen_validatorv4.js"></script>
</head>
<body>
<div id="main">
	<div id="header">
		<h1><a href="<?php echo make_url('home')?>" class="logo"><span id="logo"><?=SITE_NAME?></a></a></h1>
		<ul id="top-navigation">
			<?php /*?><li <?php css_active($Page, 'home', 'active');?>><span><span><a href="<?php echo make_admin_url('home', 'list', 'list');?>">Dashboard</a></span></span></li>
			<li <?php css_active($Page, 'home_banner', 'active');?>><span><span><a href="<?php echo make_admin_url('home_banner', 'list', 'list');?>">Home top banners</a></span></span></li> 
			
			<li <?php css_active($Page, 'banner', 'active');?>><span><span><a href="<?php echo make_admin_url('banner', 'list', 'list');?>">Banners</a></span></span></li>
			
			<li <?php css_active($Page, 'user', 'active');?>><span><span><a href="<?php echo make_admin_url('user', 'list', 'list');?>">Users</a></span></span></li>
			
			<li <?php css_active($Page, 'place', 'active');?>><span><span><a href="<?php echo make_admin_url('place', 'list', 'list');?>">Places</a></span></span></li><?php */?>
			
			<li <?php css_active($Page, 'content', 'active');?>><span><span><a href="<?php echo make_admin_url('content', 'list', 'list');?>">Contents</a></span></span></li>
<li <?php css_active($Page, 'registrationType', 'active');?>><span><span><a href="<?php echo make_admin_url('registrationType', 'list', 'list');?>">Registration Types</a></span></span></li>
         <li <?php css_active($Page, 'factor', 'active');?>><span><span><a href="<?php echo make_admin_url('factor', 'list', 'list');?>">Factors</a></span></span></li>
		  <li <?php css_active($Page, 'roadmap', 'active');?>><span><span><a href="<?php echo make_admin_url('roadmap', 'list', 'list');?>">Roadmap</a></span></span></li>
		   <li <?php css_active($Page, 'bestpractices', 'active');?>><span><span><a href="<?php echo make_admin_url('bestpractices', 'list', 'list');?>">Best Practices</a></span></span></li>
              <li <?php css_active($Page, 'forum_category', 'active');?>><span><span><a href="<?php echo make_admin_url('forum_category', 'list', 'list');?>">Discussion Board</a></span></span></li>
              <li <?php css_active($Page, 'contactus', 'active');?>><span><span><a href="<?php echo make_admin_url('contactus', 'list', 'list');?>">Contact Us</a></span></span></li>
            
           			
			<li <?php css_active($Page, 'Logout', 'active');?>><span><span><a href="<?php echo make_admin_url('logout', 'list', 'list');?>">Logout</a></span></span></li>
		</ul>
	</div>
	<div id="middle">
<?php include_once(DIR_FS_SITE.'control/include/left.php');?>
