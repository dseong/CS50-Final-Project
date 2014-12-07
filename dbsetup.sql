-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: musicmates
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.14.04.1-log

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
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL,
  `groupid` int(10) unsigned NOT NULL,
  `instrument` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_application` (`userid`,`groupid`),
  KEY `userid` (`userid`),
  KEY `instrument` (`instrument`),
  KEY `groupid` (`groupid`),
  CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`groupid`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `applications_ibfk_3` FOREIGN KEY (`instrument`) REFERENCES `insttypes` (`instrument`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genres`
--

DROP TABLE IF EXISTS `genres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genres` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique genre id',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Genre name',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genres`
--

LOCK TABLES `genres` WRITE;
/*!40000 ALTER TABLE `genres` DISABLE KEYS */;
INSERT INTO `genres` VALUES (8,'Acapella'),(1,'Classical'),(6,'Contemporary'),(4,'Country'),(5,'Hip Hop'),(3,'Jazz'),(2,'Modern'),(10,'Pop'),(9,'Rock'),(7,'Soul');
/*!40000 ALTER TABLE `genres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groupinsts`
--

DROP TABLE IF EXISTS `groupinsts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groupinsts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique id of record',
  `groupid` int(10) unsigned NOT NULL,
  `instrument` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Instrument type',
  `userid` int(10) unsigned DEFAULT NULL COMMENT 'User id playing it',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user_group` (`groupid`,`userid`),
  KEY `userid` (`userid`),
  KEY `groupid` (`groupid`),
  KEY `instrument` (`instrument`),
  CONSTRAINT `groupinsts_ibfk_1` FOREIGN KEY (`groupid`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `groupinsts_insttype` FOREIGN KEY (`instrument`) REFERENCES `insttypes` (`instrument`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `groupinsts_userid` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groupinsts`
--

LOCK TABLES `groupinsts` WRITE;
/*!40000 ALTER TABLE `groupinsts` DISABLE KEYS */;
INSERT INTO `groupinsts` VALUES (35,11,'Violin',7),(36,11,'Violin',NULL),(37,11,'Viola',NULL),(38,11,'Cello',6),(39,12,'Electric Guitar',8),(40,12,'Euphonium',NULL),(41,12,'Piccolo',NULL),(42,12,'Percussion',NULL),(43,12,'Electric Bass',NULL);
/*!40000 ALTER TABLE `groupinsts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Group unique id',
  `ownerid` int(10) unsigned NOT NULL COMMENT 'Group owner id',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Group name',
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Group description',
  `genre` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Group music genre',
  `skill` tinyint(3) unsigned NOT NULL COMMENT 'Group skill level',
  PRIMARY KEY (`id`),
  KEY `ownerid` (`ownerid`),
  KEY `genre` (`genre`),
  KEY `skill` (`skill`),
  CONSTRAINT `groups_genre` FOREIGN KEY (`genre`) REFERENCES `genres` (`name`) ON UPDATE CASCADE,
  CONSTRAINT `groups_ownerid` FOREIGN KEY (`ownerid`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `groups_skill` FOREIGN KEY (`skill`) REFERENCES `skills` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (11,7,'Nick\'s Quartet','We are a quartet that plays general classical music.','Classical',4),(12,8,'David\'s Euphonium Rock Group','We rock out with euphoniums and piccolos and stuff.','Rock',5);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instruments`
--

DROP TABLE IF EXISTS `instruments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instruments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id of this record',
  `userid` int(10) unsigned NOT NULL COMMENT 'User Foreign Key',
  `instrument` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Instrument name',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `instrumentperuser` (`userid`,`instrument`),
  KEY `userid` (`userid`),
  KEY `instrument` (`instrument`),
  CONSTRAINT `instrument_type` FOREIGN KEY (`instrument`) REFERENCES `insttypes` (`instrument`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `instrument_userid` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instruments`
--

LOCK TABLES `instruments` WRITE;
/*!40000 ALTER TABLE `instruments` DISABLE KEYS */;
INSERT INTO `instruments` VALUES (7,5,'Euphonium'),(6,5,'Piccolo'),(8,6,'Cello'),(9,6,'Piano'),(10,7,'Violin'),(12,8,'Cello'),(11,8,'Electric Guitar');
/*!40000 ALTER TABLE `instruments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insttypes`
--

DROP TABLE IF EXISTS `insttypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `insttypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Instrument ID',
  `instrument` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Instrument name',
  PRIMARY KEY (`id`),
  UNIQUE KEY `instrument` (`instrument`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insttypes`
--

LOCK TABLES `insttypes` WRITE;
/*!40000 ALTER TABLE `insttypes` DISABLE KEYS */;
INSERT INTO `insttypes` VALUES (11,'Bassoon'),(1,'Cello'),(7,'Clarinet'),(22,'Electric Bass'),(16,'Electric Guitar'),(27,'Euphonium'),(5,'Flute'),(12,'French Horn'),(13,'Guitar'),(19,'Harp'),(8,'Oboe'),(15,'Percussion'),(6,'Piano'),(18,'Piccolo'),(20,'Saxophone'),(2,'String Bass'),(10,'Trombone'),(9,'Trumpet'),(14,'Tuba'),(4,'Viola'),(3,'Violin'),(17,'Vocalist'),(24,'Voice - Alto'),(26,'Voice - Bass'),(23,'Voice - Soprano'),(25,'Voice - Tenor'),(21,'Xylophone');
/*!40000 ALTER TABLE `insttypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skills` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skills`
--

LOCK TABLES `skills` WRITE;
/*!40000 ALTER TABLE `skills` DISABLE KEYS */;
INSERT INTO `skills` VALUES (1,'Beginner'),(2,'Casual'),(3,'Average'),(4,'Advanced'),(5,'Expert');
/*!40000 ALTER TABLE `skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'User ID',
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Username',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'User''s real name',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'User Email',
  `hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'User Hashed Password',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (5,'skroob','President Skroob','skroob@example.com','$1$xEc87Nwz$98WxDdvaQw6GiyYgTvend1'),(6,'karl','Karl','karl@example.com','$1$zt.aSwec$hjWY/vQZxNhbjAFdPdsXI/'),(7,'nick','Nick','nick@example.com','$1$eRld3aNR$0alncjYDUbVqXZNWio0kj0'),(8,'david','David','david@example.com','$1$6ddYxg..$RA824CEEl04cFqV9G6BJG.');
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

-- Dump completed on 2014-12-07  3:57:17
