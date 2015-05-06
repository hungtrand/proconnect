CREATE DATABASE  IF NOT EXISTS `ProConnect` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ProConnect`;
-- MySQL dump 10.13  Distrib 5.6.19, for linux-glibc2.5 (x86_64)
--
-- Host: 127.0.0.1    Database: ProConnect
-- ------------------------------------------------------
-- Server version	5.5.43-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Account`
--

DROP TABLE IF EXISTS `Account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Account` (
  `AccountID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `LastLogin` datetime DEFAULT NULL,
  `Active` bit(1) NOT NULL DEFAULT b'1',
  `UserID` int(11) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `Email_Alt` varchar(100) NOT NULL,
  `SecurityQuestion` varchar(300) NOT NULL,
  `SecurityAnswer` varchar(300) NOT NULL,
  `Verified` bit(1) NOT NULL DEFAULT b'0',
  `VerificationKey` varchar(200) DEFAULT NULL,
  `isRecruiter` bit(1) NOT NULL DEFAULT b'0',
  `ForgotPasswordKey` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`AccountID`),
  UNIQUE KEY `VerificationKey_UNIQUE` (`VerificationKey`),
  UNIQUE KEY `ForgotPasswordKey_UNIQUE` (`ForgotPasswordKey`),
  KEY `Account_ibfk_1` (`UserID`),
  CONSTRAINT `Account_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Connections`
--

DROP TABLE IF EXISTS `Connections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Connections` (
  `ConnID` int(11) NOT NULL AUTO_INCREMENT,
  `InitUserID` int(11) NOT NULL,
  `TargetUserID` int(11) NOT NULL,
  `Accepted` bit(1) DEFAULT b'0',
  `CreatedDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Message` varchar(500) DEFAULT NULL,
  `Declined` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ConnID`),
  KEY `fk_Connections_User_InitUser_idx` (`InitUserID`),
  KEY `fk_Connections_User_TargetUser_idx` (`TargetUserID`),
  CONSTRAINT `fk_Connections_User_InitUser` FOREIGN KEY (`InitUserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Connections_User_TargetUser` FOREIGN KEY (`TargetUserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Education`
--

DROP TABLE IF EXISTS `Education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Education` (
  `EduID` int(11) NOT NULL AUTO_INCREMENT,
  `School` varchar(200) NOT NULL,
  `Degree` varchar(200) DEFAULT NULL,
  `FieldOfStudy` varchar(200) DEFAULT NULL,
  `Activities` varchar(45) DEFAULT NULL,
  `UserID` int(11) NOT NULL,
  `GPA` decimal(4,3) DEFAULT NULL,
  `YearStart` int(4) DEFAULT NULL,
  `YearEnd` int(4) DEFAULT NULL,
  `Description` text,
  PRIMARY KEY (`EduID`),
  UNIQUE KEY `EduID_UNIQUE` (`EduID`),
  KEY `fk_Education_User_idx` (`UserID`),
  CONSTRAINT `fk_Education_User` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `EmailQueue`
--

DROP TABLE IF EXISTS `EmailQueue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EmailQueue` (
  `EQID` int(11) NOT NULL AUTO_INCREMENT,
  `EmailTo` varchar(500) NOT NULL,
  `EmailSubject` varchar(300) DEFAULT NULL,
  `EmailBody` text,
  `EmailCC` varchar(500) DEFAULT NULL,
  `EmailBCC` varchar(45) DEFAULT NULL,
  `SubmittedDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `SentDate` datetime DEFAULT NULL,
  `Status` varchar(45) DEFAULT NULL,
  `EmailFrom` varchar(100) DEFAULT NULL,
  `EmailReplyTo` varchar(100) DEFAULT NULL,
  `FailMessage` text,
  PRIMARY KEY (`EQID`),
  UNIQUE KEY `EQID_UNIQUE` (`EQID`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `EmailTemplates`
--

DROP TABLE IF EXISTS `EmailTemplates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EmailTemplates` (
  `ETemplateID` int(11) NOT NULL AUTO_INCREMENT,
  `TemplateName` varchar(200) DEFAULT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `EmailSubject` varchar(200) DEFAULT NULL,
  `EmailBody` text,
  `LastUpdated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ETemplateID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Experience`
--

DROP TABLE IF EXISTS `Experience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Experience` (
  `ExpID` int(11) NOT NULL AUTO_INCREMENT,
  `CompanyName` varchar(100) DEFAULT NULL,
  `Title` varchar(50) DEFAULT NULL,
  `Location` varchar(150) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `DateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `StartMonth` int(2) DEFAULT NULL,
  `StartYear` int(4) DEFAULT NULL,
  `EndMonth` int(2) DEFAULT NULL,
  `EndYear` int(4) DEFAULT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`ExpID`),
  KEY `fk_Experience_User_idx` (`UserID`),
  CONSTRAINT `fk_Experience_User` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Feed`
--

DROP TABLE IF EXISTS `Feed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Feed` (
  `FeedID` int(11) NOT NULL AUTO_INCREMENT,
  `Content` longtext,
  `ImageURL` varchar(300) DEFAULT NULL,
  `ExternalURL` varchar(300) DEFAULT NULL,
  `InternalURL` varchar(300) DEFAULT NULL,
  `Creator` int(11) DEFAULT NULL,
  `Type` varchar(45) DEFAULT NULL,
  `DateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `InterestCategory` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`FeedID`),
  UNIQUE KEY `FeedID_UNIQUE` (`FeedID`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Feed2User`
--

DROP TABLE IF EXISTS `Feed2User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Feed2User` (
  `UFID` int(11) NOT NULL AUTO_INCREMENT,
  `FeedID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Liked` bit(1) NOT NULL DEFAULT b'0',
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isCreator` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`UFID`),
  UNIQUE KEY `UFID_UNIQUE` (`UFID`),
  KEY `fk_User_Feeds_1_idx` (`FeedID`),
  KEY `fk_User_Feeds_2_idx` (`UserID`),
  CONSTRAINT `fk_User_Feeds_1` FOREIGN KEY (`FeedID`) REFERENCES `Feed` (`FeedID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_Feeds_2` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=551 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Feed_Comments`
--

DROP TABLE IF EXISTS `Feed_Comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Feed_Comments` (
  `CommentID` int(11) NOT NULL AUTO_INCREMENT,
  `FeedID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Comment` text,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CommentID`),
  UNIQUE KEY `CommentID_UNIQUE` (`CommentID`),
  KEY `fk_Feed_Comments_Feed_idx` (`FeedID`),
  KEY `fk_Feed_Comments_user_idx` (`UserID`),
  CONSTRAINT `fk_Feed_Comments_Feed` FOREIGN KEY (`FeedID`) REFERENCES `Feed` (`FeedID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Feed_Comments_user` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Job`
--

DROP TABLE IF EXISTS `Job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Job` (
  `JobID` int(11) NOT NULL AUTO_INCREMENT,
  `PreferenceLocation` varchar(500) DEFAULT NULL,
  `PreferenceIndustry` varchar(500) DEFAULT NULL,
  `PreferenceJobType` varchar(500) DEFAULT NULL,
  `JobHiring` bit(1) NOT NULL DEFAULT b'0',
  `UserID` int(11) DEFAULT NULL,
  `JobLocation` varchar(500) DEFAULT NULL,
  `JobTitle` varchar(500) DEFAULT NULL,
  `Industry` varchar(500) DEFAULT NULL,
  `CompanyName` varchar(500) DEFAULT NULL,
  `CompanyDescription` varchar(1000) DEFAULT NULL,
  `Experience` varchar(500) DEFAULT NULL,
  `SpecialSkill` varchar(500) DEFAULT NULL,
  `EmploymentType` varchar(500) DEFAULT NULL,
  `JobDescription` varchar(600) DEFAULT NULL,
  `JobFunction` varchar(300) DEFAULT NULL,
  `DateCreated` timestamp NULL DEFAULT NULL,
  `ContactInfo` varchar(600) DEFAULT NULL,
  `CompanyImage` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`JobID`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Message`
--

DROP TABLE IF EXISTS `Message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Message` (
  `MessageID` int(11) NOT NULL AUTO_INCREMENT,
  `Subject` varchar(300) DEFAULT NULL,
  `Body` text,
  `Creator` int(11) DEFAULT NULL,
  `DateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`MessageID`),
  UNIQUE KEY `MessageID_UNIQUE` (`MessageID`),
  KEY `fk_Message_User_idx` (`Creator`),
  CONSTRAINT `fk_Message_User` FOREIGN KEY (`Creator`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `MessageView`
--

DROP TABLE IF EXISTS `MessageView`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MessageView` (
  `MessageViewID` int(11) NOT NULL AUTO_INCREMENT,
  `MessageID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Read` bit(1) NOT NULL DEFAULT b'0',
  `Archived` bit(1) NOT NULL DEFAULT b'0',
  `Deleted` bit(1) NOT NULL DEFAULT b'0',
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isCreator` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`MessageViewID`),
  UNIQUE KEY `MessageViewID_UNIQUE` (`MessageViewID`),
  KEY `fk_MessageView_User_idx` (`UserID`),
  KEY `fk_MessageView_Message_idx` (`MessageID`),
  CONSTRAINT `fk_MessageView_Message` FOREIGN KEY (`MessageID`) REFERENCES `Message` (`MessageID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_MessageView_User` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Notification`
--

DROP TABLE IF EXISTS `Notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Notification` (
  `NotificationID` int(11) NOT NULL AUTO_INCREMENT,
  `Message` varchar(200) DEFAULT NULL,
  `Type` varchar(45) DEFAULT NULL,
  `Timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UserID` int(11) DEFAULT NULL,
  `ActionLink` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`NotificationID`),
  KEY `fk_Notification_User_idx` (`UserID`),
  CONSTRAINT `fk_Notification_User` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NotificationView`
--

DROP TABLE IF EXISTS `NotificationView`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NotificationView` (
  `NotificationViewID` int(11) NOT NULL AUTO_INCREMENT,
  `NotificationID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Read` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`NotificationViewID`),
  UNIQUE KEY `NotificationViewID_UNIQUE` (`NotificationViewID`),
  KEY `fk_NotificationView_User_idx` (`UserID`),
  KEY `fk_NotificationView_Notification_idx` (`NotificationID`),
  CONSTRAINT `fk_NotificationView_Notification` FOREIGN KEY (`NotificationID`) REFERENCES `Notification` (`NotificationID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_NotificationView_User` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=225 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Projects`
--

DROP TABLE IF EXISTS `Projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Projects` (
  `ProjectID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectTitle` varchar(100) DEFAULT NULL,
  `ProjectURL` varchar(2000) DEFAULT NULL,
  `Occupation` varchar(200) DEFAULT NULL,
  `Description` varchar(5000) DEFAULT NULL,
  `UserID` int(11) NOT NULL,
  `StartMonth` int(2) DEFAULT NULL,
  `StartYear` int(4) DEFAULT NULL,
  `EndMonth` int(2) DEFAULT NULL,
  `EndYear` int(4) DEFAULT NULL,
  `DateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ProjectID`),
  KEY `fk_Projects_User_idx` (`UserID`),
  CONSTRAINT `fk_Projects_User` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Skills`
--

DROP TABLE IF EXISTS `Skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Skills` (
  `SkillID` int(11) NOT NULL AUTO_INCREMENT,
  `SkillName` varchar(100) NOT NULL,
  `Endorsements` int(11) DEFAULT '0',
  `OrderPosition` int(11) DEFAULT '0',
  `UserID` int(11) NOT NULL,
  `DateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`SkillID`),
  UNIQUE KEY `SkillID_UNIQUE` (`SkillID`),
  KEY `fk_Skills_User_idx` (`UserID`),
  CONSTRAINT `fk_Skills_User` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(100) DEFAULT NULL,
  `MiddleName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `Birthday` datetime DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `State` varchar(100) DEFAULT NULL,
  `Zip` varchar(10) DEFAULT NULL,
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Summary` text,
  `Phone` varchar(45) DEFAULT NULL,
  `PhoneType` varchar(45) DEFAULT NULL,
  `EmploymentStatus` varchar(45) DEFAULT NULL,
  `Country` varchar(45) DEFAULT NULL,
  `ProfileImage` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `vw_Feed`
--

DROP TABLE IF EXISTS `vw_Feed`;
/*!50001 DROP VIEW IF EXISTS `vw_Feed`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vw_Feed` AS SELECT 
 1 AS `FeedID`,
 1 AS `Content`,
 1 AS `ImageURL`,
 1 AS `ExternalURL`,
 1 AS `InternalURL`,
 1 AS `InterestCategory`,
 1 AS `Creator`,
 1 AS `Type`,
 1 AS `DateCreated`,
 1 AS `nLiked`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_PersonalInfo`
--

DROP TABLE IF EXISTS `vw_PersonalInfo`;
/*!50001 DROP VIEW IF EXISTS `vw_PersonalInfo`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vw_PersonalInfo` AS SELECT 
 1 AS `UserID`,
 1 AS `FirstName`,
 1 AS `MiddleName`,
 1 AS `LastName`,
 1 AS `Name`,
 1 AS `Gender`,
 1 AS `Birthday`,
 1 AS `Address`,
 1 AS `City`,
 1 AS `State`,
 1 AS `Zip`,
 1 AS `Summary`,
 1 AS `ProfileImage`,
 1 AS `Phone`,
 1 AS `PhoneType`,
 1 AS `EmploymentStatus`,
 1 AS `Country`,
 1 AS `AccountID`,
 1 AS `Email`,
 1 AS `Email_Alt`,
 1 AS `Username`,
 1 AS `Password`,
 1 AS `Active`,
 1 AS `Verified`,
 1 AS `isRecruiter`,
 1 AS `AllStudies`,
 1 AS `AllSchools`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `vw_Feed`
--

/*!50001 DROP VIEW IF EXISTS `vw_Feed`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_Feed` AS select `Feed`.`FeedID` AS `FeedID`,`Feed`.`Content` AS `Content`,`Feed`.`ImageURL` AS `ImageURL`,`Feed`.`ExternalURL` AS `ExternalURL`,`Feed`.`InternalURL` AS `InternalURL`,`Feed`.`InterestCategory` AS `InterestCategory`,`Feed`.`Creator` AS `Creator`,`Feed`.`Type` AS `Type`,`Feed`.`DateCreated` AS `DateCreated`,(select count(`f2u`.`FeedID`) from `Feed2User` `f2u` where ((`Feed`.`FeedID` = `f2u`.`FeedID`) and (`f2u`.`Liked` = 1))) AS `nLiked` from `Feed` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_PersonalInfo`
--

/*!50001 DROP VIEW IF EXISTS `vw_PersonalInfo`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_PersonalInfo` AS (select `User`.`UserID` AS `UserID`,`User`.`FirstName` AS `FirstName`,`User`.`MiddleName` AS `MiddleName`,`User`.`LastName` AS `LastName`,concat(`User`.`FirstName`,' ',`User`.`MiddleName`,' ',`User`.`LastName`) AS `Name`,`User`.`Gender` AS `Gender`,`User`.`Birthday` AS `Birthday`,`User`.`Address` AS `Address`,`User`.`City` AS `City`,`User`.`State` AS `State`,`User`.`Zip` AS `Zip`,`User`.`Summary` AS `Summary`,`User`.`ProfileImage` AS `ProfileImage`,`User`.`Phone` AS `Phone`,`User`.`PhoneType` AS `PhoneType`,`User`.`EmploymentStatus` AS `EmploymentStatus`,`User`.`Country` AS `Country`,`Account`.`AccountID` AS `AccountID`,`Account`.`Email` AS `Email`,`Account`.`Email_Alt` AS `Email_Alt`,`Account`.`Username` AS `Username`,`Account`.`Password` AS `Password`,`Account`.`Active` AS `Active`,`Account`.`Verified` AS `Verified`,`Account`.`isRecruiter` AS `isRecruiter`,(select group_concat(`Education`.`FieldOfStudy` separator ',') from `Education` where (`Education`.`UserID` = `User`.`UserID`)) AS `AllStudies`,(select group_concat(`Education`.`School` separator ',') from `Education` where (`Education`.`UserID` = `User`.`UserID`)) AS `AllSchools` from (`User` join `Account` on((`User`.`UserID` = `Account`.`UserID`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-06 16:44:13
