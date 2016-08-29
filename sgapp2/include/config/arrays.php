<?
$fcultyDesignationArray=array();
if(checkTableExist('faculty_designation')):
foreach(get_all_record_by_query('faculty_designation','school_id="'.$login_session->get_school_unique_id().'" and faculty_designation_is_active=1') as $designationKey=>$designationValue):
  $fcultyDesignationArray[$designationValue->faculty_designation_id]=$designationValue->faculty_designation;
endforeach;
endif;
$userTypeArray=array('school', 'faculty', 'student');
$userTypeDatabaseTableArray=array('school'=>'school', 'faculty'=>'faculty', 'student'=>'student');
$userLoginTypeArray=array('school'=>'dashboard-school', 'faculty'=>'dashboard-faculty', 'student'=>'dashboard-parents');


//$stateArray=array('Punjab','Haryana');
$stateArray=array("Andaman and Nicobar Islands", "Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chandigarh", "Chhattisgarh", "Dadra and Nagar Haveli", "Daman and Diu", "Delhi", "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jammu and Kashmir", "Jharkhand", "Karnataka", "Kerala", "Lakshadweep", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", "Mizoram", "Nagaland", "Orissa", "Pondicherry", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", "Tripura", "Uttaranchal", "Uttar Pradesh", "West Bengal");
# school associated module and page array
$schoolModuleArray=array('administration'=>array('administration-class','administration-student','administration-faculty','administration-subject','administration-preRegisteredStudent'),'Fees'=>array('fees-fees','fees-collection'),'Fees Waiver'=>'waiver-approval','reports'=>array('reports-academicreports','reports-reportajax','reports-reports','reports-student','reports-studentFee','reports-preRegisteredStudent','reports-faculty'),'Notice Board'=>'noticeboard-noticeboard','gallery'=>array('gallery-gallery','gallery-galleryimages','gallery-galleryAjax'),'message'=>array('message-message','message-ajax','message-messagedetails'),'Attendance'=>'attendance-student','Home Work'=>'homework-create','Class Test'=>array('exams-createclasstest','exams-createtestajax','exams-createacademictest','exams-createtestajax'),'Time Table'=>'timetable-facultyView');

#DefaultDesignation
//$defaultDesignationArray=array('principal','teacher','parents');
//$defaultDesignationArray=array('students'=>array('studentMyaccount','studentChangepassword'));
$defaultDesignationArray=array('teacher'=>array('dashboard-faculty','profile-faculty','profile-uploadimage','profile-facultychangepassword','profile-facultyajax','attendance-student','homework-create','exams-createclasstest','exams-createtestajax','exams-createacademictest'),'students'=>array('dashboard-parents','profile-student','profile-studentchangepassword','profile-uploadimage','profile-studentajax'));
$defaultDesignationArrayKeys=array_keys($defaultDesignationArray);
$facultyDefaultAccessRightArray=array('dashboard-faculty','profile-faculty','profile-facultychangepassword','profile-facultyajax','profile-uploadimage');
//$schoolDesignationArray=array(1=>'class',2=>'faculty',3=>'student');
$studentModuleArray=array('Home Work'=>'homework-view','class test reports'=>array('reports-academicreports','reports-reportajax','reports-reports'),'Notice Board'=>'noticeboard-noticeboard','gallery'=>array('gallery-gallery','gallery-galleryimages','gallery-galleryAjax'),'message'=>array('message-message','message-ajax','message-messagedetails'),'View Test'=>'exams-viewclasstest','Faculty list'=>'exams-studentfacultylist','Time Table'=>'timetable-studentView');
$studentDefaultAccessRightArray=array('dashboard-parents','profile-student','profile-studentchangepassword','profile-uploadimage','profile-studentajax');


$statusArray=array(0=>'Inactive',1=>'Active',2=>'account not created');

$CoScholasticGradeArray=array('A','B','C','D');

$feeStructureFrequencyArray=array(1=>'Monthly',2=>'Quarterly',3=>'Annual');

$weekDaysArray=array(1=>'Mon',2=>'Tue',3=>'Wed',4=>'Thu',5=>'Fri',6=>'Sat');

$waiverStatusArray=array(3=>'Pending',1=>'Approved',2=>'Not Approved');


# scholastic array start
$CoScholasticGradeFiveArray=array('A+','A','B+','B','C');
$CoScholasticGradeThreeArray=array('A+','A','B');

$coScholasticThinkingSkillsArray=array(1=>'Be Original, flexible and imaginative',2=>'Raise Questions, identify and analyze problems',3=>'Implement a well thought out decision and take reponsibility',4=>'Generate new ideas with fluency',5=>'Elaborate / build on new ideas');
$coScholasticSocialSkillsArray=array(1=>'Be Original, flexible and imaginative',2=>'Raise Questions, identify and analyze problems',3=>'Implement a well thought out decision and take reponsibility',4=>'Generate new ideas with fluency',5=>'Elaborate / build on new ideas');
$coScholasticEmotionalSkillsArray=array(1=>'Be Original, flexible and imaginative',2=>'Raise Questions, identify and analyze problems',3=>'Implement a well thought out decision and take reponsibility',4=>'Generate new ideas with fluency',5=>'Elaborate / build on new ideas');


$coScholasticAttitudeTowardsTeachersArray=array(1=>'Be Original, flexible and imaginative',2=>'Raise Questions, identify and analyze problems',3=>'Implement a well thought out decision and take reponsibility',4=>'Generate new ideas with fluency',5=>'Elaborate / build on new ideas');
$coScholasticAttitudeTowardsSchoolMatesArray=array(1=>'Be Original, flexible and imaginative',2=>'Raise Questions, identify and analyze problems',3=>'Implement a well thought out decision and take reponsibility',4=>'Generate new ideas with fluency',5=>'Elaborate / build on new ideas');
$coScholasticAttitudeTowardsSchoolProgrammingEnvironmentArray=array(1=>'Be Original, flexible and imaginative',2=>'Raise Questions, identify and analyze problems',3=>'Implement a well thought out decision and take reponsibility',4=>'Generate new ideas with fluency',5=>'Elaborate / build on new ideas');
$coScholasticValueSystemsEmotionalSkillsArray=array(1=>'Be Original, flexible and imaginative',2=>'Raise Questions, identify and analyze problems',3=>'Implement a well thought out decision and take reponsibility',4=>'Generate new ideas with fluency',5=>'Elaborate / build on new ideas');

$coScholasticWorkEducationArray=array(1=>'Be Original, flexible and imaginative',2=>'Raise Questions, identify and analyze problems',3=>'Implement a well thought out decision and take reponsibility',4=>'Generate new ideas with fluency',5=>'Elaborate / build on new ideas');
$coScholasticVisualAndPerformingArtsArray=array(1=>'Be Original, flexible and imaginative',2=>'Raise Questions, identify and analyze problems',3=>'Implement a well thought out decision and take reponsibility',4=>'Generate new ideas with fluency',5=>'Elaborate / build on new ideas');

//$coScholasticEmotionalSkillsArray=array(1=>'Be Original, flexible and imaginative',2=>'Raise Questions, identify and analyze problems',3=>'Implement a well thought out decision and take reponsibility',4=>'Generate new ideas with fluency',5=>'Elaborate / build on new ideas');
//$coScholasticEmotionalSkillsArray=array(1=>'Be Original, flexible and imaginative',2=>'Raise Questions, identify and analyze problems',3=>'Implement a well thought out decision and take reponsibility',4=>'Generate new ideas with fluency',5=>'Elaborate / build on new ideas');
# scholastic array end
?>
