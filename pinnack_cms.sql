-- MySQL dump 10.13  Distrib 5.6.24, for osx10.8 (x86_64)
--
-- Host: 127.0.0.1    Database: pinnackl_cms_db
-- ------------------------------------------------------
-- Server version	5.6.26

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
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `art_id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `art_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `art_slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `art_introtext` longtext COLLATE utf8_unicode_ci,
  `art_fulltext` longtext COLLATE utf8_unicode_ci,
  `art_created` datetime DEFAULT NULL,
  `art_parent_id` int(11) DEFAULT NULL,
  `rs_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`art_id`),
  KEY `IDX_BFDD3168D7077436` (`lang_id`),
  KEY `IDX_BFDD3168C69D3FB` (`user_id`),
  KEY `IDX_BFDD316828D797FE` (`art_parent_id`),
  KEY `IDX_BFDD3168A5BA57E2` (`rs_id`),
  CONSTRAINT `FK_BFDD316828D797FE` FOREIGN KEY (`art_parent_id`) REFERENCES `articles` (`art_id`),
  CONSTRAINT `FK_BFDD3168A5BA57E2` FOREIGN KEY (`rs_id`) REFERENCES `resources` (`rs_id`),
  CONSTRAINT `FK_BFDD3168C69D3FB` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `FK_BFDD3168D7077436` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`lang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,1,1,'cretated-by-stoyan','created-by-stoyan-html','Test for Stoyan','Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Vestibulum id ligula porta felis euismod semper. Donec ullamcorper nulla non metus auctor fringilla.\r\rDuis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo.','2013-05-24 23:00:00',1,1),(2,1,2,'test2-by-stoyan','test2-by-stoyan2','Tralalal la la','Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Vestibulum id ligula porta felis euismod semper. Donec ullamcorper nulla non metus auctor fringilla.\r\rDuis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo.','2013-05-01 23:00:56',2,2),(4,2,3,'test-stoyan-test','test-stoyan-test','Tralalal','Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Vestibulum id ligula porta felis euismod semper. Donec ullamcorper nulla non metus auctor fringilla.\r\rDuis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo.','2013-05-26 00:00:00',2,3),(6,1,4,'test-test-for-stoyan','test-slug-stoyan','Test dhfsajh fhsdajhfsdjh!','Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Vestibulum id ligula porta felis euismod semper. Donec ullamcorper nulla non metus auctor fringilla.\r\rDuis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo.','2013-05-24 23:55:36',NULL,4),(7,1,2,'test-for-parent','test-for-parent-html','Test intro','Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Vestibulum id ligula porta felis euismod semper. Donec ullamcorper nulla non metus auctor fringilla.\r\rDuis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo.','2013-05-24 20:04:36',1,1),(8,2,2,'this-is-translation','translation-html','','Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Vestibulum id ligula porta felis euismod semper. Donec ullamcorper nulla non metus auctor fringilla.\r\rDuis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo.','2013-05-27 23:45:56',1,2),(9,3,6,'sdf-dsaf-fsd','fsdf-fsdf-fsd','','','2013-05-27 09:05:37',1,3),(10,2,6,'hsdfgjh-fsdhfksah','sdjhfkjsd-fds-html','akjfhsjk fjh jfh kj','fjsdhfkj fjk jfk jfkd','2013-05-27 09:14:03',2,4),(11,1,3,'sfjf-fdgfhj-gfdhjh','gfdhgjdf-gfdgfjkh-fdg','Inter fasjdfhj  hjh','dsn h h','2013-05-27 12:38:21',1,2),(12,5,6,'translation-for-bukgarian','translation-for-bukgarian','Translation sdfafa','fadsfasas das asf','2013-05-27 12:42:25',1,2),(15,4,1,'my-first-translation','my-first-translation','My first translation intro','Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Vestibulum id ligula porta felis euismod semper. Donec ullamcorper nulla non metus auctor fringilla.\r\rDuis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo.','2013-05-27 16:01:36',6,3),(16,1,2,'public-article','this-is-my-slug','Intro text','Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Vestibulum id ligula porta felis euismod semper. Donec ullamcorper nulla non metus auctor fringilla.\r\rDuis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo.','2013-05-24 20:04:36',NULL,1),(17,1,2,'public-article','this-is-my-slug','Intro text','Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Vestibulum id ligula porta felis euismod semper. Donec ullamcorper nulla non metus auctor fringilla.\r\rDuis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo.','2013-05-24 20:04:36',NULL,2),(18,1,2,'public-article','this-is-my-slug','Intro text','Fll text','2013-05-24 20:04:36',NULL,2),(20,2,2,'wqewr-rweqrwqe','rwere-rwerew','Intro text','Full text','2012-05-24 00:00:00',2,2),(21,1,3,'date-time-separated','date-time-separated','<p>Intro text</p>','Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Vestibulum id ligula porta felis euismod semper. Donec ullamcorper nulla non metus auctor fringilla.\r\rDuis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo.','2013-05-24 23:00:00',NULL,2),(22,1,3,'date-time-separated','date-time-separated','<p>Intro text</p>','<p>Full text</p>','2013-05-08 01:00:00',NULL,2);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles_categories`
--

DROP TABLE IF EXISTS `articles_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles_categories` (
  `art_id` int(11) NOT NULL,
  `ctgr_id` int(11) NOT NULL,
  PRIMARY KEY (`art_id`,`ctgr_id`),
  KEY `IDX_DE004A0E4A863625` (`art_id`),
  KEY `IDX_DE004A0EC4A519B9` (`ctgr_id`),
  CONSTRAINT `FK_DE004A0E4A863625` FOREIGN KEY (`art_id`) REFERENCES `articles` (`art_id`),
  CONSTRAINT `FK_DE004A0EC4A519B9` FOREIGN KEY (`ctgr_id`) REFERENCES `categories` (`ctgr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles_categories`
--

LOCK TABLES `articles_categories` WRITE;
/*!40000 ALTER TABLE `articles_categories` DISABLE KEYS */;
INSERT INTO `articles_categories` VALUES (1,1),(1,2),(2,2),(2,3),(4,1),(4,3),(6,1),(7,1),(7,3),(8,1),(8,3),(9,1),(9,2),(10,2),(10,3),(11,1),(11,2),(12,1),(12,2),(15,2),(15,3),(16,1),(16,2),(17,1),(17,2),(18,1),(18,2),(20,1),(20,2),(21,1),(22,1);
/*!40000 ALTER TABLE `articles_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `ctgr_id` int(11) NOT NULL AUTO_INCREMENT,
  `ctgr_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ctgr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Sport'),(2,'Science'),(3,'Education'),(4,'test'),(8,'Cat'),(13,'Tetsdt'),(14,'Bilandqsdqsd'),(16,'New One'),(17,'Catégorie 1'),(18,'TEst');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `art_id` int(11) DEFAULT NULL,
  `com_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `com_text` longtext COLLATE utf8_unicode_ci,
  `com_created` datetime DEFAULT NULL,
  `com_active` int(11) DEFAULT NULL,
  PRIMARY KEY (`com_id`),
  KEY `IDX_5F9E962AD7077436` (`lang_id`),
  KEY `IDX_5F9E962AC69D3FB` (`user_id`),
  KEY `IDX_5F9E962A4A863625` (`art_id`),
  CONSTRAINT `FK_5F9E962A4A863625` FOREIGN KEY (`art_id`) REFERENCES `articles` (`art_id`),
  CONSTRAINT `FK_5F9E962AC69D3FB` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `FK_5F9E962AD7077436` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`lang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,3,3,1,'test-comment','This is my test comment','2013-05-27 17:38:09',0),(2,3,1,7,'comment-my','This is my comment','2013-05-27 17:41:30',1),(3,1,1,7,'ahsdaf-fsdfhkh','test for Stoyan','2013-05-27 18:16:58',1),(6,1,2,1,'ANother-comment','This is another comment','2013-05-28 10:07:57',0),(7,NULL,54,6,'sqQSs','sqs','2016-02-15 03:12:50',0),(8,NULL,54,22,'tesq','jfjhghgjhgjVivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Maecenas faucibus mollis interdum. Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper.\r\n\r\nInteger posuere erat a ante venenatis dapibus posuere velit aliquet. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula ut id elit.','2016-02-15 13:54:26',NULL);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `lang_id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lang_abbreviation` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'English','en'),(2,'French','fr'),(3,'Spanish','es'),(4,'German','de'),(5,'Bulgarian','bg');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(45) DEFAULT NULL,
  `menu_active` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `idx_menus_menu_id` (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,NULL,NULL),(2,'dsqdsqsd',NULL),(3,'Menu 1',NULL),(4,'menu 2',NULL);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `ctgr_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `structure` varchar(3000) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ctgr_id` (`ctgr_id`),
  KEY `idx_pages_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (32,'dqsd','dsqdsq',8,NULL,NULL),(33,'test','pages folie',1,NULL,NULL),(34,'rer test','dsdsqdsq',3,NULL,NULL),(35,'','',3,2,NULL),(36,'Test page menu 1','Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.',2,3,NULL),(37,'dqdqs','dsqdsq',2,3,'[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object]'),(38,'dqsqs','dsqdq',4,3,''),(39,'dqsdsqd','dqsdqiojqsljjkswjclkjclkj',3,4,'[{\"col\":1,\"row\":1,\"size_x\":1,\"size_y\":1},{\"col\":1,\"row\":2,\"size_x\":1,\"size_y\":1},{\"col\":1,\"row\":3,\"size_x\":1,\"size_y\":1},{\"col\":2,\"row\":1,\"size_x\":2,\"size_y\":1},{\"col\":2,\"row\":2,\"size_x\":2,\"size_y\":2},{\"col\":4,\"row\":1,\"size_x\":1,\"size_y\":1},{\"col\":4,\"row\":2,\"size_x\":2,\"size_y\":1},{\"col\":4,\"row\":3,\"size_x\":1,\"size_y\":1},{\"col\":5,\"row\":1,\"size_x\":1,\"size_y\":1},{\"col\":5,\"row\":3,\"size_x\":1,\"size_y\":1},{\"col\":6,\"row\":1,\"size_x\":1,\"size_y\":1},{\"col\":6,\"row\":2,\"size_x\":1,\"size_y\":2}]'),(40,'dqsdqs','dqsdqs',3,4,'[{\"col\":1,\"row\":2,\"size_x\":1,\"size_y\":1},{\"col\":1,\"row\":3,\"size_x\":1,\"size_y\":1},{\"col\":1,\"row\":4,\"size_x\":1,\"size_y\":1},{\"col\":1,\"row\":1,\"size_x\":5,\"size_y\":1},{\"col\":2,\"row\":2,\"size_x\":2,\"size_y\":2},{\"col\":4,\"row\":2,\"size_x\":1,\"size_y\":1},{\"col\":4,\"row\":3,\"size_x\":2,\"size_y\":1},{\"col\":4,\"row\":4,\"size_x\":1,\"size_y\":1},{\"col\":5,\"row\":2,\"size_x\":1,\"size_y\":1},{\"col\":5,\"row\":4,\"size_x\":1,\"size_y\":1},{\"col\":6,\"row\":1,\"size_x\":1,\"size_y\":1},{\"col\":6,\"row\":2,\"size_x\":1,\"size_y\":2}]'),(41,'Grande page','Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit sit amet non magna. Donec id elit non mi porta gravida at eget metus. Cras mattis consectetur purus sit amet fermentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas faucibus mollis interdum.\r\n\r\nVivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Cras mattis consectetur purus sit amet fermentum. Nullam quis risus eget urna mollis ornare vel eu leo. Maecenas sed diam eget risus varius blandit sit amet non magna. Cras mattis consectetur purus sit amet fermentum.\r\n\r\nDonec id elit non mi porta gravida at eget metus. Curabitur blandit tempus porttitor. Cras mattis consectetur purus sit amet fermentum. Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper.\r\n\r\nVivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Nulla vitae elit libero, a pharetra augue.',2,4,'[{\"col\":1,\"row\":1,\"size_x\":1,\"size_y\":1},{\"col\":1,\"row\":2,\"size_x\":1,\"size_y\":1},{\"col\":1,\"row\":3,\"size_x\":1,\"size_y\":1},{\"col\":2,\"row\":1,\"size_x\":4,\"size_y\":1},{\"col\":2,\"row\":2,\"size_x\":4,\"size_y\":3},{\"col\":1,\"row\":4,\"size_x\":1,\"size_y\":1},{\"col\":2,\"row\":5,\"size_x\":2,\"size_y\":1},{\"col\":4,\"row\":5,\"size_x\":1,\"size_y\":1},{\"col\":5,\"row\":5,\"size_x\":1,\"size_y\":1},{\"col\":1,\"row\":5,\"size_x\":1,\"size_y\":1},{\"col\":6,\"row\":1,\"size_x\":1,\"size_y\":1},{\"col\":6,\"row\":2,\"size_x\":1,\"size_y\":4}]'),(42,'dqsdsq','dsqdqdqsd',3,3,'[{\"col\":1,\"row\":1,\"size_x\":1,\"size_y\":1},{\"col\":1,\"row\":2,\"size_x\":1,\"size_y\":1},{\"col\":1,\"row\":3,\"size_x\":1,\"size_y\":1},{\"col\":2,\"row\":1,\"size_x\":4,\"size_y\":1},{\"col\":2,\"row\":2,\"size_x\":2,\"size_y\":3},{\"col\":4,\"row\":2,\"size_x\":1,\"size_y\":1},{\"col\":4,\"row\":3,\"size_x\":2,\"size_y\":1},{\"col\":4,\"row\":4,\"size_x\":1,\"size_y\":1},{\"col\":5,\"row\":2,\"size_x\":1,\"size_y\":1},{\"col\":5,\"row\":4,\"size_x\":1,\"size_y\":1},{\"col\":6,\"row\":1,\"size_x\":1,\"size_y\":1},{\"col\":6,\"row\":2,\"size_x\":1,\"size_y\":2}]'),(43,'dqdq','fqLorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec id elit non mi porta gravida at eget metus. Aenean lacinia bibendum nulla sed consectetur. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Etiam porta sem malesuada magna mollis euismod.\r\n\r\nCras justo odio, dapibus ac facilisis in, egestas eget quam. Maecenas sed diam eget risus varius blandit sit amet non magna. Nullam quis risus eget urna mollis ornare vel eu leo. Aenean lacinia bibendum nulla sed consectetur. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec id elit non mi porta gravida at eget metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.\r\n\r\nNullam id dolor id nibh ultricies vehicula ut id elit. Cras mattis consectetur purus sit amet fermentum. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Nullam id dolor id nibh ultricies vehicula ut id elit.\r\n\r\nAenean lacinia bibendum nulla sed consectetur. Sed posuere consectetur est at lobortis. Sed posuere consectetur est at lobortis. Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.',3,4,'[{\"col\":1,\"row\":1,\"size_x\":1,\"size_y\":1},{\"col\":1,\"row\":2,\"size_x\":1,\"size_y\":1},{\"col\":1,\"row\":3,\"size_x\":1,\"size_y\":1},{\"col\":2,\"row\":1,\"size_x\":5,\"size_y\":1},{\"col\":2,\"row\":2,\"size_x\":4,\"size_y\":2},{\"col\":1,\"row\":4,\"size_x\":4,\"size_y\":1},{\"col\":2,\"row\":5,\"size_x\":2,\"size_y\":1},{\"col\":4,\"row\":5,\"size_x\":1,\"size_y\":1},{\"col\":5,\"row\":4,\"size_x\":1,\"size_y\":1},{\"col\":5,\"row\":5,\"size_x\":1,\"size_y\":1},{\"col\":6,\"row\":2,\"size_x\":1,\"size_y\":1},{\"col\":6,\"row\":3,\"size_x\":1,\"size_y\":2}]'),(44,'dqdqsd','ddsVestibulum id ligula porta felis euismod semper. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Curabitur blandit tempus porttitor. Sed posuere consectetur est at lobortis.\r\n\r\nMaecenas sed diam eget risus varius blandit sit amet non magna. Maecenas faucibus mollis interdum. Sed posuere consectetur est at lobortis. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nMaecenas faucibus mollis interdum. Donec id elit non mi porta gravida at eget metus. Donec id elit non mi porta gravida at eget metus. Nullam quis risus eget urna mollis ornare vel eu leo. Maecenas sed diam eget risus varius blandit sit amet non magna. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Aenean lacinia bibendum nulla sed consectetur.\r\n\r\nCum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Sed posuere consectetur est at lobortis. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur.',4,4,'[{\"col\":1,\"row\":3,\"size_x\":1,\"size_y\":1},{\"col\":1,\"row\":4,\"size_x\":1,\"size_y\":1},{\"col\":1,\"row\":5,\"size_x\":1,\"size_y\":1},{\"col\":2,\"row\":1,\"size_x\":2,\"size_y\":1},{\"col\":2,\"row\":2,\"size_x\":2,\"size_y\":2},{\"col\":4,\"row\":1,\"size_x\":1,\"size_y\":1},{\"col\":4,\"row\":2,\"size_x\":2,\"size_y\":1},{\"col\":4,\"row\":3,\"size_x\":1,\"size_y\":1},{\"col\":5,\"row\":1,\"size_x\":1,\"size_y\":1},{\"col\":5,\"row\":3,\"size_x\":1,\"size_y\":1},{\"col\":6,\"row\":1,\"size_x\":1,\"size_y\":1},{\"col\":6,\"row\":2,\"size_x\":1,\"size_y\":2},{\"col\":1,\"row\":1,\"size_x\":1,\"size_y\":2},{\"col\":2,\"row\":4,\"size_x\":1,\"size_y\":2},{\"col\":3,\"row\":4,\"size_x\":1,\"size_y\":2},{\"col\":4,\"row\":4,\"size_x\":1,\"size_y\":2},{\"col\":5,\"row\":4,\"size_x\":1,\"size_y\":2},{\"col\":6,\"row\":4,\"size_x\":1,\"size_y\":2},{\"col\":1,\"row\":6,\"size_x\":1,\"size_y\":2},{\"col\":2,\"row\":6,\"size_x\":1,\"size_y\":2},{\"col\":3,\"row\":6,\"size_x\":1,\"size_y\":2},{\"col\":4,\"row\":6,\"size_x\":1,\"size_y\":2}]');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resources`
--

DROP TABLE IF EXISTS `resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resources` (
  `rs_id` int(11) NOT NULL AUTO_INCREMENT,
  `rs_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`rs_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resources`
--

LOCK TABLES `resources` WRITE;
/*!40000 ALTER TABLE `resources` DISABLE KEYS */;
INSERT INTO `resources` VALUES (1,'all'),(2,'Public Resource'),(3,'Private Resource'),(4,'Admin Resource');
/*!40000 ALTER TABLE `resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'guest'),(2,'member'),(3,'admin');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `themes`
--

DROP TABLE IF EXISTS `themes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `themes` (
  `theme_id` int(11) NOT NULL AUTO_INCREMENT,
  `theme_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`theme_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `themes`
--

LOCK TABLES `themes` WRITE;
/*!40000 ALTER TABLE `themes` DISABLE KEYS */;
INSERT INTO `themes` VALUES (1,'VertFolie'),(2,'OrgreRouge'),(3,'Origami');
/*!40000 ALTER TABLE `themes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_roles` (
  `user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`user_role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='The System Roles. Who can see and do what';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (1,'Public'),(2,'Prospect'),(3,'Member'),(4,'Admin');
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `user_role_id` int(11) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `user_active` tinyint(1) NOT NULL,
  `user_question` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_answer` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_password_salt` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'dynamicSalt',
  `user_registration_date` datetime DEFAULT NULL COMMENT 'Registration moment',
  `user_registration_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'unique id sent by e-mail',
  `user_email_confirmed` tinyint(1) NOT NULL COMMENT 'e-mail confirmed by user',
  `user_theme_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'sadfasfsa','fsadfasfas','fsdafs@fsdfs.com',2,1,1,'safasdf','fasdf','fsadfsa','','2013-07-19 12:00:00','',0,'1'),(10,'petkan','f05130dad0b4ac89e3127824346d0b9c','stoyancheresharov@gmail.com',2,1,1,NULL,NULL,NULL,'})Zkeir*azuwZ^F?<#|$Wn]EaE:iz^OP<`7oIKZu&(7@0FgNT#','2013-07-17 12:11:25','87a3eac1b666a250e9084925419f0020',1,'1'),(11,'dragan','123455','cheresharov@hotmail.com',2,1,1,'','','','SfuxI(5LPD;wZ>ehod@>Q*M7|+xTZk3DZ<QOaxaS@Du%!Z`EI[','2013-07-17 12:35:43','6b3b8769cfc0acdaafdfb49a34d02b43',1,'1'),(24,'efas','fasdfefsa','fsda@fdsfs.com',1,1,0,'sfd','dfsg','gdsfg','gsdfg','2013-07-19 12:00:00','gsdf',0,'1'),(25,'stoyan1','sfsfsfs','fdsfs@fdsfsd.com',2,1,1,'dsfsa','fsdaf','fsadf','fsad','2013-07-19 12:00:00','fadsfas',1,'1'),(26,'fdfasf','fsdafas','fasdfas@fsdfs.com',2,2,1,'fdsafasdf','fsdaf','fsdafas','','2013-07-19 12:00:00','fsdfads',1,'1'),(27,'dasda','DSADASd','dsa@asdasdasd.com',1,1,0,'fdsafas','fsdaf','fdsaf','fsdaf','2013-07-19 12:00:00','6b3b8769cfc0acdaafdfb49a34d02b43',0,'1'),(28,'test21','dqdqadfs','dsda@dfsf.com',1,1,1,'fsd','fsda','fsad','fsdaf','2013-07-19 12:00:00','fdasf',1,'1'),(29,'dsfsdfs','fdsfsa','sdfsa@fsds.com',3,2,1,'dfsfas','fsdfs','fsdf','fsdfasf','2013-07-19 12:00:00','weewqrqw',1,'1'),(30,'saasdfsaf','fdsafsadf','fdsf@fsdfds.com',2,2,1,'ewqrwq','rewqrq','rewqrwq','rewqrw','2013-07-19 12:00:00','eqwrqw',1,'1'),(31,'ewqrqw','rweqrwq','rwerewq@fdsfsd.com',2,2,1,'dfsaf','fsdafa','fdsafasd','fdsafas','2013-07-19 12:00:00','fsfgds',1,'1'),(32,'erwrewt21','retrwet','fgds@fsfds.com',2,2,1,'gdsfg','gdfsg','gdsf','gsfd','2013-07-19 12:23:00','fsfs',1,'1'),(54,'titou','d1facad4e2976e00f28c27c039c3bfe2','cheresharov@ihahockey.com',3,1,1,NULL,NULL,NULL,'8YCRWPenTv%u3P6fwN/^AoR{l>^br]@%W6?2j\'F%6n\\llvhf[_','2013-08-15 07:32:17','911fa1b089e7f0915a6e2198f15b0ab9',1,'1');
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

-- Dump completed on 2016-02-16 12:15:28
