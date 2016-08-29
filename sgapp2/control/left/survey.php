<h3>Survey</h3>
<ul class="nav">
		
	<? if(!get_object_by_col('survey','roadmapId',$cid)):?><li class="last"><a href="<?php echo make_admin_url('survey', 'list', 'insert','cid='.$cid);?>">Add survey</a></li><? endif;?>
		<li><a href="<?php echo make_admin_url('roadmap', 'list', 'list');?>">Roadmap Listing</a></li>
	
</ul>
