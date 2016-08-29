<?
	function display_form_error_backup()
	{
		$login_session =new user_session();
		if($login_session->isset_pass_msg()):
			$array=$login_session->get_pass_msg();
			?>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
			<tr>
				<td align="center" valign="top"  style="color:#C7533D;line-height:15px;font-size:13px;padding-top:10px">
					<? foreach ($array as $value):
						  echo $value;
					 endforeach;?>
				</td>
			</tr>
			</table>
			<br/>
		<?
		endif;
		$login_session->isset_pass_msg()?$login_session->unset_pass_msg():'';
	}
	function display_form_error()
	{
		$login_session =new user_session();
		if($login_session->isset_pass_msg()):
			$array=$login_session->get_pass_msg();
			?>
			<div class="errorHandler alert alert-info">
					<i class="fa fa-times-sign"></i>
					<? foreach ($array as $value):
						  echo $value;
					 endforeach;?>
		
			</div>
			<br/>
		<?
		endif;
		$login_session->isset_pass_msg()?$login_session->unset_pass_msg():'';
	}
	
	function check_logged_in()
	{
		$login_session =new user_session();
		if($login_session->is_logged_in() && $login_session->is_verified()):
			return 1;
		elseif($login_session->is_logged_in() && !$login_session->is_verified()):
			Redirect(make_url('myaccount'));
		else:
			return 0;
		endif;
	}
	function check_logged_in_loged($meaage)
	{
		$login_session =new user_session();
		if(!$login_session->is_logged_in()):
		$login_session->pass_msg[]=$meaage;
		$login_session->set_pass_msg();
		Redirect(make_url('login-signin'));
                exit;
		endif;
	}
	function check_userType()
	{
	 $login_session =new user_session();
	 $login_session->get_usertype();
	}
	function check_logged_in_for_myaccount($userType='school')
	{
	     global $page;
		$login_session =new user_session();
		#check login status
		if(!$login_session->is_logged_in()):
            $login_session->pass_msg[]='You must be logged in to view this page';
	        $login_session->set_pass_msg();
	        $login_session->set_success();
			Redirect(make_url('login-signin'));
		endif;
        #check permissions
		
		if($login_session->get_usertype()=='student' && $login_session->get_usertype()!=$userType):
			$login_session->pass_msg[]='You have no permissions to this section';
		    $login_session->set_pass_msg();
		    $login_session->set_success();
			global $userLoginTypeArray;
		    Redirect(make_url($userLoginTypeArray[$login_session->get_usertype()]));
		endif;
		if($login_session->get_usertype()=='student' && $login_session->get_usertype()==$userType):
			 $getModuleList=get_object_by_query('faculty_designation as a,faculty_designation_access_rights as b','a.faculty_designation="students" and b.faculty_designation_id=a.faculty_designation_id');
			$moduleList=explode(',',$getModuleList->faculty_designation_access_module);
			if(!in_array($page,$moduleList)):
			  $login_session->pass_msg[]='You have no permissions to this section';
		      $login_session->set_pass_msg();
		      $login_session->set_success();
			  global $userLoginTypeArray;
		      Redirect(make_url($userLoginTypeArray[$login_session->get_usertype()]));
			 endif; 
		endif;
		if($login_session->get_usertype()=='school' && $userType=='student'):
			$login_session->pass_msg[]='You have no permissions to this section';
		    $login_session->set_pass_msg();
		    $login_session->set_success();
			global $userLoginTypeArray;
		    Redirect(make_url($userLoginTypeArray[$login_session->get_usertype()]));
		endif;
		if($login_session->get_usertype()=='faculty'):
		    $facultyDetail=get_object_by_query('faculty as a,faculty_designation_access_rights as b','a.faculty_id="'.$login_session->get_user_id().'" and b.faculty_designation_id=a.faculty_designation');
			$moduleList=explode(',',$facultyDetail->faculty_designation_access_module);
			if(!in_array($page,$moduleList)):
			  $login_session->pass_msg[]='You have no permissions to this section';
		      $login_session->set_pass_msg();
		      $login_session->set_success();
			  global $userLoginTypeArray;
		      Redirect(make_url($userLoginTypeArray[$login_session->get_usertype()]));
			 endif;  
		endif;
		  
	}
	function check_logged_in_for_login()
	{
		$login_session =new user_session();
		if($login_session->is_logged_in()):
		global $userLoginTypeArray;
			Redirect(make_url($userLoginTypeArray[$login_session->get_usertype()]));
		endif;
	}
		
	function page_redirect($url)
	{
		$login_session= new user_session();
		$login_session->redirect_url=$url;
		$login_session->set_redirect_url();
	}
	function check_logOff_Time()
	{
	    $login_session =new user_session();
		if($login_session->is_logged_in() && !$login_session->get_remember_me()):
			if($login_session->get_logOff_Time()<=time()):
			  $login_session->logout_user();
			  $login_session->pass_msg[]='Session expired. Please login';
	          $login_session->set_pass_msg();
	          $login_session->set_success();
			  Redirect(make_url('login-signin'));
			else:
		     $login_session->logOff_Time=strtotime("+30 minutes");
		     $login_session->set_logOff_Time();
		    endif;
		endif;
	}
	function check_remember_me()
	{
	    $login_session =new user_session();
		if(!$login_session->is_logged_in() && isset($_COOKIE['school_gennie_user_id'])):
		#set userid
		$login_session->user_id=$_COOKIE['school_gennie_user_id'];
		$login_session->verified=1;
		$login_session->set_user_id();	
		#set set schoolId
		$login_session->schoolId=$_COOKIE['school_gennie_schoolId'];
		$login_session->set_schoolId();
		#set username
		$login_session->username=$_COOKIE['school_gennie_username'];
		$login_session->set_username();
		#set useremail
		$login_session->useremail=$_COOKIE['school_gennie_useremail'];
		$login_session->set_useremail();
		#set usertype
		$login_session->usertype=$_COOKIE['school_gennie_usertype'];
		$login_session->set_usertype();
		
		#set remember me
		$login_session->remember_me=1;
		$login_session->set_remember_me();
		
		
		Redirect(make_url($_COOKIE['school_gennie_redirectUrl']));
		endif;
		
	}
	function account_registration_process_check($val,$redirectionUrl='register')
	{
		if($val==''):
		  Redirect(make_url($redirectionUrl));
		endif;
	}
	
	function change_password_status_check()
	{
	 $login_session =new user_session();
	 if($login_session->is_logged_in() and $_GET['page']!='profile-'.$login_session->get_usertype().'changepassword'):
	 $userType=$login_session->get_usertype();
	 $userId=$login_session->get_user_id();
	 $userDetails=get_object_by_query($userType,$userType.'_id='.$userId);
	 if($userDetails && $userDetails->change_password_status==0):
	        $login_session->pass_msg[]='Please change your password';
	       $login_session->set_pass_msg();
	       $login_session->set_success();
	    Redirect(make_url('profile-'.$userType.'changepassword'));
	 endif;
	 endif;
	}

       function checkPermission()
       {
           $convert=array('development','/','.html');
           $to=array('','','');
           $url=str_replace($convert, $to1, $_SERVER[REQUEST_URI]);
           $query=get_object_by_query('permissions','page="'.$url.'"');
           $login_session =new user_session();
           if($query && $query->permission==1 && !$login_session->is_logged_in()):
               
               $login_session->pass_msg[]='You must be logged in to view this page';
	       $login_session->set_pass_msg();
	       $login_session->set_success();
	       Redirect(make_url('login-signin'));
           endif;
            if($query && $query->permission==1 && $login_session->is_logged_in() && $login_session->get_usertype()==1):
               
               $login_session->pass_msg[]='You have no permissions to this section';
	       $login_session->set_pass_msg();
	       $login_session->set_success();
	       Redirect(make_url('login-signin'));
           endif;
        }



      function checkStandardUserPortfolioPermission()
{
$login_session =new user_session();
if($login_session->get_usertype()=='standard'):
$userDetails=get_object_by_query('user','id='.$login_session->get_user_id());
$checkPortfolioPermission=get_object_by_query('StandardUsers','code="'.$userDetails->userCode.'"');
if($checkPortfolioPermission->portfolioPermission==0):
               $login_session->pass_msg[]='you are not authenticated to view this section ';
	       $login_session->set_pass_msg();
	       $login_session->set_success();
	       Redirect(make_url('myaccountAfterCode'));
endif;
endif;
}

function getStandardUserParentDetail()
{
$login_session =new user_session();
$userDetails=get_object_by_query('user','id='.$login_session->get_user_id());
$checkPortfolioPermission=get_object_by_query('StandardUsers','code="'.$userDetails->userCode.'"');
$parenUserDetails=get_object_by_query('user','id='.$checkPortfolioPermission->userId);
return $parenUserDetails;
}





?>
