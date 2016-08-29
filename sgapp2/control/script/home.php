<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#handle actions here.
switch ($action):
	case'list':
		$QueryObj->InitilizeSQL();
		$QueryObj->TableName = "admin_user";
		$QueryObj->Where = " Order By last_access DESC";
		$QueryObj->Fields = "*, DATE_FORMAT(last_access,'%d %M %Y at %H:%i:%s') as MyLastAccess";
		$CurrentUser = $QueryObj->DisplayOne();
		
		#get total visits for today.
		$query=new query('web_stat');
		$query->Field="count(*) as total";
		$query->Where="where DATE(on_date)=CURDATE()";
		$webstat=$query->DisplayOne();
		$total_visit_today=$webstat->total;
		
		#get total visits for ever
		$query=new query('web_stat');
		$query->Field="count(*) as total";
		$webstat=$query->DisplayOne();
		$total_visits=$webstat->total;
		
	
		
		#total products on the website.
		$query=new query('product');
		$query->Field="count(*) as total";
		$webstat=$query->DisplayOne();
		$total_product=$webstat->total;
		
		#total registered users on the website.
		$query=new query('user');
		$query->Field="count(*) as total";
		$query->Where="where is_active='1'";
		$webstat=$query->DisplayOne();
		$total_user=$webstat->total;
		
		#total registrations today.
		$query=new query('user');
		$query->Field="count(*) as total";
		$query->Where="where DATE(on_date)=CURDATE() and is_active='1'";
		$webstat=$query->DisplayOne();
		$total_user_today=$webstat->total;
		
		break;
	case'insert':
		break;
	case'update':
		break;
	case'delete':
		break;
	default:break;
endswitch;
?>
