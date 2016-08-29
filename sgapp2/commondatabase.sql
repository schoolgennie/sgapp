CREATE TABLE IF NOT EXISTS `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL DEFAULT '',
  `password` varchar(30) NOT NULL,
  `last_access` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `allow_pages` varchar(255) NOT NULL DEFAULT '*',
  `type` varchar(20) NOT NULL DEFAULT 'Administrator',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='website control panel scrap table' AUTO_INCREMENT=2 ;
--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `username`, `password`, `last_access`, `allow_pages`, `type`, `is_active`) VALUES
(1, 'admin', 'admin', '2011-08-18 16:11:52', '*', 'administrator', 1);

CREATE TABLE IF NOT EXISTS `database_details` (
  `database_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `database_host` varchar(222) NOT NULL,
  `database_name` varchar(100) NOT NULL,
  `database_username` varchar(100) NOT NULL,
  `database_password` varchar(100) NOT NULL,
  PRIMARY KEY (`database_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;
CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `value` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `name` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `title` varchar(255) DEFAULT NULL,
  `type` varchar(20) DEFAULT 'select',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `page` longtext,
  `meta_title` text NOT NULL,
  `meta_keyword` text,
  `meta_description` text,
  `parent_id` int(11) DEFAULT NULL,
  `image` varchar(222) NOT NULL,
  `story` tinyint(2) NOT NULL,
  `news` tinyint(2) NOT NULL,
  `video` tinyint(2) NOT NULL,
  `pageColumn` int(2) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
CREATE TABLE IF NOT EXISTS `school` (
  `school_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_code` varchar(50) DEFAULT NULL,
   PRIMARY KEY (`school_id`),
  UNIQUE KEY `school_code` (`school_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;
CREATE TABLE IF NOT EXISTS `web_stat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) DEFAULT NULL,
  `on_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) 