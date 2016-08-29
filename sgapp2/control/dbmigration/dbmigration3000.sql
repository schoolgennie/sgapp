ALTER TABLE fee_fine ADD  `fee_fine_max` varchar(10) NOT NULL;
ALTER TABLE student ADD  `student_father_occupation` varchar(222) NOT NULL;
ALTER TABLE student ADD  `student_father_office_phone` varchar(15) NOT NULL;
ALTER TABLE student ADD  `student_father_mobile` varchar(15) NOT NULL;
ALTER TABLE student ADD  `student_mother_occupation` varchar(222) NOT NULL;
ALTER TABLE student ADD  `student_mother_office_phone` varchar(15) NOT NULL;
ALTER TABLE student ADD  `student_mother_mobile` varchar(15) NOT NULL;
ALTER TABLE student DROP COLUMN student_father_organization;
ALTER TABLE student DROP COLUMN student_mother_organization;