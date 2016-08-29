<?
class user_session
{
	var $user_id;
	var $logged_in=false;
	var $error='';
	var $pass_msg=array();
	var $pass_msg_flag=false;
	var $redirect_url;
	var $redirect_url_flag=false;
	var $msg_type=false;
	var $username;
	var $place_id;
	var $category_id;
	var $verified=false;
		
	function user_session()
	{
		if(!isset($_SESSION['user_session'])):
			$_SESSION['user_session']=array('user_id'=>'',
								'logged_in'=>false,
								'error'=>'',
								'pass_msg'=>array(),
								'pass_msg_flag'=>false,
								'verified'=>false,
								'place_id'=>false,
								'category_id'=>false,
								'redirect_url'=>'',
								'redirect_url_flag'=>false,
								'username'=>'',
								'msg_type'=>false);
		endif;
	}

	function is_logged_in()
	{
		if(!isset($_SESSION['user_session'])):
			return false;
		endif;
		
		if($_SESSION['user_session']['logged_in']):
			return true;
		else:
			$this->error='Sorry! you are not logged in.';
			return false;
		endif;
	}
	
	function logout_user()
	{
		if(!isset($_SESSION['user_session'])):
			return true;
		endif;
		if($_SESSION['user_session']['logged_in']):
			$_SESSION['user_session']['logged_in']=false;
			$_SESSION['user_session']['user_id']='';
			$_SESSION['user_session']['school_id']='';
			$_SESSION['user_session']['useremail']='';
			$_SESSION['user_session']['username']='';
			$_SESSION['user_session']['name']='';
			$_SESSION['user_session']['pass_msg']='';
			$_SESSION['user_session']['pass_msg_flag']=false;
			$_SESSION['user_session']['verified']=false;
			$_SESSION['user_session']['error']='';
			$_SESSION['user_session']['uniqueId']='';
			$_SESSION['user_session']['usertype']='';
			$_SESSION['user_session']['schoolId']='';
			$_SESSION['user_session']['logOff_Time']='';
			$_SESSION['user_session']['remember_me']='';
			//$_SESSION['user_session']['database_name']='';
			//$_SESSION['user_session']['database_username']='';
			//$_SESSION['user_session']['database_password']='';
			//unset($_SESSION['user_session']['database_host']);
			unset($_SESSION['user_session']['database_name']);
			//unset($_SESSION['user_session']['database_username']);
			//unset($_SESSION['user_session']['database_password']);
			      setcookie("school_gennie_user_id", '', time()-10);
				  setcookie("school_gennie_schoolId", '', time()-10);
				  setcookie("school_gennie_username",'', time()-10);
				  setcookie("school_gennie_useremail", '', time()-10);
				  setcookie("school_gennie_usertype",'', time()-10);
				  setcookie("school_gennie_redirectUrl", '', time()-10);
			return true;
		else:
			$this->error='Sorry! you are not logged in.';
			return false;
		endif;
	}
	#unset data base session
	function unset_database_session()
	{       //unset($_SESSION['user_session']['database_host']);
	        unset($_SESSION['user_session']['database_name']);
			//unset($_SESSION['user_session']['database_username']);
			//unset($_SESSION['user_session']['database_password']);
	}
	#logged in user id
	function get_user_id()
	{
		if(!isset($_SESSION['user_session'])):
			return false;
		endif;
		
		if($_SESSION['user_session']['logged_in']):
			return $_SESSION['user_session']['user_id'];
		else:
			$this->error='Sorry! you are not logged in.';
			return false;
		endif;
	}
	
	function set_user_id()
	{
		if(!isset($_SESSION['user_session'])):
			return false;
		endif;
		$_SESSION['user_session']['user_id']=$this->user_id;
		$_SESSION['user_session']['logged_in']=true;
		$_SESSION['user_session']['verified']=$this->verified;
		$this->logged_in='true';
		return true;
	}
	#logged in user name
	function set_username()
	{
		$_SESSION['user_session']['username']=$this->username;
		return true;
	}
	
	function get_username()
	{
		return $_SESSION['user_session']['username'];
	}
	#logged in user type
	function set_usertype()
	{
		$_SESSION['user_session']['usertype']=$this->usertype;
		return true;
	}
	
	function get_usertype()
	{
		return $_SESSION['user_session']['usertype'];
	}
	#logged in school id
	function set_schoolId()
	{
		$_SESSION['user_session']['schoolId']=$this->schoolId;
		return true;
	}
	
	function get_schoolId()
	{
		return $_SESSION['user_session']['schoolId'];
	}
	
	function set_school_unique_id()
	{
		$_SESSION['user_session']['school_id']=$this->school_id;
		return true;
	}
	
	function get_school_unique_id()
	{
		return $_SESSION['user_session']['school_id'];
	}

   
	
	function set_uniqueId()
	{
		$_SESSION['user_session']['uniqueId']=$this->uniqueId;
		return true;
	}
	function get_uniqueId()
	{
		return $_SESSION['user_session']['uniqueId'];
	}
	#logged in user email
	function set_useremail()
	{
		$_SESSION['user_session']['useremail']=$this->useremail;
		return true;
	}
	
	function get_useremail()
	{
		return $_SESSION['user_session']['useremail'];
	}
	#logged in user name
	function set_name()
	{
		$_SESSION['user_session']['name']=$this->name;
		return true;
	}
	
	function get_name()
	{
		return $_SESSION['user_session']['name'];
	}
	#logged in user logout time
	function set_logOff_Time()
	{
		$_SESSION['user_session']['logOff_Time']=$this->logOff_Time;
		return true;
	}
	
	function get_logOff_Time()
	{
		return $_SESSION['user_session']['logOff_Time'];
	}
	#logged in user remember me
	function get_remember_me()
	{
		return $_SESSION['user_session']['remember_me'];
	}
	function set_remember_me()
	{
		$_SESSION['user_session']['remember_me']=$this->remember_me;
		return true;
	}
	#database name
	function set_database_name()
	{
		$_SESSION['user_session']['database_name']=$this->database_name;
		return true;
	}
	
	function get_database_name()
	{
		return $_SESSION['user_session']['database_name'];
	}

	
	
	
	function set_pass_msg()
	{
		if(!isset($_SESSION['user_session'])):
			return false;
		endif;
		$_SESSION['user_session']['pass_msg']=$this->pass_msg;
		$_SESSION['user_session']['pass_msg_flag']=true;
		return true;
	}
	
	function unset_pass_msg()
	{
		if(!isset($_SESSION['user_session'])):
			return false;
		endif;
		$_SESSION['user_session']['pass_msg']=array();
		$_SESSION['user_session']['pass_msg_flag']=false;
		return true;
	}
	
	function isset_pass_msg()
	{
		if(!isset($_SESSION['user_session'])):
			return false;
		endif;
		
		if($_SESSION['user_session']['pass_msg_flag']):
			return true;
		else:
			return false;
		endif;
	}
	
	function get_pass_msg()
	{
		if(!isset($_SESSION['user_session'])):
			return false;
		endif;
		if($_SESSION['user_session']['pass_msg_flag']):
			return $_SESSION['user_session']['pass_msg'];
		else:
			return false;
		endif;
		
	}
	
	function set_redirect_url()
	{	
		if(!isset($_SESSION['user_session'])):
			return false;
		endif;
		$_SESSION['user_session']['redirect_url']=$this->redirect_url;
		$_SESSION['user_session']['redirect_url_flag']=true;
		return true;
	}
	
	function isset_redirect_url()
	{
		if(!isset($_SESSION['user_session'])):
			return false;
		endif;
		
		if($_SESSION['user_session']['redirect_url_flag']==true):
			return true;
		else:
			return false;
		endif;
	}
	
	function get_redirect_url()
	{
		if(!isset($_SESSION['user_session'])):
			return false;
		endif;
		if($_SESSION['user_session']['redirect_url_flag']):
			return $_SESSION['user_session']['redirect_url'];
		else:
			return false;
		endif;
	}
	
	function set_success()
	{
		$_SESSION['user_session']['msg_type']=true;
		return true;
	}
	
	function set_error()
	{
		$_SESSION['user_session']['msg_type']=false;
		return true;
	}
	
	function get_msg_type()
	{
		return $_SESSION['user_session']['msg_type'];
	}
	
	function is_verified()
	{
		return $_SESSION['user_session']['verified'];
	}
};
$login_session= new user_session();
?>
