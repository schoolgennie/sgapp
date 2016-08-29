ALTER TABLE student_pre_registration ADD  `student_pre_registration_location` varchar(222) NOT NULL;
ALTER TABLE student_pre_registration ADD  `student_pre_registration_previous_school` varchar(222) NOT NULL;
CREATE TABLE IF NOT EXISTS `fee_waiver_category` (
  `fee_waiver_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_waiver_category` varchar(222) NOT NULL,
  `fee_waiver_category_ondate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fee_waiver_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
INSERT INTO `fee_collection_type` (`fee_collection_type`, `fee_collection_type_start_date`, `fee_collection_type_end_date`, `fee_collection_type_due_date`) VALUES
('One Time Fee', '2014-04-01', '2015-03-31', '2015-03-31');