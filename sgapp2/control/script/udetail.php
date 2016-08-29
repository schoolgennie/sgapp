<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
$code=generateCode(9);

if($id && checkTableExist('school')):
#fetch school info
$fetchData =get_object_by_query('school','school_id='.$id);
#fetch database version
$databaseVersion =get_object_by_query('database_version');
endif;
#handle actions here.
switch ($action):
	case'list':
		# get user details.
	
		break;
	
	case'update':
	 if(isset($_POST['update']) && $_POST['update']=='Update'):
		 # add validations
		$validation=new user_validation();
		$validation->add('school_code', 'req','school code');
		$validation->add('school_name', 'req','school name');	
		$validation->add('school_id', 'req','user id');	
		$validation->add('school_admin_name', 'req','admin name');
		$validation->add('school_admin_name', 'alpha','admin name');
		$validation->add('school_affiliation_no', 'req','affiliation no');
		$validation->add('school_affiliation_no', 'alphanum','affiliation no');
		$validation->add('school_phone1', 'num','Contact No. 1');
		$validation->add('school_phone2', 'num','Contact No. 1');
		$validation->add('school_email_id', 'req','Email id');
		$validation->add('school_email_id', 'email','Email id');
		$validation->add('school_fax', 'num','Fax');
		$validation->add('school_average_fee', 'num','average fee');
		$validation->add('school_country', 'req','Country');
		$validation->add('school_country', 'alpha','Country');
		$validation->add('school_state', 'req','State');
		$validation->add('school_state', 'alpha','State');
		$validation->add('school_city', 'req','city');
		$validation->add('school_city', 'alpha','city');
			
		
		
		# check validations.
		$valid= new valid();
		if($valid->validate($_POST, $validation->get())):
				$data=MakeDataArray($_POST, array('update','school_id'));
				$where="school_id='".$_POST['school_id']."'";																																																																																			
				update_record_in_table('school',$where,$data);
				$admin_user->set_pass_msg('This school info has been updated successfully.');
				Redirect(make_admin_url('udetail', 'list', 'list','id='.$id));                                        

		  else:
			  foreach($valid->error as $k=>$v):
			  $error.=$v.'<br/>';
			  endforeach;
			  $admin_user->set_pass_msg($error);
			  Redirect(make_admin_url('udetail', 'list', 'list','id='.$id)); 
	      endif;	
		endif;
		break;
	case'insert':
	     if(isset($_POST['insert']) && $_POST['insert']=='Insert'):
		 runSqlFile('../schooldatabase.sql');	
		 # add validations
		$validation=new user_validation();
		$validation->add('school_code', 'req','school code');
		$validation->add('school_name', 'req','school name');	
		$validation->add('school_id', 'req','user id');	
		$validation->add('school_admin_name', 'req','admin name');
		$validation->add('school_admin_name', 'alpha','admin name');
		$validation->add('school_affiliation_no', 'req','affiliation no');
		$validation->add('school_affiliation_no', 'alphanum','affiliation no');
		$validation->add('school_phone1', 'num','Contact No. 1');
		$validation->add('school_phone2', 'num','Contact No. 1');
		$validation->add('school_email_id', 'req','Email id');
		$validation->add('school_email_id', 'email','Email id');
		$validation->add('school_fax', 'num','Fax');
		$validation->add('school_average_fee', 'num','average fee');
		$validation->add('school_country', 'req','Country');
		$validation->add('school_country', 'alpha','Country');
		$validation->add('school_state', 'req','State');
		$validation->add('school_state', 'alpha','State');
		$validation->add('school_city', 'req','city');
		$validation->add('school_city', 'alpha','city');
		
		
		# check validations.
		$valid= new valid();
		if($valid->validate($_POST, $validation->get())):
	   
		  		$Data=MakeDataArray($_POST, array('insert','database_name','database_username','database_password'));
				$Data['school_is_active']=1;
				$Data['password']=$code;
				$QueryObj=new query('school');
				$QueryObj->Data=$Data;
				$QueryObj->Insert();
            	   #get max id
				   $maxid=get_object_by_query('school','','Max(school_id) as id')->id;
                   #create default designation
				   createDefaultDesignation($maxid);			 
				   $Name=$_POST['school_name'];
				   $schoolCode=$_POST['school_code'];
				   $UserId=$_POST['school_id'];
				   $Password=$code;
				   include_once(DIR_FS_SITE_INCLUDE_EMAIL.'newRegistrationLogindetails.php');
                   SendEmail('School Login Details ', $_POST['school_email_id'] , ADMIN_EMAIL, SITE_NAME, $contents,'','html');
                   $admin_user->set_pass_msg('This school has been registered successfully.');
			       Redirect(make_admin_url('udetail', 'list', 'list','id='.$id));                                         
		  else:
		      foreach($valid->error as $k=>$v):
			  $error.=$v.'<br/>';
			  endforeach;
			  $admin_user->set_pass_msg($error);
			  Redirect(make_admin_url('udetail', 'list', 'list','id='.$id));  
	      endif;	
		endif;
		break;
    case'migration':
	    if($databaseVersion->database_version =='7000'):
		  runSqlFile('dbmigration/dbmigration8000.sql');
		  update_record_in_table('database_version','database_version_id='.$databaseVersion->database_version_id,array('database_version'=>8000));	
	    elseif($databaseVersion->database_version =='6000'):
		  runSqlFile('dbmigration/dbmigration7000.sql');
		  update_record_in_table('database_version','database_version_id='.$databaseVersion->database_version_id,array('database_version'=>7000));	
	    elseif($databaseVersion->database_version =='5000'):
		  runSqlFile('dbmigration/dbmigration6000.sql');
		  update_record_in_table('database_version','database_version_id='.$databaseVersion->database_version_id,array('database_version'=>6000));	
	    elseif($databaseVersion->database_version =='4000'):
		  runSqlFile('dbmigration/dbmigration5000.sql');
		  update_record_in_table('database_version','database_version_id='.$databaseVersion->database_version_id,array('database_version'=>5000));	
	    elseif($databaseVersion->database_version =='3000'):
		  runSqlFile('dbmigration/dbmigration4000.sql');
		  update_record_in_table('database_version','database_version_id='.$databaseVersion->database_version_id,array('database_version'=>4000));	
	    elseif($databaseVersion->database_version =='2000'):
		  runSqlFile('dbmigration/dbmigration3000.sql');
		  update_record_in_table('database_version','database_version_id='.$databaseVersion->database_version_id,array('database_version'=>3000));	
		elseif($databaseVersion->database_version =='1000'):
		  runSqlFile('dbmigration/dbmigration2000.sql');
		  update_record_in_table('database_version','database_version_id='.$databaseVersion->database_version_id,array('database_version'=>2000));
		else:
		     echo 'Nothing to do';
		endif;
		 Redirect(make_admin_url('udetail', 'list', 'list','id='.$id)); 
	    break;	
	default:break;
endswitch;
?>
