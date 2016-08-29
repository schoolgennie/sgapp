<?
include_once(DIR_FS_SITE_INCLUDE.'commonModule.php');
#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);

$action=isset($_GET['action'])?$_GET['action']:'list';
$section=isset($_GET['section'])?$_GET['section']:'list';
$class=isset($_GET['class'])?$_GET['class']:'';
$faculty=isset($_GET['faculty'])?$_GET['faculty']:'';
$timeTableId=isset($_GET['timeTableId'])?$_GET['timeTableId']:'';
$timeTablePeriodId=isset($_GET['timeTablePeriodId'])?$_GET['timeTablePeriodId']:'';
$weekDay=isset($_GET['weekDay'])?$_GET['weekDay']:date('w');
# selected class faculty list
if($class):
# class detals
$classDetails=get_object_by_query('class','class_id='.$class.' and class_is_active=1');
  #authenticate class
  if(!$classDetails): #if no
            $login_session->pass_msg[]='url does not exist';
	        $login_session->set_pass_msg();
	        $login_session->set_success();
	        Redirect(make_url('timetable-timetable'));
  endif;

$facultyList=get_all_record_by_query('faculty_management as a, faculty as b, subject as c','a.class_id="'.$class.'" and b.faculty_id=a.faculty_id and c.subject_id=a.subject_id and  a.faculty_management_is_active=1 and b.faculty_is_active!=0 and c.subject_is_active=1 order by a.faculty_management_is_active desc');
endif;


if($faculty):
# faculty detals
$facultyDetails=get_object_by_query('faculty','faculty_id='.$faculty.' and faculty_is_active!=0');

  #authenticate time table
  if(!$facultyDetails): #if no
            $login_session->pass_msg[]='url does not exist';
	        $login_session->set_pass_msg();
	        $login_session->set_success();
	        Redirect(make_url('timetable-timetable'));
  endif;

endif;

#time table  list
$timeTableList=get_all_record_by_query('time_table');

#fetch class  list
$classList=get_all_record_by_query('class','class_is_active=1');

#fetch faculty  list
$allFacultyList=get_all_record_by_query('faculty','faculty_is_active!=0');

if($timeTableId):
  # get time table details
  $timeTableDetails =get_object_by_query('time_table','time_table_id='.$timeTableId);
  #authenticate time table
  if(!$timeTableDetails): #if no
            $login_session->pass_msg[]='url does not exist';
	        $login_session->set_pass_msg();
	        $login_session->set_success();
	        Redirect(make_url('timetable-timetable'));
  else:	
     # selected time table period list
     $assignPeriodToFacultyList=get_all_record_by_query('time_table_period','time_table_id="'.$timeTableId.'"');		
  endif;
endif;

#handle actions here.
switch ($action):
	case'list':
	   #active time table  
		$activeTimeTable=get_object_by_query('time_table','time_table_is_active=1');
		
		# selected time table period list
		if($activeTimeTable):
		$activeTimetablePeriodList=get_all_record_by_query('time_table_period','time_table_id="'.$activeTimeTable->time_table_id.'"');
		endif;
	break;
	case'insertTimetable':
	     # add class
		if(isset($_POST['CreateTimeTable'])):
		
		    # add validations
			$validation=new user_validation();
			$validation->add('time_table', 'req','Time Table Name');	
			$validation->add('time_table_period', 'arrayNoElementBlank','Period Name');	
			$validation->add('time_table_period_time', 'arrayNoElementBlank','Period Time');	
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			        #check entered time table aleady exist or not
					$checkTimeTable=get_object_by_query('time_table','time_table="'.$_POST['time_table'].'"');
					#if exist
					if($checkTimeTable):
						$login_session->pass_msg[]='time table already exists ! ';
						$login_session->set_pass_msg();
						$login_session->set_success();
						Redirect(make_url('timetable-timetable'));
					else:
						$data['time_table']=$_POST['time_table'];
						if(!$timeTableList):
						$data['time_table_is_active']=1;
						endif;
						if(insert_record_in_table('time_table',$data)):
							$maxid=get_object_by_query('time_table','','Max(time_table_id) as id')->id;
							foreach($_POST['time_table_period'] as $k=>$v):
								$data1['time_table_id']=$maxid;
								$data1['time_table_period']=$v;
								$data1['time_table_period_time']=$_POST['time_table_period_time'][$k];
								insert_record_in_table('time_table_period',$data1);
							endforeach;
						endif;	
						Redirect(make_url('timetable-timetable'));
					endif;	
			 else:
					   
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_url('timetable-timetable')); 
			 endif;			
			
		endif;	
		break;
	case'updateTimeTable':
	     # add class
		if(isset($_POST['CreateTimeTable'])):
		    # add validations
			$validation=new user_validation();
			$validation->add('time_table', 'req','Time Table Name');	
			$validation->add('time_table_period_old', 'arrayNoElementBlank','Period Name');	
			$validation->add('time_table_period_time_old', 'arrayNoElementBlank','Period Time');	
			$validation->add('time_table_period', 'arrayNoElementBlank','Period Name');	
			$validation->add('time_table_period_time', 'arrayNoElementBlank','Period Time');	
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			        #check entered time table aleady exist or not
					$checkTimeTable=get_object_by_query('time_table','time_table="'.$_POST['time_table'].'" and time_table_id!='.$timeTableId);
					#if exist
					if($checkTimeTable):
						$login_session->pass_msg[]='time table already exists ! ';
						$login_session->set_pass_msg();
						$login_session->set_success();
						Redirect(make_long_url('timetable-timetable','updateTimeTable','updateTimeTable','timeTableId='.$timeTableId));
					else:
						$data['time_table']=$_POST['time_table'];
						$where="time_table_id='".$timeTableId."'";
						if(update_record_in_table('time_table',$where,$data)):
						   #update previous record
							foreach($_POST['time_table_period_old'] as $k=>$v):
							    $data=array();
								$data['time_table_period']=$v;
								$data['time_table_period_time']=$_POST['time_table_period_time_old'][$k];
								$where="time_table_period_id='".$k."'";
								update_record_in_table('time_table_period',$where,$data);
							endforeach;
							#insert new record
							foreach($_POST['time_table_period'] as $k=>$v):
							    $data=array();
								$data['time_table_id']=$timeTableId;
								$data['time_table_period']=$v;
								$data['time_table_period_time']=$_POST['time_table_period_time'][$k];
								insert_record_in_table('time_table_period',$data);
							endforeach;
						endif;	
						Redirect(make_long_url('timetable-timetable','updateTimeTable','updateTimeTable','timeTableId='.$timeTableId));
					endif;	
			 else:
					   
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_url('timetable-timetable')); 
			 endif;			
			
		endif;	
		break;	
	case'assignPeriodToFaculty':
	     # add class
		if(isset($_POST['saveTimeTable'])):
		//print_r($_POST);exit;
		    # add validations
			$validation=new user_validation();
			$validation->add('class_id', 'req','class');	
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			         delete_record_from_table('time_table_management','class_id="'.$_POST['class_id'].'" and time_table_id="'.$timeTableId.'"');
			         foreach($_POST['faculty_management_id'] as $k=>$v):
					   $v=explode(',',$v);
					   if($v[0]):
					   #check entered record aleady exist or not
					   $check=get_object_by_query('time_table_management as a,faculty_management as b, faculty as c, subject as d','a.time_table_id="'.$timeTableId.'" and a.time_table_period_id="'.$_POST['time_table_period_id'][$k].'" and a.time_table_management_week_day="'.$_POST['time_table_management_week_day'][$k].'" and b.faculty_management_id=a.faculty_management_id and b.faculty_id="'.$v[1].'" and b.faculty_management_is_active=1 and c.faculty_id=b.faculty_id and d.subject_id=b.subject_id and c.faculty_is_active!=0 and d.subject_is_active=1');
					  
					   #if exist
					   if($check):
					          $login_session->pass_msg[]='record already exist !! ';
							  $login_session->set_pass_msg();
							  $login_session->set_success();
							  Redirect(make_long_url('timetable-timetable','assignPeriodToFaculty','assignPeriodToFaculty','timeTableId='.$timeTableId.'&class='.$_POST['class_id']));
							  exit;
					   else:		 
								$data['time_table_id']=$timeTableId;
								$data['class_id']=$_POST['class_id'];
								$data['faculty_management_id']=$v[0];
								//$data['faculty_id']=$_POST['faculty_id'][$k];
								$data['time_table_period_id']=$_POST['time_table_period_id'][$k];
								$data['time_table_management_week_day']=$_POST['time_table_management_week_day'][$k];
								insert_record_in_table('time_table_management',$data);
						endif;	
						endif;		
					 endforeach;
			         Redirect(make_long_url('timetable-timetable','assignPeriodToFaculty','assignPeriodToFaculty','timeTableId='.$timeTableId.'&class='.$_POST['class_id']));
			 else:
					   
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_long_url('timetable-timetable','assignPeriodToFaculty','assignPeriodToFaculty','timeTableId='.$timeTableId.'&class='.$_POST['class_id']));
			 endif;			
			
		endif;	
		break;
    case'changeTimeTable':
	     # add class
		if($timeTableId):					
						$data['time_table_is_active']=0;
						$where="time_table_is_active=1";																																																																																			
						update_record_in_table('time_table',$where,$data);
						$data1['time_table_is_active']=1;
						$where1="time_table_id='".$timeTableId."'";																																																																																			
						update_record_in_table('time_table',$where1,$data1);
						Redirect(make_url('timetable-timetable'));
						exit;
		endif;			
		
		break;
	 case'deletePeriod':
	    delete_record_from_table('time_table_period','time_table_period_id="'.$timeTablePeriodId.'"');
		Redirect(make_long_url('timetable-timetable','updateTimeTable','updateTimeTable','timeTableId='.$timeTableId));
		exit;
		break;
	case'deleteTimeTable':
	    delete_record_from_table('time_table','time_table_id="'.$timeTableId.'"');
		Redirect(make_url('timetable-timetable'));
		exit;
		break;	
	default:break;
endswitch;



			
?>
