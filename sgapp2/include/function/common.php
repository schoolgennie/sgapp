<?
function countryDropDown($in='')
	{   
		$query=new query('country');
		if($in!=''):
		$in=comaSepratedStringConversion($in);
		$query->Where="where countryName In($in) order by countryName";
		else:
		$query->Where="order by countryName";
		endif;
		$result=$query->Displayall();
		$country=array();
		if($query->GetNumRows()>0):
		while ($result=$query->GetObjectFromRecord()):
		$country[$result->id].=$result->countryName;
		endwhile;
		endif;
		return $country;
		
	}
	function regionDropDown($countryId='')
	{   
		$query=new query('region');
		$query->Where="where countryId=".$countryId." order by regionName";
		$result=$query->Displayall();
		$region=array();
		if($query->GetNumRows()>0):
		while ($result=$query->GetObjectFromRecord()):
		$region[$result->id].=$result->regionName;
		endwhile;
		endif;
		return $region;
		
	}
	function location()
	{   
		$query=new query('location');
		$query->Where=" order by state";
		$query->DisplayAll();
		$location=array();
		if($query->GetNumRows()):
		while ($locations=$query->GetObjectFromRecord()) {
		$location[$locations->id]=$locations->state;
		}
		endif;
		return $location;
		
	}
	function selectLocation($lid)
	{   
		$query=new query('location');
		$query->Where="where id=$lid";
		$result=$query->Displayone();
		$location='';
		if($query->GetNumRows()):
		$location=$result->state;
		endif;
		return $location;
		
	}
	function contentRetrive($id)
{
$paymentContent= new query('content');
$paymentContent->Where="where id=".$id;
$objectPayment=$paymentContent->DisplayOne();
$result=array();
    if($paymentContent->GetNumRows()>0):
	  $result[]=$objectPayment->name;
	   $result[]=$objectPayment->page;
       return $result;
    endif;
}

#fetch class subject faculty list
function classSubjectFacultyList($classId)
{
$login_session =new user_session();
$school_id=$login_session->get_user_id();
$data=get_all_record_by_query('faculty_management as a, faculty as b, subject as c','a.class_id="'.$classId.'" and a.school_id="'.$school_id.'" and b.faculty_id=a.faculty_id and c.subject_id=a.subject_id and (b.faculty_is_active=1 or b.faculty_is_active=2) and c.subject_is_active=1 order by a.faculty_management_is_active desc');
return $data;
}	
function getUserDetail($tableName,$userId)
{
     global $userTypeDatabaseTableArray;
     $usernameFields=array(array('school_name'),array('faculty_first_name','faculty_last_name'),array('student_first_name','student_last_name'));
	 $arr=array_combine($userTypeDatabaseTableArray,$usernameFields);
     $fetchData=get_object_by_query($tableName,$tableName.'_id='.$userId);
	 $userName='';
	 foreach($arr[$tableName] as $k=>$v):
	   $userName.=$fetchData->$v.' ';
	 endforeach;
	 return $userName;
}
#fetch incharge call
function classIncharge($class_incharge_id)
{
$class_incharge=get_object_by_query('faculty','faculty_id="'.$class_incharge_id.'" and (faculty_is_active=1 or faculty_is_active=2)');
return $class_incharge->faculty_first_name.' '.$class_incharge->faculty_last_name;
}


function getStudentMarks($classId,$student_id,$subject_id,$date)
{
$result=get_object_by_query('student_test as a,student_test_obtain_marks as b','a.class_id="'.$classId.'" and a.subject_id="'.$subject_id.'" and a.student_test_date="'.$date.'" and a.student_test_is_active=1 and b.student_test_id=a.student_test_id and b.student_id="'.$student_id.'"');
return ($result->student_test_obtain_marks)?number_format($result->student_test_obtain_marks,1):'-';
}

function getStudentMarksAverage($classId,$student_id,$date,$subject_id="")
{
$where=($subject_id)?'a.subject_id="'.$subject_id.'" and ':'';
$result=get_object_by_query('student_test as a,student_test_obtain_marks as b',$where.'a.class_id="'.$classId.'"  and a.student_test_date="'.$date.'" and a.student_test_is_active=1 and b.student_test_id=a.student_test_id and b.student_id="'.$student_id.'"','SUM(student_test_obtain_marks) as totalMarks,COUNT(student_test_obtain_marks_id) as countMarks,a.*,b.*');
return ($result->totalMarks)?number_format($result->totalMarks/$result->countMarks,1):'-';
}

function getStudentMarksAverageMonthly($classId,$student_id,$subject_id,$from,$to='')
{

$where=($subject_id)?'a.subject_id="'.$subject_id.'" and ':'';
$result=get_object_by_query('student_test as a,student_test_obtain_marks as b',$where.'a.class_id="'.$classId.'"  and DATE_FORMAT( STR_TO_DATE( a.student_test_date , "%d-%m-%Y" ) , "%Y/%m" ) ="'.date('Y/m',strtotime($from)).'"  and a.student_test_is_active=1 and b.student_test_id=a.student_test_id and b.student_id="'.$student_id.'"','SUM(student_test_obtain_marks) as totalMarks,COUNT(student_test_obtain_marks_id) as countMarks,a.*,b.*');
return ($result->totalMarks/$result->countMarks)?number_format($result->totalMarks/$result->countMarks,1):'-';
}

function facultyRating($facultyId)
{
 $result=get_object_by_query('faculty_feedback_rating as a,student as b','a.faculty_id="'.$facultyId.'" and b.student_id=a.student_id and b.student_is_active=1','SUM(faculty_feedback_rating) as totalRating,COUNT(faculty_feedback_rating_id) as totalCount');
 return $result->totalRating/$result->totalCount;
} 

#get student profile details
function getStuentProfileInfo($studentId)
{
return get_object_by_query('student','student_id='.$studentId);
}

# get school details
function get_school_detail()
{
global $userTypeArray;
$login_session =new user_session();
if($login_session->get_usertype()==$userTypeArray[0]):# school
   #school unique id
   $school_id=$login_session->get_user_id();

elseif($login_session->get_usertype()==$userTypeArray[1]):# faculty
   #fetch faculty details
   $facultyDetail=get_object_by_query('faculty','faculty_id="'.$login_session->get_user_id().'"');
   #school unique id
   $school_id=$facultyDetail->school_id;

elseif($login_session->get_usertype()==$userTypeArray[2]):# student
   #fetch student details
   $studentDetail=get_object_by_query('student','student_id="'.$login_session->get_user_id().'"');
   #school unique id
   $school_id=$studentDetail->school_id;
endif;
return get_object_by_query('school','school_id='.$school_id);
}
# update sms count
function schoolSmsCountUpdate()
{
global $userTypeArray;
$login_session =new user_session();
if($login_session->get_usertype()==$userTypeArray[0]):# school
   #school unique id
   $school_id=$login_session->get_user_id();

elseif($login_session->get_usertype()==$userTypeArray[1]):# faculty
    #school unique id
   $school_id=$facultyDetail->school_id;

elseif($login_session->get_usertype()==$userTypeArray[2]):# student
    #school unique id
   $school_id=$studentDetail->school_id;
endif;
$count=get_object_by_query('school_sms_count','school_id='.$school_id);

if($count):
  $data['school_sms_count']=$count->school_sms_count+1;
  $where="school_sms_count_id='".$count->school_sms_count_id."'";																																																																																			
  update_record_in_table('school_sms_count',$where,$data);
else:
  $data['school_id']=$school_id;
  $data['school_sms_count']=1;
  $data['school_sms_count_last_sms_date']=date('Y-m-d');
  
  insert_record_in_table('school_sms_count',$data);
 
endif;  
}
function PostRequest($url, $referer, $_data) { 
 // convert variables array to string: 
 $data = array(); 
 while(list($n,$v) = each($_data)){ 
 $data[] = "$n=$v"; 
 } 
 $data = implode('&', $data);
 // format --> test1=a&test2=b etc. 
 // parse the given URL 
 $url = parse_url($url); 
 if ($url['scheme'] != 'http') { 
 die('Only HTTP request are supported !'); 
 } 
 // extract host and path: 
 $host = $url['host']; 
 $path = $url['path']; 
 // open a socket connection on port 80 
 $fp = fsockopen($host, 80); 
 // send the request headers: 
 fputs($fp, "POST $path HTTP/1.1\r\n"); 
 fputs($fp, "Host: $host\r\n"); 
 fputs($fp, "Referer: $referer\r\n"); 
 fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n"); 
 fputs($fp, "Content-length: ". strlen($data) ."\r\n"); 
 fputs($fp, "Connection: close\r\n\r\n"); 
 fputs($fp, $data); 
 $result = ''; 
 while(!feof($fp)) { 
 // receive the results of the request 
 $result .= fgets($fp, 128); 
 } 
 // close the socket connection: 
 fclose($fp); 
 // split the result header from the content 
 $result = explode("\r\n\r\n", $result, 2); 
 $header = isset($result[0]) ? $result[0] : '';
  $content = isset($result[1]) ? $result[1] : ''; 
 // return as array: 
 return array($header, $content); 
} 
# send sms
function sendSms($receipientno,$subject,$msgtxt)
{
//echo "http://smslane.com/vendorsms/pushsms.aspx?
//user=pardeepg&password=409254&msisdn=9988448567&sid=WebSMS&msg=abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz12345&fl=0";exit;

$data = array( 
 'user' => "pardeepg", 
 'password' => "409254", 
 'msisdn' => $receipientno, 
 'sid' => $subject, 
 'msg' => $msgtxt, 
 'fl' =>"0", 
); 
 
list($header, $content) = PostRequest( 
 "http://www.smslane.com//vendorsms/pushsms.aspx", // the url to post to 
 "", // its your url 
 $data 
); 
echo $content;
$result=explode(':',$content);
if($result[0]=='The Message Id '):
schoolSmsCountUpdate();
endif;
}

# send sms
function sendSmsBackup($receipientno,$senderID,$msgtxt)
{
if(get_school_detail()->school_message_limit > 0 && get_school_detail()->school_message_limit > get_object_by_query('school_sms_count','school_id='.get_school_detail()->school_id)->school_sms_count):
	schoolSmsCountUpdate();
	$ch = curl_init();
	$user="Pardeep.goyal@schoolgennie.com:122001";
	$receipientno=$receipientno;
	$senderID=$senderID;
	$msgtxt=$msgtxt;
	curl_setopt($ch,CURLOPT_URL,  "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&msgtxt=$msgtxt");
	$buffer = curl_exec($ch);
	if(empty ($buffer))
	{ echo " buffer is empty "; }
	else
	{ echo $buffer; }
	curl_close($ch);
endif;
}



function getUserInfo($type,$id)
{
global $fcultyDesignationArray;
$result=array();
if($type=='school'):# school
   #fetch school details
   $detail=get_object_by_query('school','school_id="'.$id.'"');
   $result['name']=$detail->school_name;
   $result['type']='School';
   $result['image']=$detail->school_image;
elseif($type=='faculty'):# faculty
   #fetch faculty details
   $detail=get_object_by_query('faculty','faculty_id="'.$id.'"');
   $result['name']=$detail->faculty_first_name.' '.$detail->faculty_last_name;
   $result['type']=$fcultyDesignationArray[$detail->faculty_designation];
   $result['image']=$detail->faculty_image;
elseif($type=='student'):# student
   #fetch student details
   $detail=get_object_by_query('student','student_id="'.$id.'"');
   $result['name']=$detail->student_first_name.' '.$detail->student_last_name;
   $result['type']='Student';
   $result['image']=$detail->student_image;
endif;
return $result;
}
function schoolReportsdata($classId,$student_id,$subject_id='',$fromDate='',$reportType='',$todateToTime='',$fromDateToTime='',$days='',$months='')
{
$data=array();
if($reportType=='year'):
   for($i=0;$i<=$months;$i++):
	  // if( getStudentMarksAverageMonthly($classId,$student_id,$subject_id,date('d-m-Y',strtotime('+'.$i.' months',$fromDateToTime)))!='0.0'):
	     $studentMarks=getStudentMarksAverageMonthly($classId,$student_id,$subject_id,date('d-m-Y',strtotime('+'.$i.' months',$fromDateToTime)));
	     $data[date('M',strtotime('+'.$i.' months',$fromDateToTime))] = ($studentMarks=='-')?0:$studentMarks;
	  // endif;
   endfor;
else:
   for($i=0;$i<=$days;$i++):
	#date range
	//if($reportType=='dateRange'):
	    //if(getStudentMarksAverage($classId,$student_id,date('d-m-Y',strtotime('+'.$i.' days',strtotime($fromDate))),$subject_id)!='0.0'):
           //$data[date('d',strtotime('+'.$i.' days',strtotime($fromDate)))] =(strtotime('+'.$i.' days',strtotime($fromDate))>=$fromDateToTime && strtotime('+'.$i.' days',strtotime($fromDate))<=$todateToTime)?number_format(getStudentMarksAverage($classId,$student_id,date('d-m-Y',strtotime('+'.$i.' days',strtotime($fromDate))),$subject_id),1):'0.0';
		//endif; 
	//else:
	   //if(getStudentMarksAverage($classId,$student_id,date('d-m-Y',strtotime('+'.$i.' days',strtotime($fromDate))),$subject_id)!='0.0'):
	      $studentMarks=getStudentMarksAverage($classId,$student_id,date('d-m-Y',strtotime('+'.$i.' days',strtotime($fromDate))),$subject_id);
	      $data[date('d',strtotime('+'.$i.' days',strtotime($fromDate)))] = ($studentMarks=='-')?0:$studentMarks;
	   //endif;
	//endif;
   endfor;
endif;

return $data;
}


function createDefaultDesignation($school_id)
{
     global $defaultDesignationArray;
	 foreach($defaultDesignationArray as $k=>$v):
	  $data['school_id']=$school_id;
	  $data['faculty_designation']=$k;
	  $data['faculty_designation_ondate']=date_format_inserted(date('d-m-Y'));
	  insert_record_in_table('faculty_designation',$data);
	
	 #create faculty designation access rights
	  $maxid=get_object_by_query('faculty_designation','school_id="'.$school_id.'"','Max(faculty_designation_id) as id')->id;
	  $data1['school_id']=$school_id;
	  $data1['faculty_designation_id']=$maxid;
	  $faculty_designation_access_module=implode(',',$v);
	  $data1['faculty_designation_access_module']=$faculty_designation_access_module;
	  insert_record_in_table('faculty_designation_access_rights',$data1);	
	 endforeach;
}
function download_studentBlock()
{

    $login_session =new user_session();
	$school_id=$login_session->get_school_unique_id();
	$users=get_all_record_by_query('student','school_id="'.$school_id.'"','student_email_id,student_first_name,student_last_name,student_gender,student_dob,student_contact,student_country,student_state,student_city,class_id,student_father_first_name,student_father_last_name,student_mother_first_name,student_mother_last_name,student_father_phone,student_father_email_id,student_mother_phone,student_mother_email_id,student_zip,student_address,student_admission_no,student_roll_number,student_with_school_since');
	$users_arr= array();
	//$arr=array('businessname' => '','address' =>'','zip' =>'','city' =>'','state' =>'','category' =>'','code'=>'');
	 
	if($users):
	foreach($users as $k=>$v):
		//$user['total orders']=get_total_orders_by_user($user['id']);
		array_push($users_arr,$v);
	endforeach;
	//else:
	//array_push($users_arr, $arr);
	endif;
	$file='User ID*,First Name*,Last Name*,Gender*,Date of Birth*,Prefered Contact No.*,Country*,State*,City*,Class*,Father First Name*,Father Last Name*,Mother First Name*,Mother Last Name*,Father Contact No.,Father Email Id,Mother Contact No.,Mother Email Id,zip,Address,Admission No.,Roll No.,With School Since';
	$file.=make_csv_from_array($users_arr);
	$filename="studentList".$login_session->get_schoolId().'.csv';
	$fh=@fopen('download/'.$filename,"w");
	fwrite($fh, $file);
	fclose($fh);
	download_file('download/'.$filename);
	unlink('download/'.$filename);
}
function make_csv_from_array($array)
{
	$sr=1;
	$heading='';
	$file='';
	foreach ($array as $k=>$v):
		foreach ($v as $key=>$value):
			//if($sr==1):$heading.=$key.',';endif;
			$file.=str_replace("\r\n", "<<>>", str_replace(",", ".",$value)).',';
		endforeach;
		$file=substr($file, 0, strlen($file)-1);
		$file.="\n";
		$sr++;
	endforeach;
	$heading=substr($heading, 0, strlen($heading)-1);
	return $file=$heading."\n".$file;
}
function make_csv_from_array_listing($array)
{   
    $fields=array('businessname','address','zip','city','state','category','code');
	$sr=1;
	$heading='';
	$file='';
	foreach ($array as $k=>$v):
		foreach ($v as $key=>$value):
		   if(in_array($key,$fields)):
			if($sr==1):$heading.=$key.', ';endif;
			$file.=str_replace("\r\n", "<<>>", str_replace(",", ".", $value)).', ';
		  endif;	
		endforeach;
		$file=substr($file, 0, strlen($file)-2);
		$file.="\n";
		$sr++;
	endforeach;
	return $file=$heading."\n".$file;
}
function studentTestResult($faculty_id,$student_test_id,$student_id,$field)
{
$result=get_object_by_query('student_test_obtain_marks','faculty_id="'.$faculty_id.'"  and student_test_id="'.$student_test_id.'" and student_id="'.$student_id.'"');
return $result->$field;
}

?>