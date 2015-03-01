CREATE TABLE `Experience` (
  `ExperienceID` int(11) NOT NULL AUTO_INCREMENT,
  `CompanyName` varchar(100) DEFAULT NULL,
  `Title` varchar(50) DEFAULT NULL,
  `Location` varchar(150) DEFAULT NULL,
  `TimePeriod` varchar(45) DEFAULT NULL,
  `Description` varchar(200) DEFAULT NULL,
  `DateCreated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ExperienceID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
