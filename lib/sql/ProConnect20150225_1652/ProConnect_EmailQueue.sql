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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EmailQueue`
--

LOCK TABLES `EmailQueue` WRITE;
/*!40000 ALTER TABLE `EmailQueue` DISABLE KEYS */;
INSERT INTO `EmailQueue` VALUES (1,'hung.d.tran@sjsu.edu',NULL,NULL,NULL,NULL,'2015-02-25 20:08:53',NULL,'failed',NULL,NULL,NULL),(2,'hung.d.tran@sjsu.edu',NULL,NULL,NULL,NULL,'2015-02-25 20:09:31',NULL,'failed',NULL,NULL,NULL),(3,'hung.d.tran@sjsu.edu','TestSubject','TESTBody',NULL,NULL,'2015-02-25 20:11:56',NULL,'failed',NULL,NULL,NULL),(4,'hung.d.tran@sjsu.edu','TestSubject','TESTBody',NULL,NULL,'2015-02-25 20:14:06',NULL,'failed',NULL,NULL,'Message could not be sent.Mailer Error: SMTP connect() failed.'),(5,'hung.d.tran@sjsu.edu','TestSubject','TESTBody',NULL,NULL,'2015-02-25 20:17:38',NULL,'failed',NULL,NULL,'Message could not be sent.Mailer Error: SMTP connect() failed.'),(6,'hung.d.tran@sjsu.edu','TestSubject','TESTBody',NULL,NULL,'2015-02-25 20:19:32','2015-02-25 12:19:32','sent',NULL,NULL,NULL),(7,'hung.d.tran@sjsu.edu','Welcome To ProConnect - Email Verification','Dear {{FulllName}}, Thank you for joining the network for professionals. Before we can get you started, please click on the link below to activate your account. http://www.google.com',NULL,NULL,'2015-02-25 22:07:22','2015-02-25 14:07:22','sent',NULL,NULL,NULL),(8,'hung.d.tran@sjsu.edu','Welcome To ProConnect - Email Verification','Dear Hung Tran, Thank you for joining the network for professionals. Before we can get you started, please click on the link below to activate your account. http://www.google.com',NULL,NULL,'2015-02-25 22:08:51','2015-02-25 14:08:51','sent',NULL,NULL,NULL),(9,'hung.d.tran@sjsu.edu','Welcome To ProConnect - Email Verification','Dear BruceWayne, Thank you for joining the network for professionals. Before we can get you started, please click on the link below to activate your account. https://www.proconnect.com/ver1.0/signup/EmailVerification.php?VerificationKey=2e166c3fe8261dbbcd01e3b89ef63b01e6bc1d1e',NULL,NULL,'2015-02-26 00:06:32','2015-02-25 16:06:32','sent',NULL,NULL,NULL),(10,'hung.d.tran@sjsu.edu','Welcome To ProConnect - Email Verification','Dear BruceWayne, Thank you for joining the network for professionals. Before we can get you started, please click on the link below to activate your account. https://www.proconnect.com/ver1.0/signup/EmailVerification.php?VerificationKey=b62bf75dde57ad1f03d3a77f898e7a278419a877',NULL,NULL,'2015-02-26 00:07:07','2015-02-25 16:07:07','sent',NULL,NULL,NULL),(11,'hungtrand092@gmail.com','Welcome To ProConnect - Email Verification','Dear PeterParker, Thank you for joining the network for professionals. Before we can get you started, please click on the link below to activate your account. https://www.proconnect.com/ver1.0/signup/EmailVerification.php?VerificationKey=ecbf673c5e885a3c7d883eb0e7e61576c35a756f',NULL,NULL,'2015-02-26 00:30:45','2015-02-25 16:30:45','sent',NULL,NULL,NULL),(12,'hungtrand0929@gmail.com','Welcome To ProConnect - Email Verification','Dear IronMan, Thank you for joining the network for professionals. Before we can get you started, please click on the link below to activate your account. https://www.proconnect.com/ver1.0/signup/EmailVerification.php?VerificationKey=7524f96038be12c9f4facd6a72a7087f4508602c',NULL,NULL,'2015-02-26 00:32:14','2015-02-25 16:32:14','sent',NULL,NULL,NULL);
/*!40000 ALTER TABLE `EmailQueue` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-02-25 16:52:58
