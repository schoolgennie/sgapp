
<h3>Content Listing</h3>
<ul class="nav">
	<li><a href="<?php echo make_admin_url('taskContent', 'list', 'list','cid='.$cid);?>">Content Listing</a></li>
	<li class="last"><a href="<?php echo make_admin_url('taskContent', 'list', 'insert','cid='.$cid);?>">New content</a></li>
	
</ul>
<a href="<?php echo make_admin_url('practiceTask', 'list', 'list','cid='.$getCatQueryObj->parent_id);?>"  class="link">Tasks</a>

