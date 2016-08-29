		<div id="app-controler">
			<ul id="app-tabs">
				<li class="<?=($page=='administration-class')?'active':''?>"><a href="<?=make_long_url('administration-class');?>" >Class</a></li>
				<li class="<?=($page=='administration-student')?'active':''?>"><a href="<?=make_long_url('administration-student');?>" >Student</a></li>
				<li class="<?=($page=='administration-faculty')?'active':''?>"><a href="<?=make_long_url('administration-faculty');?>" >Faculty</a></li>
				<li class="<?=($page=='administration-subject')?'active ':''?>"><a href="<?=make_long_url('administration-subject');?>" >Subject</a></li>
                <li class="<?=($page=='administration-role')?'active ':''?>last-tab"><a href="<?=make_long_url('administration-role');?>" >Role</a></li>
			</ul>
		</div>