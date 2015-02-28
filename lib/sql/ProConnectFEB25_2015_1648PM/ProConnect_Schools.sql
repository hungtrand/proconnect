CREATE TABLE `Schools` (
  `SchoolsID` int(11) NOT NULL AUTO_INCREMENT,
  `SchoolShort` varchar(9) DEFAULT NULL,
  `SchoolName` varchar(100) DEFAULT NULL,
  `SchoolWebSite` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`SchoolsID`)
) ENGINE=InnoDB AUTO_INCREMENT=16384 DEFAULT CHARSET=latin1;
