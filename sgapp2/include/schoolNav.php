	<div class="navbar-content">
				<!-- start: SIDEBAR -->
				<div class="main-navigation navbar-collapse collapse">
					<!-- start: MAIN MENU TOGGLER BUTTON -->
					<div class="navigation-toggler">
						<i class="clip-chevron-left"></i>
						<i class="clip-chevron-right"></i>
					</div>
					<!-- end: MAIN MENU TOGGLER BUTTON -->
					<!-- start: MAIN NAVIGATION MENU -->
					<ul class="main-navigation-menu">
						<li class="<?=($pagemod=='dashboard')?'active':''?>">
							<a  href="<?=make_url('dashboard-school')?>"><i class="clip-home-3"></i>
								<span class="title"> Dashboard </span><span class="selected"></span>
							</a>
						</li >
						<li class="<?=($pagemod=='administration')?'active open':''?>">
							<a href="javascript:void(0)"><i class="clip-cog-2"></i>
								<span class="title"> Administration </span>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu">
								<li class="<?=($page=='administration-student')?'active':''?>">
									<a href="<?=make_url('administration-student')?>">
										<span class="title"> Student </span>
									</a>
								</li>
								<li class="<?=($page=='administration-faculty')?'active':''?>">
									<a href="<?=make_url('administration-faculty')?>">
										<span class="title"> Faculty </span>
									</a>
								</li>
                                <li class="<?=($page=='administration-class')?'active':''?>">
									<a href="<?=make_url('administration-class')?>">
										<span class="title"> Class </span>
									</a>
								</li>
								<li class="<?=($page=='administration-subject')?'active':''?>">
									<a href="<?=make_url('administration-subject')?>">
										<span class="title"> Subject </span>
									</a>
								</li>
								
							</ul>	
						</li>
						<li class="<?=($page=='administration-role')?'active':''?>">
									<a href="<?=make_url('administration-role')?>"><i class="clip-key"></i>
										<span class="title"> Role Based Privileges </span>
									</a>
						</li>
						<li class="<?=($page=='administration-preRegisteredStudent')?'active':''?>">
							<a  href="<?=make_url('administration-preRegisteredStudent')?>"><i class="clip-users-2"></i>
								<span class="title"> Lead Management </span>
								<span class="selected"></span>
							</a>
						</li >
                        <li class="<?=($pagemod=='fees')?'active open':''?>">
							<a href="javascript:void(0)"><i class="clip-banknote"></i>
								<span class="title"> Fees </span>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu">
								<li class="<?=($page=='fees-fees')?'active':''?>">
									<a href="<?=make_url('fees-fees')?>">
										<span class="title"> Fees Settings </span>
									</a>
								</li>
								<li class="<?=($page=='fees-collection')?'active':''?>">
									<a href="<?=make_url('fees-collection')?>">
										<span class="title"> Fees Collection </span>
									</a>
								</li>
							
							</ul>	
						</li>
                        <li class="<?=($pagemod=='waiver')?'active':''?>">
							<a href="<?=make_url('waiver-approval')?>"><i class="fa fa-calendar"></i>
								<span class="title">Fees Waiver</span>
								<span class="selected"></span>
							</a>
						</li>
						<li class="<?=($pagemod=='timetable')?'active':''?>">
							<a href="<?=make_url('timetable-timetable')?>"><i class="fa fa-calendar"></i>
								<span class="title">Time Table</span>
								<span class="selected"></span>
							</a>
						</li>
						<?php /*?><li class="<?=($pagemod=='exams')?'active open':''?>">
							<a href="javascript:void(0)"><i class="clip-pencil"></i>
								<span class="title"> CCE Examination </span>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu">
								<li class="<?=($page=='exams-skillsettings')?'active':''?>">
									<a href="<?=make_url('exams-skillsettings')?>">
										<span class="title"> Skills Settings </span>
									</a>
								</li>
								<li class="<?=($page=='exams-gradesettings')?'active':''?>">
									<a href="<?=make_url('exams-gradesettings')?>">
										<span class="title"> Grade Settings </span>
									</a>
								</li>
								<li class="<?=($page=='exams-indicators')?'active':''?>">
									<a href="<?=make_url('exams-indicators')?>">
										<span class="title"> Indicators List </span>
									</a>
								</li>
							
							</ul>	
						</li><?php */?>
						<li class="<?=($pagemod=='noticeboard')?'active':''?>">
							<a href="<?=make_url('noticeboard-noticeboard')?>"><i class="clip-screen"></i>
								<span class="title">Notice Board</span>
								<span class="selected"></span>
							</a>
							
						</li>
						<li class="<?=($pagemod=='message')?'active':''?>">
							<a href="<?=make_url('message-message')?>"><i class="clip-bubbles-2"></i>
								<span class="title">Message</span>
								<span class="selected"></span>
							</a>
							
						</li>
						<li  class="<?=($pagemod=='gallery')?'active':''?>">
							<a href="<?=make_url('gallery-gallery')?>"><i class="clip-pictures"></i>
								<span class="title">Gallery</span>
								<span class="selected"></span>
							</a>
							
						</li>
						<?php /*?><li  class="<?=($pagemod=='library')?'active':''?>">
							<a href="<?=make_url('library-library')?>"><i class="clip-book"></i>
								<span class="title">Library</span>
								<span class="selected"></span>
							</a>
							
						</li>
						<li  class="<?=($pagemod=='transport')?'active':''?>">
							<a href="<?=make_url('transport-transport')?>"><i class="fa fa-truck"></i>
								<span class="title">Transport</span>
								<span class="selected"></span>
							</a>
							
						</li><?php */?>
						<li class="<?=($pagemod=='reports')?'active open':''?>">
							<a href="javascript:void(0)"><i class="clip-bars"></i>
								<span class="title"> Reports </span>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu">
								<li class="<?=($page=='reports-preRegisteredStudent')?'active':''?>">
									<a href="<?=make_url('reports-preRegisteredStudent')?>">
										<span class="title">Admission Enquiry</span>
									</a>
								</li>
								 <li class="<?=($page=='reports-studentFee')?'active':''?>">
									<a href="<?=make_url('reports-studentFee')?>">
										<span class="title">Fees Report</span>
									</a>
								</li>
								<li class="<?=($page=='reports-reports')?'active':''?>">
									<a href="<?=make_url('reports-reports')?>">
										<span class="title"> Class Test</span>
									</a>
								</li>
								<li class="<?=($page=='reports-academicreports')?'active':''?>">
									<a href="<?=make_url('reports-academicreports')?>">
										<span class="title"> Academic Test</span>
									</a>
								</li>
                                <li class="<?=($page=='reports-student')?'active':''?>">
									<a href="<?=make_url('reports-student')?>">
										<span class="title">Students </span>
									</a>
								</li>
                                <li class="<?=($page=='reports-faculty')?'active':''?>">
									<a href="<?=make_url('reports-faculty')?>">
										<span class="title">Faculty </span>
									</a>
								</li>
							</ul>	
						</li>
						
						
						
					</ul>
					<!-- end: MAIN NAVIGATION MENU -->
				</div>
				<!-- end: SIDEBAR -->
			</div>