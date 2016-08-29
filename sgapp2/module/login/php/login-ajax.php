<?
check_logged_in_for_login();
if(isset($_POST['mode'])):
	switch($_POST['mode'])
	 {
	  case 'databaseConnectIndividual':
	     $validation=new user_validation();
		 $validation->add('userId', 'req','userId');	
		 $validation->add('password', 'req','password');
		 # check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
				#get data base details
				$databaseDetails=get_object_by_query('school','school_code="'.$subDemainName.'"');
				if($databaseDetails):
				    
					#set database name
					$login_session->database_name=$databaseDetails->school_code;
					$login_session->set_database_name();
					
					echo '1';exit;
				endif;	
	      endif;	
		exit;			
	  break;  
	}				
endif;			
?>
