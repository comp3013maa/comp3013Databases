-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: eu-cdbr-azure-west-b.cloudapp.net    Database: comp3013
-- ------------------------------------------------------
-- Server version	5.5.42-log

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `cat_id` int(8) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `cat_description` varchar(255) NOT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name_unique` (`cat_name`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Computing','AI'),(11,'Georgraphy','Arts Degree'),(21,' Help ',' For help ');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grade`
--

DROP TABLE IF EXISTS `grade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grade` (
  `gradeID` int(11) NOT NULL AUTO_INCREMENT,
  `submissionID` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `comments` varchar(300) NOT NULL,
  `byGroup` int(11) NOT NULL,
  PRIMARY KEY (`gradeID`)
) ENGINE=InnoDB AUTO_INCREMENT=961 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grade`
--

LOCK TABLES `grade` WRITE;
/*!40000 ALTER TABLE `grade` DISABLE KEYS */;
INSERT INTO `grade` VALUES (791,221,6,' good work!',2),(801,241,8,' nice one group 4!',2),(811,271,8,' not bad group 1!!',2),(821,241,4,' not baad group 4!!',3),(831,211,2,' not good at all group 5!',3),(841,251,9,' original group 2!',3),(851,271,7,' makes sense group 1!!',5),(852,251,1,' poor group 2',5),(871,251,6,' not bad group 2!!',1),(881,221,1,' cant read group 3',1),(891,241,10,' good effort group 4',1),(901,211,3,' wow nice group 5!!',4),(911,281,8,' very good work james!',4),(921,221,5,' good work group 3',6),(941,301,9,' good work group 6!',4),(951,221,1,' good work',5);
/*!40000 ALTER TABLE `grade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groupassignments`
--

DROP TABLE IF EXISTS `groupassignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groupassignments` (
  `groupID` int(11) NOT NULL,
  `assignedTo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groupassignments`
--

LOCK TABLES `groupassignments` WRITE;
/*!40000 ALTER TABLE `groupassignments` DISABLE KEYS */;
INSERT INTO `groupassignments` VALUES (1,2),(2,3),(3,4),(4,5),(5,1),(5,2),(5,3),(1,3),(1,4),(2,4),(2,1),(3,5),(3,2),(4,6),(6,3),(6,1);
/*!40000 ALTER TABLE `groupassignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `groupID` int(11) NOT NULL,
  `aggregateGrade` int(11) DEFAULT NULL,
  PRIMARY KEY (`groupID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (0,NULL),(1,NULL),(2,NULL),(3,NULL),(4,NULL),(5,NULL),(6,NULL);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `post_id` int(8) NOT NULL AUTO_INCREMENT,
  `post_content` text NOT NULL,
  `post_date` datetime NOT NULL,
  `post_topic` int(8) NOT NULL,
  `post_by` int(8) NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `post_topic` (`post_topic`),
  KEY `post_by` (`post_by`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_topic`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`post_by`) REFERENCES `users` (`userID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Hello','2012-02-26 09:34:00',1,1),(11,'Hi','2015-03-25 11:29:53',1,21),(21,'Juan','2015-03-25 13:50:47',41,21),(31,'Hi, could anyone give me a hand?\r\n\r\nKind regards, \r\nMahi','2015-03-25 22:11:06',51,2),(41,'Hi, could I get some help? ','2015-03-25 22:15:57',61,2),(51,'\r\nfheiofje','2015-03-25 22:29:26',51,5),(61,'If I could get a reply by the end of the week thatd be great','2015-03-25 22:30:02',51,2),(71,'Oh Hi Graham','2015-03-25 22:30:31',51,2),(81,'With my coursework? ','2015-03-26 00:29:49',71,31),(82,'Thank you for the help','2015-03-26 00:32:53',51,31),(91,'Comment','2015-03-26 01:04:39',51,2);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submissions`
--

DROP TABLE IF EXISTS `submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `submissions` (
  `submissionID` int(11) NOT NULL AUTO_INCREMENT,
  `submissionName` varchar(5000) DEFAULT NULL,
  `groupID` int(11) NOT NULL,
  PRIMARY KEY (`submissionID`)
) ENGINE=InnoDB AUTO_INCREMENT=302 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submissions`
--

LOCK TABLES `submissions` WRITE;
/*!40000 ALTER TABLE `submissions` DISABLE KEYS */;
INSERT INTO `submissions` VALUES (211,'uploads/up18.txt',5),(221,'a:1:{s:4:\"book\";a:3:{s:11:\"@attributes\";a:1:{s:2:\"id\";s:5:\"bk101\";}s:6:\"author\";s:11:\"Gambardella\";s:11:\"description\";s:41:\"Some very long report bla bla bla ahf iao\";}}',3),(241,'uploads/up20.txt',4),(251,'uploads/up21.txt',2),(271,'a:1:{s:4:\"book\";a:3:{s:11:\"@attributes\";a:1:{s:2:\"id\";s:5:\"bk101\";}s:6:\"author\";s:11:\"Gambardella\";s:11:\"description\";s:41:\"Some very long report bla bla bla ahf iao\";}}',1),(301,'a:1:{i:0;s:73:\"A very long report! please grade my work and give me comments to improve \";}',6);
/*!40000 ALTER TABLE `submissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topics` (
  `topic_id` int(8) NOT NULL AUTO_INCREMENT,
  `topic_subject` varchar(255) NOT NULL,
  `topic_date` datetime NOT NULL,
  `topic_cat` int(8) NOT NULL,
  `topic_by` int(8) NOT NULL,
  PRIMARY KEY (`topic_id`),
  KEY `topic_by` (`topic_by`),
  KEY `topic_cat` (`topic_cat`),
  CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`topic_by`) REFERENCES `users` (`userID`) ON UPDATE CASCADE,
  CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`topic_cat`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topics`
--

LOCK TABLES `topics` WRITE;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
INSERT INTO `topics` VALUES (1,'Computing','0000-00-00 00:00:00',1,1),(41,'Theory','2015-03-25 13:50:47',1,21),(51,'How do I upload my report?','2015-03-25 22:11:06',21,2),(61,'Assistance please','2015-03-25 22:15:57',1,2),(71,'Could I get a hand?','2015-03-26 00:29:49',21,31);
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `userName` varchar(40) NOT NULL,
  `password` char(128) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `groupID` int(11) NOT NULL,
  `joinedOn` datetime NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Anuz','Harry','Anuz','b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86','anuz@gmail.com',4,'2015-02-06 20:28:31',NULL),(2,'Mahi','Khan','Mahi','b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86','mahi@gmai.com',5,'2015-03-04 21:20:41',1),(3,'Abbas','Mirza','Abbas','b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86','abbas@gmail.com',1,'2015-03-04 22:20:41',NULL),(4,'Kei','Anblu','Kei','b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86','kei@gmail.com',2,'2015-04-04 22:20:41',NULL),(5,'Graham','Roberts','Graham','b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86','Graham@gmail.com',3,'2015-04-04 22:21:12',1),(21,'Abbas','Mirza','abbas','8ac73cb2664c8c435e7938a41c0de952ea321fd42fbbdc103b40014f20e066b774328b94612bead4aff91f5c69422f96a6c08013a40186b33f9badf1ab62603b','abb@gmail.com',1,'2015-03-18 11:47:13',NULL),(22,'Boss','Man','Admin1','b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86','admi@g.com',0,'2015-03-19 10:12:45',1),(31,'James','Paul','James','b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86','James@gmail.com',6,'2015-03-25 23:27:38',0),(41,'Harry','Styles','Harry','b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86','harry@gmail.com',6,'2015-03-26 01:15:35',0);
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

-- Dump completed on 2015-04-03 22:53:15
