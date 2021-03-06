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
  PRIMARY KEY (`AccountID`),
  UNIQUE KEY `VerificationKey_UNIQUE` (`VerificationKey`),
  KEY `Account_ibfk_1` (`UserID`),
  CONSTRAINT `Account_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Account`
--

LOCK TABLES `Account` WRITE;
/*!40000 ALTER TABLE `Account` DISABLE KEYS */;
INSERT INTO `Account` VALUES (1,'Feb2015','12345','0000-00-00 00:00:00','0000-00-00 00:00:00','',1,'','','','','\0',NULL),(2,'bwayne','bats','2015-02-26 00:06:29',NULL,'',3,'hung.d.tran@sjsu.edu','','','','\0','2e166c3fe8261dbbcd01e3b89ef63b01e6bc1d1e'),(4,'pparker','spiders','2015-02-26 00:30:44',NULL,'',5,'hungtrand092@gmail.com','','','','\0','ecbf673c5e885a3c7d883eb0e7e61576c35a756f'),(5,'iman','robots','2015-02-26 00:32:12',NULL,'',6,'hungtrand0929@gmail.com','','','','\0','7524f96038be12c9f4facd6a72a7087f4508602c');
/*!40000 ALTER TABLE `Account` ENABLE KEYS */;
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
