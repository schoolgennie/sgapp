CREATE TABLE IF NOT EXISTS `time_table` (
  `time_table_id` int(11) NOT NULL AUTO_INCREMENT,
  `time_table` varchar(50) NOT NULL,
  `time_table_is_active` tinyint(4) NOT NULL DEFAULT '0',
  `time_table_on_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`time_table_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `time_table_period` (
  `time_table_period_id` int(11) NOT NULL AUTO_INCREMENT,
  `time_table_id` int(11) NOT NULL,
  `time_table_period` varchar(50) NOT NULL,
  `time_table_period_time` varchar(50) NOT NULL,
  `time_table_period_on_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`time_table_period_id`),
  KEY `time_table_id` (`time_table_id`),
  FOREIGN KEY (`time_table_id`) REFERENCES `time_table` (`time_table_id`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `time_table_management` (
  `time_table_management_id` int(11) NOT NULL AUTO_INCREMENT,
  `time_table_id` int(11) NOT NULL,
  `time_table_period_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `faculty_management_id` int(11) NOT NULL,
  `time_table_management_week_day` int(11) NOT NULL,
  `time_table_period_on_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`time_table_management_id`),
  KEY `time_table_id` (`time_table_id`),
  KEY `time_table_period_id` (`time_table_period_id`),
  KEY `class_id` (`class_id`),
  KEY `time_table_management_id` (`time_table_management_id`),
  FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE,
  FOREIGN KEY (`faculty_management_id`) REFERENCES `faculty_management` (`faculty_management_id`) ON DELETE CASCADE,
  FOREIGN KEY (`time_table_id`) REFERENCES `time_table` (`time_table_id`) ON DELETE CASCADE,
  FOREIGN KEY (`time_table_period_id`) REFERENCES `time_table_period` (`time_table_period_id`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;