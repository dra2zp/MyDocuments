-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: project
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

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
-- Current Database: `project`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `project` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `project`;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classes` (
  `username` varchar(40) NOT NULL,
  `title` varchar(40) NOT NULL,
  `credits` tinyint(4) NOT NULL,
  `a_plus` decimal(4,4) NOT NULL,
  `a` decimal(4,4) NOT NULL,
  `a_minus` decimal(4,4) NOT NULL,
  `b_plus` decimal(4,4) NOT NULL,
  `b` decimal(4,4) NOT NULL,
  `b_minus` decimal(4,4) NOT NULL,
  `c_plus` decimal(4,4) NOT NULL,
  `c` decimal(4,4) NOT NULL,
  `c_minus` decimal(4,4) NOT NULL,
  `d_plus` decimal(4,4) NOT NULL,
  `d` decimal(4,4) NOT NULL,
  `d_minus` decimal(4,4) NOT NULL,
  `f` decimal(4,4) NOT NULL,
  `system` char(1) NOT NULL,
  `category1` varchar(40) DEFAULT NULL,
  `weight1` decimal(4,4) DEFAULT NULL,
  `category2` varchar(40) DEFAULT NULL,
  `weight2` decimal(4,4) DEFAULT NULL,
  `category3` varchar(40) DEFAULT NULL,
  `weight3` decimal(4,4) DEFAULT NULL,
  `category4` varchar(40) DEFAULT NULL,
  `weight4` decimal(4,4) DEFAULT NULL,
  `category5` varchar(40) DEFAULT NULL,
  `weight5` decimal(4,4) DEFAULT NULL,
  `category6` varchar(40) DEFAULT NULL,
  `weight6` decimal(4,4) DEFAULT NULL,
  `category7` varchar(40) DEFAULT NULL,
  `weight7` decimal(4,4) DEFAULT NULL,
  `category8` varchar(40) DEFAULT NULL,
  `weight8` decimal(4,4) DEFAULT NULL,
  `category9` varchar(40) DEFAULT NULL,
  `weight9` decimal(4,4) DEFAULT NULL,
  `category10` varchar(40) DEFAULT NULL,
  `weight10` decimal(4,4) DEFAULT NULL,
  `removed` char(1) NOT NULL,
  `final_grade` char(2) DEFAULT NULL,
  PRIMARY KEY (`username`,`title`,`removed`),
  CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
INSERT INTO `classes` VALUES ('dra2zp','CS 4640',3,0.9750,0.9250,0.8950,0.8650,0.8250,0.7950,0.7650,0.7250,0.6950,0.6650,0.6250,0.6000,0.0000,'P',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'N','A-'),('dra2zp','MATH 1140',3,0.9700,0.9300,0.9000,0.8700,0.8300,0.8000,0.7700,0.7300,0.7000,0.6700,0.6300,0.6000,0.0000,'W','Homework tests',0.6000,'Attendance/participation',0.0500,'Final Exam',0.3000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'N','A+');
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grades`
--

DROP TABLE IF EXISTS `grades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grades` (
  `username` varchar(40) NOT NULL,
  `title` varchar(40) NOT NULL,
  `category` varchar(40) DEFAULT NULL,
  `weight` decimal(4,4) DEFAULT NULL,
  `assignment` varchar(40) NOT NULL,
  `points_earned` decimal(10,4) NOT NULL,
  `points_possible` decimal(10,4) NOT NULL,
  `removed` char(1) NOT NULL,
  PRIMARY KEY (`username`,`title`,`assignment`,`removed`),
  CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`username`, `title`) REFERENCES `classes` (`username`, `title`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grades`
--

LOCK TABLES `grades` WRITE;
/*!40000 ALTER TABLE `grades` DISABLE KEYS */;
INSERT INTO `grades` VALUES ('dra2zp','CS 4640',NULL,NULL,'Exam 1',90.0000,100.0000,'N'),('dra2zp','CS 4640',NULL,NULL,'Homework 1',26.0000,30.0000,'N'),('dra2zp','CS 4640',NULL,NULL,'Project Proposal',50.0000,50.0000,'N'),('dra2zp','CS 4640',NULL,NULL,'Quiz 1',2.0000,2.0000,'N'),('dra2zp','CS 4640',NULL,NULL,'Quiz 2',2.0000,2.0000,'N'),('dra2zp','CS 4640',NULL,NULL,'Quiz 3',2.0000,2.0000,'N'),('dra2zp','CS 4640',NULL,NULL,'Quiz 4',2.0000,2.0000,'N'),('dra2zp','CS 4640',NULL,NULL,'Quiz 5',2.0000,2.0000,'N'),('dra2zp','CS 4640',NULL,NULL,'Quiz 6',2.0000,2.0000,'N'),('dra2zp','CS 4640',NULL,NULL,'Quiz 7',2.0000,2.0000,'N'),('dra2zp','CS 4640',NULL,NULL,'Quiz 8',2.0000,2.0000,'N'),('dra2zp','CS 4640',NULL,NULL,'Quiz 9',0.0000,2.0000,'N'),('dra2zp','MATH 1140','Homework tests',0.6000,'Hw 1',5.0000,5.0000,'N'),('dra2zp','MATH 1140','Homework tests',0.6000,'Hw 10',4.0000,4.0000,'N'),('dra2zp','MATH 1140','Homework tests',0.6000,'Hw 11',4.0000,4.0000,'N'),('dra2zp','MATH 1140','Homework tests',0.6000,'Hw 12',5.0000,5.0000,'N'),('dra2zp','MATH 1140','Homework tests',0.6000,'Hw 2',4.0000,4.0000,'N'),('dra2zp','MATH 1140','Homework tests',0.6000,'Hw 3',5.0000,5.0000,'N'),('dra2zp','MATH 1140','Homework tests',0.6000,'Hw 4',5.0000,5.0000,'N'),('dra2zp','MATH 1140','Homework tests',0.6000,'Hw 5',5.0000,5.0000,'N'),('dra2zp','MATH 1140','Homework tests',0.6000,'Hw 6',3.5000,4.0000,'N'),('dra2zp','MATH 1140','Homework tests',0.6000,'Hw 7',6.0000,6.0000,'N'),('dra2zp','MATH 1140','Homework tests',0.6000,'Hw 8',3.0000,3.0000,'N'),('dra2zp','MATH 1140','Homework tests',0.6000,'Hw 9',4.0000,4.0000,'N');
/*!40000 ALTER TABLE `grades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `first` varchar(20) NOT NULL,
  `last` varchar(20) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` char(40) NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('D.J.','Anderson','dra2zp','7fa0a73e0366afe831cb4277ef0b21f426ee5069','2017-06-09 02:30:14');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-09  3:35:58
