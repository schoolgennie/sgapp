ALTER TABLE student_pre_registration ADD  `student_pre_registration_is_enroll` tinyint(4) NOT NULL DEFAULT '0';
ALTER TABLE student_pre_registration ADD  `student_pre_registration_reminder_date` date NOT NULL;
ALTER TABLE student_pre_registration MODIFY COLUMN student_pre_registration_status int(11) NOT NULL DEFAULT '2';
CREATE TABLE IF NOT EXISTS `student_pre_registration_comment_history` (
  `student_pre_registration_comment_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_pre_registration_id` int(11) NOT NULL,
  `student_pre_registration_comment_history_status` int(4) NOT NULL,
  `student_pre_registration_comment` text NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `student_pre_registration_comment_history_ondate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`student_pre_registration_comment_history_id`)
) ;