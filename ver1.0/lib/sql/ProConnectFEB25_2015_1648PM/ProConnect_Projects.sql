CREATE TABLE `Projects` (
  `ProjectID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectTitle` varchar(100) DEFAULT NULL,
  `ProjectURL` varchar(2000) DEFAULT NULL,
  `Occupation` varchar(200) DEFAULT NULL,
  `Department` varchar(200) DEFAULT NULL,
  `Role` varchar(200) DEFAULT NULL,
  `TeamMembers` varchar(200) DEFAULT NULL,
  `Description` varchar(5000) DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  PRIMARY KEY (`ProjectID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
