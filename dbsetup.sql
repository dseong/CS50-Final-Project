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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genres`
--

LOCK TABLES `genres` WRITE;
/*!40000 ALTER TABLE `genres` DISABLE KEYS */;
INSERT INTO `genres` VALUES (1,'Classical'),(2,'Modern');
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
  KEY `userid` (`userid`),
  KEY `groupid` (`groupid`),
  KEY `instrument` (`instrument`),
  CONSTRAINT `groupinsts_ibfk_1` FOREIGN KEY (`groupid`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `groupinsts_insttype` FOREIGN KEY (`instrument`) REFERENCES `insttypes` (`instrument`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `groupinsts_userid` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groupinsts`
--

LOCK TABLES `groupinsts` WRITE;
/*!40000 ALTER TABLE `groupinsts` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instruments`
--

LOCK TABLES `instruments` WRITE;
/*!40000 ALTER TABLE `instruments` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insttypes`
--

LOCK TABLES `insttypes` WRITE;
/*!40000 ALTER TABLE `insttypes` DISABLE KEYS */;
INSERT INTO `insttypes` VALUES (2,'Bass'),(1,'Cello'),(5,'Flute'),(6,'Piano'),(4,'Viola'),(3,'Violin');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2014-12-05 19:29:18
