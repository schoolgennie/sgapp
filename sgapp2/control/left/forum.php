<h3>Topics</h3>
<ul class="nav">
    <? if($_GET['action']=='list' || $_GET['action']=='insert' || $_GET['action']=='update'):?>
		<li><a href="<?php echo make_admin_url('forum', 'insert', 'insert', 'category_id='.$categoryId);?>">New Topic</a></li>
		<li><a href="<?php echo make_admin_url('forum', 'list', 'list', 'category_id='.$categoryId);?>">Topic Listing</a></li>
	<?php endif;?>
	<li class="last"><a href="<?php echo make_admin_url('forum_category', 'list', 'list');?>">Category Listing</a></li>
</ul>

