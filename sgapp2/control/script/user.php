<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
isset($_GET['page'])?$page=$_GET['page']:$page='1';
$code=generateCode(9);
if($id):
$fetchData =get_object_by_col('school','school_id',$id);
endif;


#handle actions here.
switch ($action):
	case'list':
		$QueryObj=get_all_object_by_query('school','',true,$page,20);
		break;
	case'detail':
	           
		        #set database name
				$admin_user->database_name=$fetchData->school_code;
				$admin_user->set_database_name();
				Redirect(make_admin_url('udetail', 'list', 'list','id='.$id)); 
		break;
	case'insert':
	    if(isset($_POST['insert']) && $_POST['insert']=='Insert'):
		 # add validations
		$validation=new user_validation();
		$validation->add('school_code', 'req','school code');
		# check validations.
		$valid= new valid();
		if($valid->validate($_POST, $validation->get())):
	     # check username already exists?
		 $check_user=get_object_by_query('school','school_code="'.$_POST['school_code'].'"');
		 if(!$check_user):
		       #check data exist or not
		       if(checkDatabaseeIsExist($_POST['school_code'])):
			       $admin_user->set_pass_msg('Can\'t create database '.$_POST['school_code'].'.This database already exists.');
			       Redirect(make_admin_url('user', 'insert', 'insert')); 
				   exit;
			   endif;
		        createDatabaseIfNotExist($_POST['school_code']);
		  		$Data=MakeDataArray($_POST, array('insert'));
				$QueryObj=new query('school');
				$QueryObj->Data=$Data;
				if($QueryObj->Insert()):
				   #get max id
				   $maxid=get_object_by_query('school','','Max(school_id) as id')->id;
                   			   
					#set database name
					$admin_user->database_name=$_POST['school_code'];
					$admin_user->set_database_name();
					
					Redirect(make_admin_url('udetail', 'list', 'list','id='.$maxid));                                      
				else:
				   $admin_user->set_pass_msg(MSG_REGISTR_FAILED);
			       Redirect(make_admin_url('user', 'insert', 'insert'));                                        
				endif;
		  else: 
				$admin_user->set_pass_msg('This school code already exist');
			    Redirect(make_admin_url('user', 'insert', 'insert')); 
				
		  endif;
		  else:
		    foreach($valid->error as $k=>$v):
		      $error.=$v.'<br/>';
		    endforeach;
		    $admin_user->set_pass_msg($error);
		    Redirect(make_admin_url('user', 'insert', 'insert')); 
	      endif;	
		  endif;
		break;	
	case'update':
		 if(isset($_POST['update']) && $_POST['update']=='Update'):
		 # add validations
		$validation=new user_validation();
		$validation->add('school_code', 'req','school code');
			
		# check validations.
		$valid= new valid();
		if($valid->validate($_POST, $validation->get())):
	     # check username already exists?
		 $check_user=get_object_by_query('school','school_code="'.$_POST['school_code'].'" and school_id!="'.$_POST['school_id'].'"');
		 if(!$check_user):
		  		
						$data=MakeDataArray($_POST, array('update','school_id'));
						$where="school_id='".$_POST['school_id']."'";																																																																																			
						update_record_in_table('school',$where,$data);
					
                       $admin_user->set_pass_msg('This school info has been updated successfully.');
			           Redirect(make_admin_url('user', 'list', 'list','page='.$page));                                        
				                                      
				
		  else: 
				       $admin_user->set_pass_msg('This school code already exist');
			           Redirect(make_admin_url('user', 'update', 'update','id='.$id)); 
				
		  endif;
		  else:
					  foreach($valid->error as $k=>$v):
					  $error.=$v.'<br/>';
					  endforeach;
					  $admin_user->set_pass_msg($error);
					  Redirect(make_admin_url('user', 'update', 'update','id='.$id)); 
	      endif;	
		 endif;
		 break; 

	default:break;
endswitch;
?>
