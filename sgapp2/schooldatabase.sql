CREATE TABLE IF NOT EXISTS `academic_test` (
  `academic_test_id` int(11) NOT NULL AUTO_INCREMENT,
  `academic_test_name` varchar(20) NOT NULL,
  `academic_test_max_marks` int(11) NOT NULL,
  PRIMARY KEY (`academic_test_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `academic_test`
--

INSERT INTO `academic_test` (`academic_test_id`, `academic_test_name`, `academic_test_max_marks`) VALUES
(1, 'FA1', 100),
(2, 'FA2', 100),
(3, 'FA3', 100),
(4, 'FA4', 100),
(5, 'SA1', 100),
(6, 'SA2', 100);

-- --------------------------------------------------------

--
-- Table structure for table `academic_test_obtain_marks`
--

CREATE TABLE IF NOT EXISTS `academic_test_obtain_marks` (
  `academic_test_obtain_marks_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `academic_test_id` int(11) NOT NULL,
  `academic_test_obtain_marks` varchar(11) NOT NULL,
  `academic_test_obtain_marks_comment` text NOT NULL,
  `academic_test_obtain_marks_parent_comment` text NOT NULL,
  `academic_test_obtain_marks_date` varchar(30) NOT NULL,
  PRIMARY KEY (`academic_test_obtain_marks_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `album_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `album_name` varchar(222) NOT NULL,
  `album_description` text NOT NULL,
  `album_date` varchar(30) NOT NULL,
  PRIMARY KEY (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `album_images`
--

CREATE TABLE IF NOT EXISTS `album_images` (
  `album_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `album_image` text NOT NULL,
  `album_image_caption` text NOT NULL,
  `album_image_date` varchar(30) NOT NULL,
  PRIMARY KEY (`album_image_id`),
  KEY `album_id` (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(20) NOT NULL,
  `class_location` varchar(30) NOT NULL,
  `class_position` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `class_incharge` int(11) NOT NULL,
  `class_is_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------


--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `faculty_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `faculty_email_id` varchar(50) NOT NULL,
  `faculty_user_id` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `faculty_employee_id` varchar(20) NOT NULL,
  `faculty_registration_no` varchar(20) NOT NULL,
  `faculty_image` text NOT NULL,
  `faculty_first_name` varchar(22) NOT NULL,
  `faculty_last_name` varchar(22) NOT NULL,
  `faculty_dob` varchar(30) NOT NULL,
  `faculty_gender` varchar(10) NOT NULL,
  `faculty_years_of_experience` int(11) NOT NULL,
  `faculty_bachelors` varchar(30) NOT NULL,
  `faculty_highest_qualification` varchar(30) NOT NULL,
  `faculty_previous_school` varchar(50) NOT NULL,
  `faculty_is_active` tinyint(4) NOT NULL DEFAULT '2',
  `faculty_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `faculty_designation` varchar(30) NOT NULL,
  `faculty_report_access` tinyint(4) NOT NULL,
  `faculty_contact` varchar(15) NOT NULL,
  `faculty_mobile` varchar(15) NOT NULL,
  `faculty_email_official` varchar(50) NOT NULL,
  `faculty_email_personal` varchar(50) NOT NULL,
  `faculty_with_school_since` varchar(10) NOT NULL,
  `faculty_address` text NOT NULL,
  `change_password_status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_attendance`
--

CREATE TABLE IF NOT EXISTS `faculty_attendance` (
  `faculty_attendance_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `faculty_attendance` tinyint(4) NOT NULL,
  `faculty_attendance_date` varchar(30) NOT NULL,
  PRIMARY KEY (`faculty_attendance_id`),
  KEY `faculty_id` (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_designation`
--

CREATE TABLE IF NOT EXISTS `faculty_designation` (
  `faculty_designation_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `faculty_designation` varchar(222) NOT NULL,
  `faculty_designation_ondate` varchar(30) NOT NULL,
  `faculty_designation_is_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`faculty_designation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_designation_access_rights`
--

CREATE TABLE IF NOT EXISTS `faculty_designation_access_rights` (
  `faculty_designation_access_rights_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `faculty_designation_id` int(11) NOT NULL,
  `faculty_designation_access_module` text NOT NULL,
  PRIMARY KEY (`faculty_designation_access_rights_id`),
  KEY `faculty_designation_id` (`faculty_designation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_error_records`
--

CREATE TABLE IF NOT EXISTS `faculty_error_records` (
  `faculty_id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(20) NOT NULL,
  `faculty_user_id` varchar(50) NOT NULL,
  `faculty_email_id` varchar(50) NOT NULL,
  `faculty_employee_id` varchar(20) NOT NULL,
  `faculty_registration_no` varchar(20) NOT NULL,
  `faculty_image` text NOT NULL,
  `faculty_first_name` varchar(22) NOT NULL,
  `faculty_last_name` varchar(22) NOT NULL,
  `faculty_dob` varchar(30) NOT NULL,
  `faculty_gender` varchar(10) NOT NULL,
  `faculty_years_of_experience` int(11) NOT NULL,
  `faculty_bachelors` varchar(30) NOT NULL,
  `faculty_highest_qualification` varchar(30) NOT NULL,
  `faculty_previous_school` varchar(50) NOT NULL,
  `faculty_is_active` tinyint(4) NOT NULL DEFAULT '1',
  `faculty_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `faculty_designation` varchar(30) NOT NULL,
  `faculty_report_access` tinyint(4) NOT NULL,
  `faculty_contact` varchar(15) NOT NULL,
  `faculty_mobile` varchar(15) NOT NULL,
  `faculty_email_official` varchar(50) NOT NULL,
  `faculty_email_personal` varchar(50) NOT NULL,
  `faculty_with_school_since` varchar(10) NOT NULL,
  `faculty_address` text NOT NULL,
  `errorList` text NOT NULL,
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------



--
-- Table structure for table `faculty_management`
--

CREATE TABLE IF NOT EXISTS `faculty_management` (
  `faculty_management_id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `faculty_management_delete` tinyint(4) NOT NULL DEFAULT '0',
  `faculty_management_is_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`faculty_management_id`),
  KEY `faculty_id` (`faculty_id`),
  KEY `class_id` (`class_id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `fee_category`
--

CREATE TABLE IF NOT EXISTS `fee_category` (
  `fee_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_category` varchar(222) NOT NULL,
  `fee_category_ondate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fee_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `fee_collection_management`
--

CREATE TABLE IF NOT EXISTS `fee_collection_management` (
  `fee_collection_management_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_structure_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `fee_collection_management_ondate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fee_collection_management_id`),
  KEY `fee_structure_id` (`fee_structure_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=143 ;

-- --------------------------------------------------------

--
-- Table structure for table `fee_collection_type`
--

CREATE TABLE IF NOT EXISTS `fee_collection_type` (
  `fee_collection_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_collection_type` varchar(222) NOT NULL,
  `fee_collection_type_start_date` date NOT NULL,
  `fee_collection_type_end_date` date NOT NULL,
  `fee_collection_type_due_date` date NOT NULL,
  `fee_collection_type_ondate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fee_collection_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `fee_collection_type`
--

INSERT INTO `fee_collection_type` (`fee_collection_type_id`, `fee_collection_type`, `fee_collection_type_start_date`, `fee_collection_type_end_date`, `fee_collection_type_due_date`, `fee_collection_type_ondate`) VALUES
(1, 'Quarter 1', '2014-04-01', '2014-06-30', '2014-04-10', '2014-04-02 12:47:31'),
(2, 'Quarter 2', '2014-07-01', '2014-09-30', '2014-07-10', '2014-04-02 12:47:31'),
(3, 'Quarter 3', '2014-10-01', '2014-12-31', '2014-10-10', '2014-04-02 12:47:31'),
(4, 'Quarter 4', '2015-01-01', '2015-03-31', '2015-01-10', '2014-04-02 12:47:31');

-- --------------------------------------------------------

--
-- Table structure for table `fee_fine`
--

CREATE TABLE IF NOT EXISTS `fee_fine` (
  `fee_fine_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_fine_amount` int(11) NOT NULL,
  `fee_fine_duration` int(11) NOT NULL,
  PRIMARY KEY (`fee_fine_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `fee_structure`
--

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
  KEY `class_id` (`class_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------


--
-- Table structure for table `home_work`
--

CREATE TABLE IF NOT EXISTS `home_work` (
  `home_work_id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_management_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `home_work` text NOT NULL,
  `home_work_attachment` text NOT NULL,
  `ondate` date NOT NULL,
  `home_work_is_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`home_work_id`),
  KEY `faculty_management_id` (`faculty_management_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------



--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_subject_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `message_receiver_type` varchar(111) NOT NULL,
  `message_receiver_id` int(11) NOT NULL,
  `message_receiver_status` tinyint(4) NOT NULL DEFAULT '1',
  `message_sender_type` varchar(111) NOT NULL,
  `message_sender_id` int(11) NOT NULL,
  `message_sender_status` tinyint(4) NOT NULL DEFAULT '1',
  `message` text NOT NULL,
  `message_read_status` tinyint(4) NOT NULL DEFAULT '0',
  `message_ondate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`),
  KEY `message_subject_id` (`message_subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `message_subject`
--

CREATE TABLE IF NOT EXISTS `message_subject` (
  `message_subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `message_subject_receiver_type` varchar(100) NOT NULL,
  `message_subject_receiver_id` int(11) NOT NULL,
  `message_subject_sender_type` varchar(100) NOT NULL,
  `message_subject_sender_id` int(11) NOT NULL,
  `message_subject` text NOT NULL,
  `message_subject_ondate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message_subject_receiver_status` tinyint(4) NOT NULL DEFAULT '1',
  `message_subject_sender_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`message_subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `noticeboard`
--

CREATE TABLE IF NOT EXISTS `noticeboard` (
  `noticeboard_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `notice_title` text NOT NULL,
  `notice` text NOT NULL,
  `notice_attachment` text NOT NULL,
  `notice_date` varchar(30) NOT NULL,
  PRIMARY KEY (`noticeboard_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `scholastic`
--

CREATE TABLE IF NOT EXISTS `scholastic` (
  `scholastic_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `thinking_skills` text NOT NULL,
  `thinking_skills_grade` varchar(20) NOT NULL,
  `social_skills` text NOT NULL,
  `social_skills_grade` varchar(20) NOT NULL,
  `emotional_skills` text NOT NULL,
  `emotional_skills_grade` varchar(20) NOT NULL,
  `work_education` text NOT NULL,
  `work_education_grade` varchar(20) NOT NULL,
  `visual_and_performing_arts` text NOT NULL,
  `visual_and_performing_arts_grade` varchar(20) NOT NULL,
  `attitude_towards_teachers` text NOT NULL,
  `attitude_towards_teachers_grade` varchar(20) NOT NULL,
  `attitude_towards_schoolmates` text NOT NULL,
  `attitude_towards_schoolmates_grade` varchar(20) NOT NULL,
  `attitude_towards_school_programming_environment` text NOT NULL,
  `attitude_towards_school_programming_environment_grade` varchar(20) NOT NULL,
  `value_systems` text NOT NULL,
  `value_systems_grade` varchar(20) NOT NULL,
  `literary_creative_skills` text NOT NULL,
  `literary_creative_skills_grade` varchar(20) NOT NULL,
  `organizational_leadership_skills` text NOT NULL,
  `organizational_leadership_skills_grade` varchar(20) NOT NULL,
  `sports_indigenous_sports` text NOT NULL,
  `sports_indigenous_sports_grade` varchar(20) NOT NULL,
  `yoga` text NOT NULL,
  `yoga_grade` varchar(20) NOT NULL,
  `height` varchar(222) NOT NULL,
  `weight` varchar(222) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `vision_l` varchar(222) NOT NULL,
  `vision_r` varchar(222) NOT NULL,
  `dental_hygiene` varchar(222) NOT NULL,
  `my_goals` text NOT NULL,
  `my_strengths` text NOT NULL,
  `my_interests_hobbies` text NOT NULL,
  `resposibilities_discharged_exceptional_achievements` text NOT NULL,
  `scholastic_ondate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`scholastic_id`),
  KEY `student_id` (`student_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE IF NOT EXISTS `school` (
  `school_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_code` varchar(50) DEFAULT NULL,
  `school_affiliation_no` varchar(30) NOT NULL,
  `school_name` varchar(222) NOT NULL,
  `school_email_id` varchar(222) NOT NULL,
  `school_email_official` varchar(50) NOT NULL,
  `school_image` text NOT NULL,
  `school_logo_image` text NOT NULL,
  `school_title_image` text NOT NULL,
  `school_admin_name` varchar(20) NOT NULL,
  `school_admin_image` text NOT NULL,
  `school_id` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL,
  `school_average_fee` varchar(10) NOT NULL,
  `school_city` varchar(40) NOT NULL,
  `school_state` varchar(40) NOT NULL,
  `school_country` varchar(40) NOT NULL,
  `school_zip_code` varchar(6) NOT NULL,
  `school_address` varchar(222) NOT NULL,
  `school_phone1` varchar(15) NOT NULL,
  `school_phone2` varchar(15) NOT NULL,
  `school_fax` varchar(15) NOT NULL,
  `school_admin_phone` varchar(15) NOT NULL,
  `school_student_faculty_ratio` varchar(15) NOT NULL,
  `school_boy_girl_ratio` varchar(15) NOT NULL,
  `school_description` text NOT NULL,
  `school_student_create_limit` int(11) NOT NULL,
  `school_message_limit` int(11) NOT NULL,
  `school_last_visit` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `school_total_visit` int(11) NOT NULL DEFAULT '0',
  `school_activation_code` varchar(15) NOT NULL,
  `school_activation_code_status` tinyint(4) NOT NULL DEFAULT '0',
  `school_is_active` tinyint(4) NOT NULL DEFAULT '0',
  `school_create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `school_ip_address` varchar(20) NOT NULL,
  `change_password_status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`school_id`),
  UNIQUE KEY `school_code` (`school_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Table structure for table `school_event_calendar`
--

CREATE TABLE IF NOT EXISTS `school_event_calendar` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `parent_type` varchar(222) NOT NULL,
  `event_title` varchar(300) DEFAULT NULL,
  `event_description` text NOT NULL,
  `event_date` varchar(20) DEFAULT NULL,
  `month` int(8) DEFAULT NULL,
  `year` int(8) DEFAULT NULL,
  `event_time_from` varchar(10) NOT NULL,
  `event_time_to` varchar(10) DEFAULT NULL,
  `eventFor` varchar(30) NOT NULL,
  `eventClassId` text NOT NULL,
  `remindMe` tinyint(4) NOT NULL,
  `reminderTime` varchar(30) NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `school_sms_count`
--

CREATE TABLE IF NOT EXISTS `school_sms_count` (
  `school_sms_count_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `school_sms_count` int(11) NOT NULL,
  `school_sms_count_last_sms_date` varchar(30) NOT NULL,
  PRIMARY KEY (`school_sms_count_id`),
  KEY `school_id` (`school_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------



--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_admission_no` varchar(15) DEFAULT NULL,
  `school_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_from` varchar(10) NOT NULL,
  `student_to` varchar(10) NOT NULL,
  `student_email_id` varchar(50) NOT NULL,
  `student_user_id` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `student_image` text NOT NULL,
  `student_first_name` varchar(30) NOT NULL,
  `student_last_name` varchar(30) NOT NULL,
  `student_dob` varchar(30) NOT NULL,
  `student_gender` varchar(10) NOT NULL,
  `student_nationality` varchar(222) NOT NULL,
  `student_country` varchar(30) NOT NULL,
  `student_state` varchar(30) NOT NULL,
  `student_city` varchar(30) NOT NULL,
  `student_zip` varchar(6) NOT NULL,
  `student_address` varchar(222) NOT NULL,
  `student_contact` varchar(15) NOT NULL,
  `student_roll_number` varchar(15) NOT NULL,
  `student_with_school_since` varchar(10) NOT NULL,
  `student_transport_type` varchar(50) NOT NULL,
  `student_emergency_contact_person_name` varchar(222) NOT NULL,
  `student_emergency_contact_person_relation` varchar(222) NOT NULL,
  `student_emergency_contact_person_mobile` varchar(15) NOT NULL,
  `student_father_first_name` varchar(30) NOT NULL,
  `student_father_last_name` varchar(30) NOT NULL,
  `student_father_organization` varchar(222) NOT NULL,
  `student_father_phone` varchar(15) NOT NULL,
  `student_father_email_id` varchar(50) NOT NULL,
  `student_father_image` text NOT NULL,
  `student_mother_first_name` varchar(30) NOT NULL,
  `student_mother_last_name` varchar(30) NOT NULL,
  `student_mother_organization` varchar(222) NOT NULL,
  `student_mother_phone` varchar(15) NOT NULL,
  `student_mother_email_id` varchar(50) NOT NULL,
  `student_mother_image` text NOT NULL,
  `student_is_active` tinyint(4) NOT NULL DEFAULT '2',
  `student_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `student_account_delete` tinyint(4) NOT NULL DEFAULT '0',
  `change_password_status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`student_id`),
  KEY `class_id` (`class_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------



--
-- Table structure for table `student_attendance`
--

CREATE TABLE IF NOT EXISTS `student_attendance` (
  `student_attendance_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_attendance` tinyint(4) NOT NULL,
  `student_attendance_date` varchar(30) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  PRIMARY KEY (`student_attendance_id`),
  KEY `class_id` (`class_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_error_records`
--

CREATE TABLE IF NOT EXISTS `student_error_records` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(20) NOT NULL,
  `student_user_id` varchar(50) NOT NULL,
  `student_admission_no` varchar(15) DEFAULT NULL,
  `school_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_from` varchar(10) NOT NULL,
  `student_to` varchar(10) NOT NULL,
  `student_email_id` varchar(50) NOT NULL,
  `student_first_name` varchar(30) NOT NULL,
  `student_last_name` varchar(30) NOT NULL,
  `student_dob` varchar(30) NOT NULL,
  `student_gender` varchar(10) NOT NULL,
  `student_nationality` varchar(222) NOT NULL,
  `student_country` varchar(30) NOT NULL,
  `student_state` varchar(30) NOT NULL,
  `student_city` varchar(30) NOT NULL,
  `student_zip` varchar(6) NOT NULL,
  `student_address` varchar(222) NOT NULL,
  `student_contact` varchar(15) NOT NULL,
  `student_roll_number` varchar(15) NOT NULL,
  `student_with_school_since` varchar(10) NOT NULL,
  `student_transport_type` varchar(50) NOT NULL,
  `student_emergency_contact_person_name` varchar(222) NOT NULL,
  `student_emergency_contact_person_relation` varchar(222) NOT NULL,
  `student_emergency_contact_person_mobile` varchar(15) NOT NULL,
  `student_father_first_name` varchar(30) NOT NULL,
  `student_father_last_name` varchar(30) NOT NULL,
  `student_father_organization` varchar(222) NOT NULL,
  `student_father_phone` varchar(15) NOT NULL,
  `student_father_email_id` varchar(50) NOT NULL,
  `student_mother_first_name` varchar(30) NOT NULL,
  `student_mother_last_name` varchar(30) NOT NULL,
  `student_mother_organization` varchar(222) NOT NULL,
  `student_mother_phone` varchar(15) NOT NULL,
  `student_mother_email_id` varchar(50) NOT NULL,
  `errorList` text NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_fee_history`
--

CREATE TABLE IF NOT EXISTS `student_fee_history` (
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
  KEY `fee_collection_type_id` (`fee_collection_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_pre_registration`
--

CREATE TABLE IF NOT EXISTS `student_pre_registration` (
  `student_pre_registration_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_pre_registration_date` date NOT NULL,
  `student_pre_registration_first_name` varchar(222) NOT NULL,
  `student_pre_registration_last_name` varchar(222) NOT NULL,
  `student_pre_registration_dob` date NOT NULL,
  `student_pre_registration_email` varchar(222) NOT NULL,
  `student_pre_registration_address` text NOT NULL,
  `student_pre_registration_father_first_name` varchar(222) NOT NULL,
  `student_pre_registration_father_last_name` varchar(222) NOT NULL,
  `student_pre_registration_father_occupation` varchar(222) NOT NULL,
  `student_pre_registration_father_office_phone` varchar(15) NOT NULL,
  `student_pre_registration_father_resi_phone` varchar(15) NOT NULL,
  `student_pre_registration_father_mobile` varchar(15) NOT NULL,
  `student_pre_registration_mother_first_name` varchar(222) NOT NULL,
  `student_pre_registration_mother_last_name` varchar(222) NOT NULL,
  `student_pre_registration_mother_occupation` varchar(222) NOT NULL,
  `student_pre_registration_mother_office_phone` varchar(15) NOT NULL,
  `student_pre_registration_mother_resi_phone` varchar(15) NOT NULL,
  `student_pre_registration_mother_mobile` varchar(15) NOT NULL,
  `student_pre_registration_how_to_know` text NOT NULL,
  `student_pre_registration_suggestion` text NOT NULL,
  `student_pre_registration_remarks` text NOT NULL,
  `student_pre_registration_attendent` varchar(222) NOT NULL,
  `student_pre_registration_next_step` text NOT NULL,
  `student_pre_registration_ondate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `student_pre_registration_status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`student_pre_registration_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------



--
-- Table structure for table `student_sibling`
--

CREATE TABLE IF NOT EXISTS `student_sibling` (
  `student_sibling_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `student_sibling_name` varchar(222) NOT NULL,
  `student_sibling_age` varchar(100) NOT NULL,
  `student_sibling_gender` varchar(50) NOT NULL,
  `student_sibling_ondate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`student_sibling_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_subject`
--

CREATE TABLE IF NOT EXISTS `student_subject` (
  `student_subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_management_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_subject_ondate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`student_subject_id`),
  KEY `faculty_management_id` (`faculty_management_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_test`
--

CREATE TABLE IF NOT EXISTS `student_test` (
  `student_test_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `student_test_name` varchar(100) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `student_test_max_marks` int(11) NOT NULL,
  `student_test_date` varchar(15) NOT NULL,
  `student_test_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `student_test_is_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`student_test_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_test_obtain_marks`
--

CREATE TABLE IF NOT EXISTS `student_test_obtain_marks` (
  `student_test_obtain_marks_id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_test_id` int(11) NOT NULL,
  `student_test_obtain_marks` varchar(11) NOT NULL,
  `student_test_obtain_marks_comment` text NOT NULL,
  `student_test_obtain_marks_parent_remarks` text NOT NULL,
  PRIMARY KEY (`student_test_obtain_marks_id`),
  KEY `student_test_id` (`student_test_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(30) NOT NULL,
  `school_id` int(11) NOT NULL,
  `subject_delete` tinyint(4) NOT NULL DEFAULT '0',
  `subject_is_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------


--
-- Table structure for table `web_stat`
--

CREATE TABLE IF NOT EXISTS `web_stat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) DEFAULT NULL,
  `on_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------
--
-- Table structure for table `database_version`
--


CREATE TABLE IF NOT EXISTS `database_version` (
  `database_version_id` int(11) NOT NULL AUTO_INCREMENT,
  `database_version` varchar(222) NOT NULL,
  `database_version_ondate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`database_version_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `database_version`
--

INSERT INTO `database_version`( `database_version` ) VALUES
('1000');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album_images`
--
ALTER TABLE `album_images`
  ADD CONSTRAINT `album_images_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`) ON DELETE CASCADE;



--
-- Constraints for table `faculty_attendance`
--
ALTER TABLE `faculty_attendance`
  ADD CONSTRAINT `faculty_attendance_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`) ON DELETE CASCADE;

--
-- Constraints for table `faculty_designation_access_rights`
--
ALTER TABLE `faculty_designation_access_rights`
  ADD CONSTRAINT `faculty_designation_access_rights_ibfk_1` FOREIGN KEY (`faculty_designation_id`) REFERENCES `faculty_designation` (`faculty_designation_id`) ON DELETE CASCADE;



--
-- Constraints for table `faculty_management`
--
ALTER TABLE `faculty_management`
  ADD CONSTRAINT `faculty_management_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `faculty_management_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `faculty_management_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE;

--
-- Constraints for table `fee_collection_management`
--
ALTER TABLE `fee_collection_management`
  ADD CONSTRAINT `fee_collection_management_ibfk_1` FOREIGN KEY (`fee_structure_id`) REFERENCES `fee_structure` (`fee_structure_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fee_collection_management_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `fee_structure`
--
ALTER TABLE `fee_structure`
  ADD CONSTRAINT `fee_structure_ibfk_1` FOREIGN KEY (`fee_category_id`) REFERENCES `fee_category` (`fee_category_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fee_structure_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE;



--
-- Constraints for table `home_work`
--
ALTER TABLE `home_work`
  ADD CONSTRAINT `home_work_ibfk_1` FOREIGN KEY (`faculty_management_id`) REFERENCES `faculty_management` (`faculty_management_id`) ON DELETE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`message_subject_id`) REFERENCES `message_subject` (`message_subject_id`) ON DELETE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE;



--
-- Constraints for table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD CONSTRAINT `student_attendance_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_attendance_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `student_fee_history`
--
ALTER TABLE `student_fee_history`
  ADD CONSTRAINT `student_fee_history_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_fee_history_ibfk_2` FOREIGN KEY (`fee_collection_type_id`) REFERENCES `fee_collection_type` (`fee_collection_type_id`) ON DELETE CASCADE;

--
-- Constraints for table `student_subject`
--
ALTER TABLE `student_subject`
  ADD CONSTRAINT `student_subject_ibfk_1` FOREIGN KEY (`faculty_management_id`) REFERENCES `faculty_management` (`faculty_management_id`) ON DELETE CASCADE;

--
-- Constraints for table `student_test_obtain_marks`
--
ALTER TABLE `student_test_obtain_marks`
  ADD CONSTRAINT `student_test_obtain_marks_ibfk_1` FOREIGN KEY (`student_test_id`) REFERENCES `student_test` (`student_test_id`) ON DELETE CASCADE;