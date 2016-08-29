<h3>Task Listing</h3>
<ul class="nav">
	<li><a href="<?php echo make_admin_url('practiceTask', 'list', 'list','cid='.$cid);?>">Task Listing</a></li>
	<li class="last"><a href="<?php echo make_admin_url('practiceTask', 'list', 'insert','cid='.$cid);?>">New Task</a></li>
	
</ul>
<a href="<?php echo make_admin_url('bestpractices', 'list', 'list','cid='.$getCatQueryObj->parent_id);?>"  class="link">Best Practices</a>
