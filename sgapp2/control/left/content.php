
<h3>Content Pages</h3>
<ul class="nav">
	<li><a href="<?php echo make_admin_url('content', 'list', 'list');?>">Pages Home</a></li>
	<li class="last"><a href="<?php echo make_admin_url('content', 'list', 'insert');?>">New Page</a></li>
	<? if(isset($_GET['id']) && $_GET['id']!=''):?>
	<li class="last" style="border-top:1px #999999 dotted"><a href="<?php echo make_admin_url('subcontent', 'list', 'list','cid='.$_GET['id']);?>">Right Side Contents</a></li>
	<? endif;?>
</ul>
<?php /*?><a href="<?php echo make_admin_url('setting', 'list', 'list');?>" class="link">Settings</a><?php */?>