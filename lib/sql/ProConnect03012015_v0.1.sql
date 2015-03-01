CREATE DATABASE  IF NOT EXISTS `ProConnect` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ProConnect`;
-- MySQL dump 10.13  Distrib 5.6.19, for linux-glibc2.5 (x86_64)
--
-- Host: 127.0.0.1    Database: ProConnect
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

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
  PRIMARY KEY (`AccountID`),
  UNIQUE KEY `VerificationKey_UNIQUE` (`VerificationKey`),
  KEY `Account_ibfk_1` (`UserID`),
  CONSTRAINT `Account_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Account`
--

LOCK TABLES `Account` WRITE;
/*!40000 ALTER TABLE `Account` DISABLE KEYS */;
INSERT INTO `Account` VALUES (6,'hung.d.tran@sjsu.edu','8cb2237d0679ca88db6464eac60da96345513964','2015-02-27 09:57:00',NULL,'',7,'hung.d.tran@sjsu.edu','','','','','4f1f9bc6dc9fe6e8f2f3a9e58bc1d970f74da755','\0'),(9,'hungtrand0929@gmail.com','448ed7416fce2cb66c285d182b1ba3df1e90016d','2015-03-01 20:32:24',NULL,'',10,'hungtrand0929@gmail.com','','','','','12864cd03656bdeaab0a69705f18c57daf92fadd','\0');
/*!40000 ALTER TABLE `Account` ENABLE KEYS */;
UNLOCK TABLES;

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
  `Grade` varchar(10) DEFAULT NULL,
  `Activities` varchar(45) DEFAULT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`EduID`),
  UNIQUE KEY `EduID_UNIQUE` (`EduID`),
  KEY `fk_Education_User_idx` (`UserID`),
  CONSTRAINT `fk_Education_User` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Education`
--

LOCK TABLES `Education` WRITE;
/*!40000 ALTER TABLE `Education` DISABLE KEYS */;
/*!40000 ALTER TABLE `Education` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EmailQueue`
--

LOCK TABLES `EmailQueue` WRITE;
/*!40000 ALTER TABLE `EmailQueue` DISABLE KEYS */;
INSERT INTO `EmailQueue` VALUES (1,'hung.d.tran@sjsu.edu',NULL,NULL,NULL,NULL,'2015-02-25 20:08:53',NULL,'failed',NULL,NULL,NULL),(2,'hung.d.tran@sjsu.edu',NULL,NULL,NULL,NULL,'2015-02-25 20:09:31',NULL,'failed',NULL,NULL,NULL),(3,'hung.d.tran@sjsu.edu','TestSubject','TESTBody',NULL,NULL,'2015-02-25 20:11:56',NULL,'failed',NULL,NULL,NULL),(4,'hung.d.tran@sjsu.edu','TestSubject','TESTBody',NULL,NULL,'2015-02-25 20:14:06',NULL,'failed',NULL,NULL,'Message could not be sent.Mailer Error: SMTP connect() failed.'),(5,'hung.d.tran@sjsu.edu','TestSubject','TESTBody',NULL,NULL,'2015-02-25 20:17:38',NULL,'failed',NULL,NULL,'Message could not be sent.Mailer Error: SMTP connect() failed.'),(6,'hung.d.tran@sjsu.edu','TestSubject','TESTBody',NULL,NULL,'2015-02-25 20:19:32','2015-02-25 12:19:32','sent',NULL,NULL,NULL),(7,'hung.d.tran@sjsu.edu','Welcome To ProConnect - Email Verification','Dear {{FulllName}}, Thank you for joining the network for professionals. Before we can get you started, please click on the link below to activate your account. http://www.google.com',NULL,NULL,'2015-02-25 22:07:22','2015-02-25 14:07:22','sent',NULL,NULL,NULL),(8,'hung.d.tran@sjsu.edu','Welcome To ProConnect - Email Verification','Dear Hung Tran, Thank you for joining the network for professionals. Before we can get you started, please click on the link below to activate your account. http://www.google.com',NULL,NULL,'2015-02-25 22:08:51','2015-02-25 14:08:51','sent',NULL,NULL,NULL),(9,'hung.d.tran@sjsu.edu','Welcome To ProConnect - Email Verification','Dear BruceWayne, Thank you for joining the network for professionals. Before we can get you started, please click on the link below to activate your account. https://www.proconnect.com/ver1.0/signup/EmailVerification.php?VerificationKey=2e166c3fe8261dbbcd01e3b89ef63b01e6bc1d1e',NULL,NULL,'2015-02-26 00:06:32','2015-02-25 16:06:32','sent',NULL,NULL,NULL),(10,'hung.d.tran@sjsu.edu','Welcome To ProConnect - Email Verification','Dear BruceWayne, Thank you for joining the network for professionals. Before we can get you started, please click on the link below to activate your account. https://www.proconnect.com/ver1.0/signup/EmailVerification.php?VerificationKey=b62bf75dde57ad1f03d3a77f898e7a278419a877',NULL,NULL,'2015-02-26 00:07:07','2015-02-25 16:07:07','sent',NULL,NULL,NULL),(11,'hungtrand092@gmail.com','Welcome To ProConnect - Email Verification','Dear PeterParker, Thank you for joining the network for professionals. Before we can get you started, please click on the link below to activate your account. https://www.proconnect.com/ver1.0/signup/EmailVerification.php?VerificationKey=ecbf673c5e885a3c7d883eb0e7e61576c35a756f',NULL,NULL,'2015-02-26 00:30:45','2015-02-25 16:30:45','sent',NULL,NULL,NULL),(12,'hungtrand0929@gmail.com','Welcome To ProConnect - Email Verification','Dear IronMan, Thank you for joining the network for professionals. Before we can get you started, please click on the link below to activate your account. https://www.proconnect.com/ver1.0/signup/EmailVerification.php?VerificationKey=7524f96038be12c9f4facd6a72a7087f4508602c',NULL,NULL,'2015-02-26 00:32:14','2015-02-25 16:32:14','sent',NULL,NULL,NULL),(13,'hung.d.tran@sjsu.edu','Welcome To ProConnect - Email Verification','Dear Bruce Wayne, Thank you for joining the network for professionals. Before we can get you started, please click on the link below to activate your account. https://www.proconnect.com/ver1.0/signup/EmailVerification.php?VerificationKey=4f1f9bc6dc9fe6e8f2f3a9e58bc1d970f74da755',NULL,NULL,'2015-02-27 09:57:02','2015-02-27 01:57:02','sent',NULL,NULL,NULL),(14,'hungtrand0929@gmail.com','Welcome To ProConnect - Email Verification','Dear Hung Tran, Thank you for joining the network for professionals. Before we can get you started, please click on the link below to activate your account. https://www.proconnect.com/ver1.0/signup/EmailVerification.php?VerificationKey=7454319399efdf71fab0febda55f8edc076f7275',NULL,NULL,'2015-03-01 17:25:48','2015-03-01 09:25:48','sent',NULL,NULL,NULL),(15,'hungtrand0929@gmail.com','Welcome To ProConnect - Email Verification','Dear Hung Tran, Thank you for joining the network for professionals. Before we can get you started, please click on the link below to activate your account. http://79.170.40.230/proconnect.com/signup/EmailVerification.php?Email=hungtrand0929%40gmail.comVerificationKey=c8217b42f912776c380b5db3c725945f3ced5c1f',NULL,NULL,'2015-03-01 18:29:19','2015-03-01 10:29:19','sent',NULL,NULL,NULL),(16,'hungtrand0929@gmail.com','Welcome To ProConnect - Email Verification','Dear Hung Tran, Thank you for joining the network for professionals. Before we can get you started, please click on the link below to activate your account. http://79.170.40.230/proconnect.com/signup/EmailVerification.php?Email=hungtrand0929%40gmail.com&VerificationKey=12864cd03656bdeaab0a69705f18c57daf92fadd',NULL,NULL,'2015-03-01 20:32:26','2015-03-01 12:32:26','sent',NULL,NULL,NULL);
/*!40000 ALTER TABLE `EmailQueue` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EmailTemplates`
--

LOCK TABLES `EmailTemplates` WRITE;
/*!40000 ALTER TABLE `EmailTemplates` DISABLE KEYS */;
INSERT INTO `EmailTemplates` VALUES (1,'Account Email Verification','Send user an email regarding their account was created and they need to click on a link to verify their email address and activate their account.','Welcome To ProConnect - Email Verification','Dear {{FullName}}, Thank you for joining the network for professionals. Before we can get you started, please click on the link below to activate your account. {{VerificationLink}}',NULL);
/*!40000 ALTER TABLE `EmailTemplates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Experience`
--

DROP TABLE IF EXISTS `Experience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Experience` (
  `ExperienceID` int(11) NOT NULL AUTO_INCREMENT,
  `CompanyName` varchar(100) DEFAULT NULL,
  `Title` varchar(50) DEFAULT NULL,
  `Location` varchar(150) DEFAULT NULL,
  `TimePeriod` varchar(45) DEFAULT NULL,
  `Description` varchar(200) DEFAULT NULL,
  `DateCreated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ExperienceID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Experience`
--

LOCK TABLES `Experience` WRITE;
/*!40000 ALTER TABLE `Experience` DISABLE KEYS */;
/*!40000 ALTER TABLE `Experience` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Industries`
--

DROP TABLE IF EXISTS `Industries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Industries` (
  `IndustryID` int(11) NOT NULL AUTO_INCREMENT,
  `IndustryCode` int(11) DEFAULT NULL,
  `IndustryGroups` varchar(45) DEFAULT NULL,
  `InsdustryName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`IndustryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Industries`
--

LOCK TABLES `Industries` WRITE;
/*!40000 ALTER TABLE `Industries` DISABLE KEYS */;
/*!40000 ALTER TABLE `Industries` ENABLE KEYS */;
UNLOCK TABLES;

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
  `Department` varchar(200) DEFAULT NULL,
  `Role` varchar(200) DEFAULT NULL,
  `TeamMembers` varchar(200) DEFAULT NULL,
  `Description` varchar(5000) DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  PRIMARY KEY (`ProjectID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Projects`
--

LOCK TABLES `Projects` WRITE;
/*!40000 ALTER TABLE `Projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `Projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Schools`
--

DROP TABLE IF EXISTS `Schools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Schools` (
  `SchoolsID` int(11) NOT NULL AUTO_INCREMENT,
  `SchoolShort` varchar(9) DEFAULT NULL,
  `SchoolName` varchar(100) DEFAULT NULL,
  `SchoolWebSite` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`SchoolsID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Schools`
--

LOCK TABLES `Schools` WRITE;
/*!40000 ALTER TABLE `Schools` DISABLE KEYS */;
/*!40000 ALTER TABLE `Schools` ENABLE KEYS */;
UNLOCK TABLES;

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
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (7,'Bruce',NULL,'Wayne',NULL,NULL,NULL,NULL,NULL,NULL,'2015-02-27 09:57:00'),(10,'Hung',NULL,'Tran',NULL,NULL,NULL,NULL,NULL,NULL,'2015-03-01 20:32:24');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-01 13:51:06
