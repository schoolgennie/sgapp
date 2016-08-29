<?
check_logged_in_for_myaccount('school');

isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['student_id'])?$student_id=$_GET['student_id']:$student_id='0';
isset($_GET['p'])?$p=$_GET['p']:$p='1';

#school unique id
$school_id=$login_session->get_user_id();

#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);

#count no of student account
$totalStudent=get_object_by_query_count('student','school_id="'.$school_id.'"');

#fetch class list
$classList=get_all_record_by_query('class','school_id="'.$school_id.'" and class_is_active=1 order by class_position');




#handle actions here.
switch ($action):
	case'list':
		#search parameter
		$class=(isset($_REQUEST['class']) && $_REQUEST['class']!='')?$_REQUEST['class']:'';
		$status=(isset($_REQUEST['status']) && $_REQUEST['status']!='')?$_REQUEST['status']:'';
		$where=($class)?" and a.class_id='".$class."'":'';
		$where.=($status)?$status:'';
		print_r($where);
		 #fetch class list
         //$studentList=get_all_object_by_query('student as a ,class as b','a.class_id=b.class_id '.$where.'  order by a.student_is_active desc');
		  //$studentList=get_all_record_by_query('student as a ,class as b','a.class_id=b.class_id '.$where.'  order by a.student_is_active desc',(get_object_by_query('fee_collection_management as aa,fee_structure as bb,fee_category as cc,fee_collection_type as dd','aa.student_id=a.student_id and bb.fee_structure_id=aa.fee_structure_id and cc.fee_category_id=bb.fee_category_id and bb.fee_collection_type_id=dd.fee_collection_type_id   and dd.fee_collection_type_due_date<="'.date('Y-m-d').'"','SUM(bb.fee_structure_amount) as totalAmount')-get_object_by_query('student_fee_history','student_id=a.student_id','SUM(student_fee_history_paid_amount) as totalAmount')));
		 
		   $studentList=get_all_record_by_query('student as a ,class as b','a.class_id=b.class_id '.$where.'  order by a.student_is_active desc','a.*,b.*,IF((select SUM(student_fee_history_paid_amount) from student_fee_history where student_id=a.student_id) IS NULL,(select SUM(bb.fee_structure_amount) from fee_collection_management as aa,fee_structure as bb,fee_category as cc,fee_collection_type as dd where aa.student_id=a.student_id and bb.fee_structure_id=aa.fee_structure_id and cc.fee_category_id=bb.fee_category_id and bb.fee_collection_type_id=dd.fee_collection_type_id   and dd.fee_collection_type_due_date<="'.date('Y-m-d').'"),
((select SUM(bb.fee_structure_amount) from fee_collection_management as aa,fee_structure as bb,fee_category as cc,fee_collection_type as dd where aa.student_id=a.student_id and bb.fee_structure_id=aa.fee_structure_id and cc.fee_category_id=bb.fee_category_id and bb.fee_collection_type_id=dd.fee_collection_type_id   and dd.fee_collection_type_due_date<="'.date('Y-m-d').'")-(select SUM(student_fee_history_paid_amount) from student_fee_history where student_id=a.student_id))) as totalAmount');

		// $total=get_all_record_by_query('student as a ,class as b','a.class_id=b.class_id '.$where,'(select SUM(bb.fee_structure_amount) from fee_collection_management as aa,fee_structure as bb,fee_category as cc,fee_collection_type as dd where aa.student_id=a.student_id and bb.fee_structure_id=aa.fee_structure_id and cc.fee_category_id=bb.fee_category_id and bb.fee_collection_type_id=dd.fee_collection_type_id   and dd.fee_collection_type_due_date<="'.date('Y-m-d').'") as total,(select SUM(student_fee_history_paid_amount) from student_fee_history where student_id=a.student_id) as totalAmount');
         // $total=get_object_by_query('student as a ,class as b,fee_collection_management as c,fee_structure as d,fee_category as e,fee_collection_type as f','a.class_id=b.class_id '.$where.' and c.student_id=a.student_id and d.fee_structure_id=c.fee_structure_id and e.fee_category_id=d.fee_category_id and d.fee_collection_type_id=f.fee_collection_type_id   and f.fee_collection_type_due_date<="'.date('Y-m-d').'"','SUM(d.fee_structure_amount) as totalAmount');
		  //$totalAmount=get_all_record_by_query('student as a ,class as b,student_fee_history as c','a.class_id=b.class_id '.$where.' and c.student_id=a.student_id','SUM(student_fee_history_paid_amount) as totalAmount');
		 // print_r($totalAmount);
		 function totalFee($class)
		 {
		    $where=($class)?" and a.class_id='".$class."'":'';
			$result=get_object_by_query('student as a ,class as b,fee_collection_management as c,fee_structure as d,fee_category as e,fee_collection_type as f','a.class_id=b.class_id '.$where.' and c.student_id=a.student_id and d.fee_structure_id=c.fee_structure_id and e.fee_category_id=d.fee_category_id and d.fee_collection_type_id=f.fee_collection_type_id   and f.fee_collection_type_due_date<="'.date('Y-m-d').'"','SUM(d.fee_structure_amount) as totalAmount');
			return $result->totalAmount;
		 }
		 function totalPaidFee($class)
		 {
		    $where=($class)?" and a.class_id='".$class."'":'';
			$result=get_object_by_query('student as a ,class as b,student_fee_history as c','a.class_id=b.class_id '.$where.' and c.student_id=a.student_id','SUM(student_fee_history_paid_amount) as totalAmount');
			return $result->totalAmount;
		 }
		break;
	
   case'download':
		#download student list
		download_student();
	    Redirect(make_url('reports-studentFee'));
		break;
  
	default:break;
endswitch;
?>
