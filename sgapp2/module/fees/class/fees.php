<?
$fee_category='CREATE TABLE fee_category(
  fee_category_id int(11) NOT NULL AUTO_INCREMENT,
  fee_category varchar(222) NOT NULL,
  fee_category_ondate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (fee_category_id))';
$fee_collection_type="CREATE TABLE `fee_collection_type` (
  `fee_collection_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_collection_type` varchar(222) NOT NULL,
  `fee_collection_type_start_date` date NOT NULL,
  `fee_collection_type_end_date` date NOT NULL,
  `fee_collection_type_due_date` date NOT NULL,
  `fee_collection_type_ondate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fee_collection_type_id`)
);INSERT INTO `fee_collection_type` (`fee_collection_type_id`, `fee_collection_type`, `fee_collection_type_start_date`, `fee_collection_type_end_date`, `fee_collection_type_due_date`) VALUES
(1, 'Addmission Fee', '', '', ''),
(2, 'Quarter 1', '2014-04-01', '2014-06-30', '2014-04-10'),
(3, 'Quarter 2', '2014-07-01', '2014-09-30', '2014-07-10'),
(4, 'Quarter 3', '2014-10-01', '2014-12-31', '2014-10-10'),
(5, 'Quarter 4', '2015-01-01', '2015-03-31', '2015-01-10')";
$fee_collection_management='CREATE TABLE `fee_collection_management` (
  `fee_collection_management_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_structure_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `fee_collection_management_ondate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fee_collection_management_id`)
) ';
$fee_structure='CREATE TABLE  `fee_structure` (
  `fee_structure_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_category_id` int(11) NOT NULL,
  `fee_collection_type_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `fee_structure_amount` int(11) NOT NULL,
  `fee_structure_frequency` varchar(222) NOT NULL,
  `fee_structure_notes` text NOT NULL,
  `fee_structure_ondate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fee_structure_id`),
  KEY `fee_category_id` (`fee_category_id`),
  KEY `class_id` (`class_id`),
  FOREIGN KEY (`fee_category_id`) REFERENCES `fee_category` (`fee_category_id`) ON DELETE CASCADE,
  FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE
)';

$student_fee_history='CREATE TABLE IF NOT EXISTS `student_fee_history` (
  `student_fee_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `fee_collection_type_id` int(11) NOT NULL,
  `student_fee_history_total_amount` int(11) NOT NULL,
  `student_fee_history_paid_amount` int(11) NOT NULL,
  `student_fee_history_waver` int(11) NOT NULL,
  `student_fee_history_waver_comment` text NOT NULL,
  `student_fee_history_payment_mode` int(11) NOT NULL,
  `student_fee_history_bank_name` text NOT NULL,
  `student_fee_history_cheque_date` date NOT NULL,
  `student_fee_history_cheque_number` varchar(22) NOT NULL,
  `student_fee_history_ondate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`student_fee_history_id`),
  KEY `student_id` (`student_id`),
  KEY `fee_collection_type_id` (`fee_collection_type_id`),
  FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE,
  FOREIGN KEY (`fee_collection_type_id`) REFERENCES `fee_collection_type` (`fee_collection_type_id`) ON DELETE CASCADE
)' ;
$fee_fine='CREATE TABLE IF NOT EXISTS `fee_fine` (
  `fee_fine_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_fine_amount` int(11) NOT NULL,
  `fee_fine_duration` int(11) NOT NULL,
  PRIMARY KEY (`fee_fine_id`)
  )';


checkTableExist(array('fee_category','fee_collection_type','fee_collection_management','fee_structure','student_fee_history','fee_fine'));
/*$sql="CREATE TABLE IF NOT EXISTS `fee_category` (
  `fee_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_category` varchar(222) NOT NULL,
  `fee_category_ondate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fee_category_id`)
);
CREATE TABLE IF NOT EXISTS `fee_collection_management` (
  `fee_collection_management_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_structure_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `fee_collection_management_ondate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fee_collection_management_id`)
);
CREATE TABLE IF NOT EXISTS `fee_collection_type` (
  `fee_collection_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_collection_type` varchar(222) NOT NULL,
  `fee_collection_type_start_date` date NOT NULL,
  `fee_collection_type_end_date` date NOT NULL,
  `fee_collection_type_due_date` date NOT NULL,
  `fee_collection_type_ondate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fee_collection_type_id`)
);
INSERT INTO `fee_collection_type` (`fee_collection_type_id`, `fee_collection_type`, `fee_collection_type_start_date`, `fee_collection_type_end_date`, `fee_collection_type_due_date`, `fee_collection_type_ondate`) VALUES
(1, 'Addmission Fee', '0000-00-00', '0000-00-00', '0000-00-00', '2014-03-03 12:12:16'),
(2, 'Quarter 1', '2013-04-01', '2013-06-30', '2013-04-10', '2014-03-03 12:12:16'),
(3, 'Quarter 2', '2013-07-01', '2013-09-30', '2013-07-10', '2014-03-03 12:12:16'),
(4, 'Quarter 3', '2013-10-01', '2013-12-31', '2013-10-10', '2014-03-03 12:12:16'),
(5, 'Quarter 4', '2014-01-01', '2014-03-31', '2014-01-10', '2014-03-03 12:12:16');
CREATE TABLE IF NOT EXISTS `fee_structure` (
  `fee_structure_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_category_id` int(11) NOT NULL,
  `fee_collection_type_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `fee_structure_amount` int(11) NOT NULL,
  `fee_structure_frequency` varchar(222) NOT NULL,
  `fee_structure_notes` text NOT NULL,
  `fee_structure_ondate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fee_structure_id`),
  KEY `fee_category_id` (`fee_category_id`),
  KEY `class_id` (`class_id`),
  ADD FOREIGN KEY (`fee_category_id`) REFERENCES `fee_category` (`fee_category_id`) ON DELETE CASCADE,
  ADD FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE
);
CREATE TABLE IF NOT EXISTS `student_fee_history` (
  `student_fee_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `fee_collection_type_id` int(11) NOT NULL,
  `student_fee_history_total_amount` int(11) NOT NULL,
  `student_fee_history_paid_amount` int(11) NOT NULL,
  `student_fee_history_ondate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`student_fee_history_id`),
  KEY `student_id` (`student_id`),
  KEY `fee_collection_type_id` (`fee_collection_type_id`),
  ADD FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE,
  ADD FOREIGN KEY (`fee_collection_type_id`) REFERENCES `fee_collection_type` (`fee_collection_type_id`) ON DELETE CASCADE
)";*/
//runSqlFile($sql);
$paymentModeArray=array(1=>'CASH',2=>'Cheque/DD');
$feeFineDurationArray=array(1=>'Daily',7=>'Weekly',30=>'Monthly');

function feeCollectionManagementtList($fee_structure_id)
{
$feeCollectionManagementtListArray=array();
$feeCollectionManagementtList=get_all_record_by_query('fee_collection_management','fee_structure_id="'.$fee_structure_id.'" order by student_id');
foreach($feeCollectionManagementtList as $k=>$v):
  $feeCollectionManagementtListArray[]=$v->student_id;
endforeach;
return $feeCollectionManagementtListArray;
}
function studentList($class)
{
$studentListArray=array();
$studentList=get_all_record_by_query('student','class_id="'.$class.'" and student_is_active!=0 order by student_id');
foreach($studentList as $k=>$v):
  $studentListArray[]=$v->student_id;
endforeach;
return $studentListArray;
}
function countStudentPendingFee($studentId,$startDate)
{
$totalFine='';
$feeCollectionTypetList=get_all_record_by_query('fee_collection_management as a,fee_structure as b,fee_collection_type as c','a.student_id="'.$studentId.'" and b.fee_structure_id=a.fee_structure_id and c.fee_collection_type_id=b.fee_collection_type_id and c.fee_collection_type_due_date<"'.$startDate.'" group by c.fee_collection_type_id order by c.fee_collection_type_start_date');
	foreach($feeCollectionTypetList as $feeCollectionTypetListKey=>$feeCollectionTypetListValue):
	    $studentFeeStatus=get_object_by_query('student_fee_history','fee_collection_type_id="'.$feeCollectionTypetListValue->fee_collection_type_id.'" and student_id="'.$studentId.'" order by student_fee_history_cheque_date','*');
	    $feeStructuretTotalAmount=get_object_by_query('fee_collection_management as a,fee_structure as b,fee_category as c','a.student_id="'.$student_id.'" and b.fee_structure_id=a.fee_structure_id  and b.fee_collection_type_id="'.$feeCollectionTypetListValue->fee_collection_type_id.'" and c.fee_category_id=b.fee_category_id','SUM(b.fee_structure_amount) as totalAmount')->totalAmount;
	    $totalFine=$totalFine+countFine($feeStructuretTotalAmount,$feeCollectionTypetListValue->fee_collection_type_due_date,($studentFeeStatus)?$studentFeeStatus->student_fee_history_cheque_date:date('Y-m-d'));
	endforeach;
$totalFee=get_object_by_query('fee_collection_management as a,fee_structure as b,fee_category as c,fee_collection_type as d','a.student_id="'.$studentId.'" and b.fee_structure_id=a.fee_structure_id and c.fee_category_id=b.fee_category_id and b.fee_collection_type_id=d.fee_collection_type_id   and d.fee_collection_type_due_date<"'.$startDate.'"','SUM(b.fee_structure_amount) as totalAmount')->totalAmount;
$paymentHistory=get_object_by_query('student_fee_history','student_id="'.$studentId.'"','SUM(student_fee_history_paid_amount) as totalAmount,SUM(student_fee_history_waver) as totalWaver');
$totalPaid=$paymentHistory->totalAmount;
$totalWaver=get_object_by_query('student_fee_history','student_id="'.$studentId.'" and student_fee_history_waver_status=1','SUM(student_fee_history_waver) as totalWaver')->totalWaver;
return $totalFee-$totalPaid-$totalWaver+$totalFine;
}
function countFine($amount,$dueDate,$currentDate)
{
if($currentDate>$dueDate):
$feeFineDetails=get_object_by_query('fee_fine');
$fine=ceil(((strtotime($currentDate)-strtotime($dueDate))/(60*60*24))/$feeFineDetails->fee_fine_duration)*$feeFineDetails->fee_fine_amount;
return ($feeFineDetails->fee_fine_max && $fine>$feeFineDetails->fee_fine_max)?$feeFineDetails->fee_fine_max:$fine;
else:
return 0;
endif;
}
?>