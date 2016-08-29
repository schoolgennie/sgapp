<?php 
check_logged_in_for_myaccount('school');
$school_id=$login_session->get_user_id();
$subject_id=isset($_POST['subject_id'])?$_POST['subject_id']:'0';
$subject_is_active=isset($_POST['subject_is_active'])?$_POST['subject_is_active']:'0';
$subject_name=isset($_POST['subject_name'])?$_POST['subject_name']:'0';

if(isset($_POST['mode'])):

	switch($_POST['mode'])
	 {
	   case 'editsubject':
		  # add validations
			$validation=new user_validation();
			$validation->add('subject_name', 'req','subject name');	
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			        #check entered class aleady exist or not
					$checkSubject=get_object_by_query('subject','subject_name="'.$subject_name.'" and school_id="'.$school_id.'"');
					#if exist
					if($checkClass):
						$result='Entered subject already exist';
					else:
						$data['subject_name']=$subject_name;
						$where="subject_id='".$subject_id."' and school_id='".$school_id."'";																																																																																			
						update_record_in_table('subject',$where,$data);
						$subjectDetails=get_object_by_query('subject','subject_id='.$subject_id);
					endif;		
			 endif;	
			 echo $result;
			 exit;
	   break;
	   case 'activeDeativeSubject':
	        $data['subject_is_active']=$subject_is_active;
		    update_record_in_table('subject',"subject_id='".$subject_id."' and school_id='".$school_id."'",$data);
		    exit;
	   break;

	}				

endif;		


?>				