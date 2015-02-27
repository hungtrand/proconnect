CREATE TABLE `Industries` (
  `IndustryID` int(11) NOT NULL AUTO_INCREMENT,
  `IndustryCode` int(11) DEFAULT NULL,
  `IndustryGroups` varchar(45) DEFAULT NULL,
  `InsdustryName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`IndustryID`)
) ENGINE=InnoDB AUTO_INCREMENT=256 DEFAULT CHARSET=latin1;
