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
							<a  href="<?=make_url('dashboard-faculty')?>"><i class="clip-home-3"></i>
								<span class="title"> Dashboard </span><span class="selected"></span>
							</a>
						</li >
						<li class="<?=($pagemod=='attendance')?'active':''?>">
							<a href="<?=make_url('attendance-student')?>"><i class="clip-users-2 "></i>
								<span class="title"> Attendance </span><span class="selected"></span>
							</a>
						</li>
						<li class="<?=($pagemod=='homework')?'active':''?>">
							<a href="<?=make_url('homework-create')?>"><i class="clip-book  "></i>
								<span class="title"> Home Work </span>
								<span  class="selected"></span>
							</a>
							
						</li>
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
						<li class="<?=($pagemod=='exams')?'active open':''?>">
							<a href="javascript:void(0)"><i class="clip-pencil"></i> 
								<span class="title"> Exams </span>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu">
								<li class="<?=($page=='exams-createclasstest')?'active':''?>">
									<a href="<?=make_url('exams-createclasstest')?>">
										<span class="title"> Class Test </span>
									</a>
								</li>
								<li class="<?=($page=='exams-createacademictest')?'active':''?>">
									<a href="<?=make_url('exams-createacademictest')?>">
										<span class="title"> Academic Test </span>
									</a>
								</li>
							</ul>	
						</li>
                        <li class="<?=($pagemod=='timetable')?'active':''?>">
							<a href="<?=make_url('timetable-facultyView')?>"><i class="fa fa-calendar"></i>
								<span class="title">Time Table</span>
								<span class="selected"></span>
							</a>
						</li>
						<li class="<?=($pagemod=='noticeboard')?'active':''?>">
							<a href="<?=make_url('noticeboard-noticeboard')?>"><i class="clip-clipboard"></i>
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
						<li class="<?=($pagemod=='reports')?'active open':''?>">
							<a href="javascript:void(0)"><i class="clip-bars"></i>
								<span class="title"> Reports </span>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu">
								<li class="<?=($page=='reports-reports')?'active':''?>">
									<a href="<?=make_url('reports-reports')?>">
										<span class="title">Test Report</span>
									</a>
								</li>
								<li class="<?=($page=='reports-academicreports')?'active':''?>">
									<a href="<?=make_url('reports-academicreports')?>">
										<span class="title"> Academic Report</span>
									</a>
								</li>
							</ul>	
						</li>
						<li class="<?=($pagemod=='profile')?'active ':''?>">
							<a href="<?=make_url('profile-faculty')?>">
								<i class="clip-user "></i>
								<span class="title"> Profile</span>
								<span class="selected"></span>
							</a>
							
						</li>
						
						
					</ul>
					<!-- end: MAIN NAVIGATION MENU -->
				</div>
				<!-- end: SIDEBAR -->
			</div>