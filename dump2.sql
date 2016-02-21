-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 21 Février 2016 à 00:39
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `zendproject`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
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
  `art_image_filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`art_id`),
  KEY `IDX_BFDD3168D7077436` (`lang_id`),
  KEY `IDX_BFDD3168C69D3FB` (`user_id`),
  KEY `IDX_BFDD316828D797FE` (`art_parent_id`),
  KEY `IDX_BFDD3168A5BA57E2` (`rs_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`art_id`, `lang_id`, `user_id`, `art_title`, `art_slug`, `art_introtext`, `art_fulltext`, `art_created`, `art_parent_id`, `rs_id`, `art_image_filename`) VALUES
(1, 1, 1, 'cretated-by-stoyan', 'created-by-stoyan-html', 'Test for Stoyan', 'Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Vestibulum id ligula porta felis euismod semper. Donec ullamcorper nulla non metus auctor fringilla.\r\rDuis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo.', '2013-05-24 23:00:00', 1, 1, ''),
(2, 1, 2, 'test2-by-stoyan', 'test2-by-stoyan2', 'Tralalal la la', 'Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Vestibulum id ligula porta felis euismod semper. Donec ullamcorper nulla non metus auctor fringilla.\r\rDuis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo.', '2013-05-01 23:00:56', 2, 2, ''),
(4, 2, 3, 'test-stoyan-test', 'test-stoyan-test', 'Tralalal', 'Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Vestibulum id ligula porta felis euismod semper. Donec ullamcorper nulla non metus auctor fringilla.\r\rDuis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo.', '2013-05-26 00:00:00', 2, 3, ''),
(6, 1, 4, 'test-test-for-stoyan', 'test-slug-stoyan', 'Test dhfsajh fhsdajhfsdjh!', 'Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Vestibulum id ligula porta felis euismod semper. Donec ullamcorper nulla non metus auctor fringilla.\r\rDuis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo.', '2013-05-24 23:55:36', NULL, 4, ''),
(7, 1, 2, 'test-for-parent', 'test-for-parent-html', 'Test intro', 'Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Vestibulum id ligula porta felis euismod semper. Donec ullamcorper nulla non metus auctor fringilla.\r\rDuis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo.', '2013-05-24 20:04:36', 1, 1, ''),
(8, 2, 2, 'this-is-translation', 'translation-html', '', 'Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Vestibulum id ligula porta felis euismod semper. Donec ullamcorper nulla non metus auctor fringilla.\r\rDuis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo.', '2013-05-27 23:45:56', 1, 2, ''),
(9, 3, 6, 'sdf-dsaf-fsd', 'fsdf-fsdf-fsd', '', '', '2013-05-27 09:05:37', 1, 3, ''),
(10, 2, 6, 'hsdfgjh-fsdhfksah', 'sdjhfkjsd-fds-html', 'akjfhsjk fjh jfh kj', 'fjsdhfkj fjk jfk jfkd', '2013-05-27 09:14:03', 2, 4, ''),
(11, 1, 3, 'sfjf-fdgfhj-gfdhjh', 'gfdhgjdf-gfdgfjkh-fdg', 'Inter fasjdfhj  hjh', 'dsn h h', '2013-05-27 12:38:21', 1, 2, ''),
(12, 5, 6, 'translation-for-bukgarian', 'translation-for-bukgarian', 'Translation sdfafa', 'fadsfasas das asf', '2013-05-27 12:42:25', 1, 2, ''),
(15, 4, 1, 'my-first-translation', 'my-first-translation', 'My first translation intro', 'Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Vestibulum id ligula porta felis euismod semper. Donec ullamcorper nulla non metus auctor fringilla.\r\rDuis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo.', '2013-05-27 16:01:36', 6, 3, ''),
(16, 1, 2, 'public-article', 'this-is-my-slug', 'Intro text', 'Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Vestibulum id ligula porta felis euismod semper. Donec ullamcorper nulla non metus auctor fringilla.\r\rDuis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo.', '2013-05-24 20:04:36', NULL, 1, ''),
(17, 1, 2, 'public-article', 'this-is-my-slug', 'Intro text', 'Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Vestibulum id ligula porta felis euismod semper. Donec ullamcorper nulla non metus auctor fringilla.\r\rDuis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo.', '2013-05-24 20:04:36', NULL, 2, ''),
(18, 1, 2, 'public-article', 'this-is-my-slug', 'Intro text', 'Fll text', '2013-05-24 20:04:36', NULL, 2, ''),
(20, 2, 2, 'wqewr-rweqrwqe', 'rwere-rwerew', 'Intro text', 'Full text', '2012-05-24 00:00:00', 2, 2, ''),
(21, 1, 3, 'date-time-separated', 'date-time-separated', '<p>Intro text</p>', 'Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Vestibulum id ligula porta felis euismod semper. Donec ullamcorper nulla non metus auctor fringilla.\r\rDuis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo.', '2013-05-24 23:00:00', NULL, 2, ''),
(22, 1, 3, 'date-time-separated', 'date-time-separated', '<p>Intro text</p>', '<p>Full text</p>', '2013-05-08 01:00:00', NULL, 2, ''),
(25, 2, 75, 'LoremIpsum', 'lorem-ipsum', '<p>ajflajdfadf</p>', '<p>afiajeflkajelfkjlaf</p>', '2016-02-20 23:44:37', NULL, 1, 'Capture.PNG');

-- --------------------------------------------------------

--
-- Structure de la table `articles_categories`
--

DROP TABLE IF EXISTS `articles_categories`;
CREATE TABLE IF NOT EXISTS `articles_categories` (
  `art_id` int(11) NOT NULL,
  `ctgr_id` int(11) NOT NULL,
  PRIMARY KEY (`art_id`,`ctgr_id`),
  KEY `IDX_DE004A0E4A863625` (`art_id`),
  KEY `IDX_DE004A0EC4A519B9` (`ctgr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `articles_categories`
--

INSERT INTO `articles_categories` (`art_id`, `ctgr_id`) VALUES
(1, 1),
(1, 2),
(2, 2),
(2, 3),
(4, 1),
(4, 3),
(6, 1),
(7, 1),
(7, 3),
(8, 1),
(8, 3),
(9, 1),
(9, 2),
(10, 2),
(10, 3),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(15, 2),
(15, 3),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(20, 1),
(20, 2),
(21, 1),
(22, 1),
(25, 1);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `ctgr_id` int(11) NOT NULL AUTO_INCREMENT,
  `ctgr_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ctgr_image_filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ctgr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`ctgr_id`, `ctgr_name`, `ctgr_image_filename`) VALUES
(1, 'Sport', ''),
(2, 'Science', ''),
(3, 'Education', ''),
(4, 'test', ''),
(8, 'Cat', ''),
(13, 'Tetsdt', ''),
(14, 'Bilandqsdqsd', ''),
(16, 'New One', ''),
(17, 'Catégorie 1', ''),
(18, 'TEst', '');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `art_id` int(11) DEFAULT NULL,
  `com_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `com_text` longtext COLLATE utf8_unicode_ci,
  `com_created` datetime DEFAULT NULL,
  `com_active` int(11) DEFAULT NULL,
  `com_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `com_username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`com_id`),
  KEY `IDX_5F9E962AD7077436` (`lang_id`),
  KEY `IDX_5F9E962AC69D3FB` (`user_id`),
  KEY `IDX_5F9E962A4A863625` (`art_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`com_id`, `lang_id`, `user_id`, `art_id`, `com_title`, `com_text`, `com_created`, `com_active`, `com_email`, `com_username`) VALUES
(1, 3, 3, 1, 'test-comment', 'This is my test comment', '2013-05-27 17:38:09', 0, 'plop@plop.pl', 'lorem'),
(2, 3, 1, 7, 'comment-my', 'This is my comment', '2013-05-27 17:41:30', 1, 'plop@plop.pl', 'ipsum'),
(3, 1, 1, 7, 'ahsdaf-fsdfhkh', 'test for Stoyan', '2013-05-27 18:16:58', 1, 'plop@plop.pl', 'titou'),
(6, 1, 2, 1, 'ANother-comment', 'This is another comment', '2013-05-28 10:07:57', 0, 'plop@plop.pl', 'patak'),
(7, NULL, 54, 6, 'sqQSs', 'sqs', '2016-02-15 03:12:50', 0, 'plop@plop.pl', 'bacon'),
(8, NULL, 54, 22, 'tesq', 'jfjhghgjhgjVivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Maecenas faucibus mollis interdum. Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper.\r\n\r\nInteger posuere erat a ante venenatis dapibus posuere velit aliquet. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula ut id elit.', '2016-02-15 13:54:26', NULL, 'plop@plop.pl', 'azerty'),
(11, NULL, 75, 22, 'azerty', 'Lorem Ipsum', '2016-02-20 20:49:53', NULL, 'plop@plop.pl', 'qwerty'),
(31, NULL, 75, 22, 'bacon', 'Ipsum', '2016-02-20 23:05:11', NULL, 'plop@plop.pl', 'plop'),
(32, NULL, 75, 25, 'plop', 'plpokpaokf', '2016-02-21 00:32:10', NULL, 'pataky@hotmail.fr', 'patak');

-- --------------------------------------------------------

--
-- Structure de la table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `lang_id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lang_abbreviation` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `languages`
--

INSERT INTO `languages` (`lang_id`, `lang_name`, `lang_abbreviation`) VALUES
(1, 'English', 'en'),
(2, 'French', 'fr'),
(3, 'Spanish', 'es'),
(4, 'German', 'de'),
(5, 'Bulgarian', 'bg');

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(45) DEFAULT NULL,
  `menu_active` varchar(45) DEFAULT NULL,
  `order` varchar(455) DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `idx_menus_menu_id` (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `menus`
--

INSERT INTO `menus` (`menu_id`, `menu_name`, `menu_active`, `order`) VALUES
(1, NULL, NULL, NULL),
(2, 'dsqdsqsd', NULL, NULL),
(3, 'Menu 1', NULL, NULL),
(4, 'menu 2', NULL, NULL),
(5, 'tetstt order', NULL, '[{"id":"8"},{"id":"3"},{"id":"4"},{"id":"2"}]'),
(6, 'test order 2', NULL, '[{"id":"3"},{"id":"2"},{"id":"1"}]'),
(7, 'wallou', NULL, '[{"id":"8"},{"id":"4"},{"id":"3"},{"id":"2"}]');

-- --------------------------------------------------------

--
-- Structure de la table `menus_categories`
--

DROP TABLE IF EXISTS `menus_categories`;
CREATE TABLE IF NOT EXISTS `menus_categories` (
  `menu_id` int(11) NOT NULL,
  `ctgr_id` int(11) NOT NULL,
  PRIMARY KEY (`menu_id`,`ctgr_id`),
  KEY `ctgr_id` (`ctgr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `ctgr_id` int(11) DEFAULT NULL,
  `structure` varchar(3000) COLLATE utf8_bin DEFAULT NULL,
  `block_element` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ctgr_id` (`ctgr_id`),
  KEY `idx_pages_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `pages`
--

INSERT INTO `pages` (`id`, `title`, `content`, `ctgr_id`, `structure`, `block_element`) VALUES
(32, 'dqsd', 'dsqdsq', 8, NULL, ''),
(33, 'test', 'pages folie', 1, NULL, ''),
(34, 'rer test', 'dsdsqdsq', 3, NULL, ''),
(35, '', '', 3, NULL, ''),
(36, 'Test page menu 1', 'Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.', 2, NULL, ''),
(37, 'dqdqs', 'dsqdsq', 2, '[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object],[object Object]', ''),
(38, 'dqsqs', 'dsqdq', 4, '', ''),
(39, 'dqsdsqd', 'dqsdqiojqsljjkswjclkjclkj', 3, '[{"col":1,"row":1,"size_x":1,"size_y":1},{"col":1,"row":2,"size_x":1,"size_y":1},{"col":1,"row":3,"size_x":1,"size_y":1},{"col":2,"row":1,"size_x":2,"size_y":1},{"col":2,"row":2,"size_x":2,"size_y":2},{"col":4,"row":1,"size_x":1,"size_y":1},{"col":4,"row":2,"size_x":2,"size_y":1},{"col":4,"row":3,"size_x":1,"size_y":1},{"col":5,"row":1,"size_x":1,"size_y":1},{"col":5,"row":3,"size_x":1,"size_y":1},{"col":6,"row":1,"size_x":1,"size_y":1},{"col":6,"row":2,"size_x":1,"size_y":2}]', ''),
(40, 'dqsdqs', 'dqsdqs', 3, '[{"col":1,"row":2,"size_x":1,"size_y":1},{"col":1,"row":3,"size_x":1,"size_y":1},{"col":1,"row":4,"size_x":1,"size_y":1},{"col":1,"row":1,"size_x":5,"size_y":1},{"col":2,"row":2,"size_x":2,"size_y":2},{"col":4,"row":2,"size_x":1,"size_y":1},{"col":4,"row":3,"size_x":2,"size_y":1},{"col":4,"row":4,"size_x":1,"size_y":1},{"col":5,"row":2,"size_x":1,"size_y":1},{"col":5,"row":4,"size_x":1,"size_y":1},{"col":6,"row":1,"size_x":1,"size_y":1},{"col":6,"row":2,"size_x":1,"size_y":2}]', ''),
(41, 'Grande page', 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit sit amet non magna. Donec id elit non mi porta gravida at eget metus. Cras mattis consectetur purus sit amet fermentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas faucibus mollis interdum.\r\n\r\nVivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Cras mattis consectetur purus sit amet fermentum. Nullam quis risus eget urna mollis ornare vel eu leo. Maecenas sed diam eget risus varius blandit sit amet non magna. Cras mattis consectetur purus sit amet fermentum.\r\n\r\nDonec id elit non mi porta gravida at eget metus. Curabitur blandit tempus porttitor. Cras mattis consectetur purus sit amet fermentum. Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper.\r\n\r\nVivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Nulla vitae elit libero, a pharetra augue.', 2, '[{"col":1,"row":1,"size_x":1,"size_y":1},{"col":1,"row":2,"size_x":1,"size_y":1},{"col":1,"row":3,"size_x":1,"size_y":1},{"col":2,"row":1,"size_x":4,"size_y":1},{"col":2,"row":2,"size_x":4,"size_y":3},{"col":1,"row":4,"size_x":1,"size_y":1},{"col":2,"row":5,"size_x":2,"size_y":1},{"col":4,"row":5,"size_x":1,"size_y":1},{"col":5,"row":5,"size_x":1,"size_y":1},{"col":1,"row":5,"size_x":1,"size_y":1},{"col":6,"row":1,"size_x":1,"size_y":1},{"col":6,"row":2,"size_x":1,"size_y":4}]', ''),
(42, 'dqsdsq', 'dsqdqdqsd', 3, '[{"col":1,"row":1,"size_x":1,"size_y":1},{"col":1,"row":2,"size_x":1,"size_y":1},{"col":1,"row":3,"size_x":1,"size_y":1},{"col":2,"row":1,"size_x":4,"size_y":1},{"col":2,"row":2,"size_x":2,"size_y":3},{"col":4,"row":2,"size_x":1,"size_y":1},{"col":4,"row":3,"size_x":2,"size_y":1},{"col":4,"row":4,"size_x":1,"size_y":1},{"col":5,"row":2,"size_x":1,"size_y":1},{"col":5,"row":4,"size_x":1,"size_y":1},{"col":6,"row":1,"size_x":1,"size_y":1},{"col":6,"row":2,"size_x":1,"size_y":2}]', ''),
(43, 'dqdq', 'fqLorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec id elit non mi porta gravida at eget metus. Aenean lacinia bibendum nulla sed consectetur. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Etiam porta sem malesuada magna mollis euismod.\r\n\r\nCras justo odio, dapibus ac facilisis in, egestas eget quam. Maecenas sed diam eget risus varius blandit sit amet non magna. Nullam quis risus eget urna mollis ornare vel eu leo. Aenean lacinia bibendum nulla sed consectetur. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec id elit non mi porta gravida at eget metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.\r\n\r\nNullam id dolor id nibh ultricies vehicula ut id elit. Cras mattis consectetur purus sit amet fermentum. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Nullam id dolor id nibh ultricies vehicula ut id elit.\r\n\r\nAenean lacinia bibendum nulla sed consectetur. Sed posuere consectetur est at lobortis. Sed posuere consectetur est at lobortis. Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.', 3, '[{"col":1,"row":1,"size_x":1,"size_y":1},{"col":1,"row":2,"size_x":1,"size_y":1},{"col":1,"row":3,"size_x":1,"size_y":1},{"col":2,"row":1,"size_x":5,"size_y":1},{"col":2,"row":2,"size_x":4,"size_y":2},{"col":1,"row":4,"size_x":4,"size_y":1},{"col":2,"row":5,"size_x":2,"size_y":1},{"col":4,"row":5,"size_x":1,"size_y":1},{"col":5,"row":4,"size_x":1,"size_y":1},{"col":5,"row":5,"size_x":1,"size_y":1},{"col":6,"row":2,"size_x":1,"size_y":1},{"col":6,"row":3,"size_x":1,"size_y":2}]', ''),
(44, 'dqdqsd', 'ddsVestibulum id ligula porta felis euismod semper. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Curabitur blandit tempus porttitor. Sed posuere consectetur est at lobortis.\r\n\r\nMaecenas sed diam eget risus varius blandit sit amet non magna. Maecenas faucibus mollis interdum. Sed posuere consectetur est at lobortis. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nMaecenas faucibus mollis interdum. Donec id elit non mi porta gravida at eget metus. Donec id elit non mi porta gravida at eget metus. Nullam quis risus eget urna mollis ornare vel eu leo. Maecenas sed diam eget risus varius blandit sit amet non magna. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Aenean lacinia bibendum nulla sed consectetur.\r\n\r\nCum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Sed posuere consectetur est at lobortis. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur.', 4, '[{"col":1,"row":3,"size_x":1,"size_y":1},{"col":1,"row":4,"size_x":1,"size_y":1},{"col":1,"row":5,"size_x":1,"size_y":1},{"col":2,"row":1,"size_x":2,"size_y":1},{"col":2,"row":2,"size_x":2,"size_y":2},{"col":4,"row":1,"size_x":1,"size_y":1},{"col":4,"row":2,"size_x":2,"size_y":1},{"col":4,"row":3,"size_x":1,"size_y":1},{"col":5,"row":1,"size_x":1,"size_y":1},{"col":5,"row":3,"size_x":1,"size_y":1},{"col":6,"row":1,"size_x":1,"size_y":1},{"col":6,"row":2,"size_x":1,"size_y":2},{"col":1,"row":1,"size_x":1,"size_y":2},{"col":2,"row":4,"size_x":1,"size_y":2},{"col":3,"row":4,"size_x":1,"size_y":2},{"col":4,"row":4,"size_x":1,"size_y":2},{"col":5,"row":4,"size_x":1,"size_y":2},{"col":6,"row":4,"size_x":1,"size_y":2},{"col":1,"row":6,"size_x":1,"size_y":2},{"col":2,"row":6,"size_x":1,"size_y":2},{"col":3,"row":6,"size_x":1,"size_y":2},{"col":4,"row":6,"size_x":1,"size_y":2}]', ''),
(45, 'test', 'dqsdq', 3, '[{"id":"1","col":1,"row":1,"size_x":1,"size_y":1},{"id":"2","col":1,"row":2,"size_x":1,"size_y":1},{"id":"3","col":1,"row":3,"size_x":1,"size_y":1},{"id":"4","col":2,"row":1,"size_x":4,"size_y":1},{"id":"5","col":2,"row":2,"size_x":4,"size_y":2},{"id":"6","col":6,"row":1,"size_x":1,"size_y":1},{"id":"7","col":6,"row":2,"size_x":1,"size_y":1},{"id":"8","col":6,"row":3,"size_x":1,"size_y":1},{"id":"9","col":1,"row":5,"size_x":6,"size_y":1},{"id":"10","col":1,"row":4,"size_x":1,"size_y":1},{"id":"11","col":2,"row":4,"size_x":4,"size_y":1},{"id":"12","col":6,"row":4,"size_x":1,"size_y":1}]', '[{"element_id":"6","element_type":"article","element_block_id":"5"}]'),
(46, 'TEst page education', 'Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Sed posuere consectetur est at lobortis. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec sed odio dui.\r\n\r\nNullam id dolor id nibh ultricies vehicula ut id elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Donec ullamcorper nulla non metus auctor fringilla.\r\n\r\nAenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Maecenas sed diam eget risus varius blandit sit amet non magna. Maecenas faucibus mollis interdum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.', 3, '[{"id":"1","col":1,"row":1,"size_x":1,"size_y":1},{"id":"2","col":1,"row":2,"size_x":1,"size_y":1},{"id":"4","col":2,"row":1,"size_x":4,"size_y":1},{"id":"5","col":5,"row":2,"size_x":2,"size_y":2},{"id":"6","col":6,"row":1,"size_x":1,"size_y":1},{"id":"10","col":1,"row":3,"size_x":1,"size_y":1},{"id":"11","col":2,"row":2,"size_x":3,"size_y":2}]', '[{"element_id":"11","element_type":"article","element_block_id":"5"},{"element_id":"7","element_type":"menu","element_block_id":"2"},{"element_id":"16","element_type":"article","element_block_id":"11"}]');

-- --------------------------------------------------------

--
-- Structure de la table `resources`
--

DROP TABLE IF EXISTS `resources`;
CREATE TABLE IF NOT EXISTS `resources` (
  `rs_id` int(11) NOT NULL AUTO_INCREMENT,
  `rs_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`rs_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `resources`
--

INSERT INTO `resources` (`rs_id`, `rs_name`) VALUES
(1, 'all'),
(2, 'Public Resource'),
(3, 'Private Resource'),
(4, 'Admin Resource');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'guest'),
(2, 'member'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `themes`
--

DROP TABLE IF EXISTS `themes`;
CREATE TABLE IF NOT EXISTS `themes` (
  `theme_id` int(11) NOT NULL AUTO_INCREMENT,
  `theme_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`theme_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `themes`
--

INSERT INTO `themes` (`theme_id`, `theme_name`) VALUES
(1, 'VertFolie'),
(2, 'OrgreRouge'),
(3, 'Origami');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `user_role_id` int(11) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `user_picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_registration_date` datetime DEFAULT NULL COMMENT 'Registration moment',
  `user_theme_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_active` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_email`, `user_role_id`, `lang_id`, `user_picture`, `user_registration_date`, `user_theme_id`, `user_active`) VALUES
(1, 'sadfasfsa', 'fsadfasfas', 'fsdafs@fsdfs.com', 2, 1, 'fsadfsa', '2013-07-19 12:00:00', '1', NULL),
(10, 'petkan', 'f05130dad0b4ac89e3127824346d0b9c', 'stoyancheresharov@gmail.com', 2, 1, NULL, '2013-07-17 12:11:25', '1', NULL),
(11, 'dragan', '123455', 'cheresharov@hotmail.com', 2, 1, '', '2013-07-17 12:35:43', '1', NULL),
(24, 'efas', 'fasdfefsa', 'fsda@fdsfs.com', 1, 1, 'gdsfg', '2013-07-19 12:00:00', '1', NULL),
(25, 'stoyan1', 'sfsfsfs', 'fdsfs@fdsfsd.com', 2, 1, 'fsadf', '2013-07-19 12:00:00', '1', NULL),
(26, 'fdfasf', 'fsdafas', 'fasdfas@fsdfs.com', 2, 2, 'fsdafas', '2013-07-19 12:00:00', '1', NULL),
(27, 'dasda', 'DSADASd', 'dsa@asdasdasd.com', 1, 1, 'fdsaf', '2013-07-19 12:00:00', '1', NULL),
(28, 'test21', 'dqdqadfs', 'dsda@dfsf.com', 1, 1, 'fsad', '2013-07-19 12:00:00', '1', NULL),
(29, 'dsfsdfs', 'fdsfsa', 'sdfsa@fsds.com', 2, 2, 'fsdf', '2013-07-19 12:00:00', '1', NULL),
(30, 'saasdfsaf', 'fdsafsadf', 'fdsf@fsdfds.com', 2, 2, 'rewqrwq', '2013-07-19 12:00:00', '1', NULL),
(31, 'ewqrqw', 'rweqrwq', 'rwerewq@fdsfsd.com', 2, 2, 'fdsafasd', '2013-07-19 12:00:00', '1', NULL),
(32, 'erwrewt21', 'retrwet', 'fgds@fsfds.com', 2, 2, 'gdsf', '2013-07-19 12:23:00', '1', NULL),
(54, 'titou', 'd1facad4e2976e00f28c27c039c3bfe2', 'cheresharov@ihahockey.com', 2, 1, NULL, '2013-08-15 07:32:17', '1', NULL),
(75, 'patak', '$2y$10$dbj9fVTSMi2.R9SCr9/W0eg9KQB8UMjOBdSiq/bxIRMaidfx68bJi', 'pataky@hotmail.fr', 3, 1, NULL, '2016-02-19 22:00:35', NULL, NULL),
(76, 'pataky', '$2y$10$FapuwaqtPU4TdKxc.zIus.wHJisQO0PNtvVs.S5pfDbCNQdxPa8rm', 'q.pataky@gmail.com', 3, 1, NULL, '2016-02-19 23:42:13', NULL, NULL),
(77, 'antoineH', 'antoine', 'antoine@neoxia.com', 3, 2, 'sqsd', '2013-07-19 12:00:00', NULL, NULL),
(78, 'test', 'antoine', 'an@c.com', 3, 3, 'dqsd', '2013-07-19 12:00:00', NULL, NULL),
(79, 'annnnnnn', '$2y$10$nDDRN8pBWzTa4d7Ub0aDTeY6.8Qrju55MObSctPdI/U/d9o8AabFm', 'antoine.humbert+test@neoxia.com', 2, 1, NULL, '2016-02-20 01:31:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE IF NOT EXISTS `user_roles` (
  `user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`user_role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='The System Roles. Who can see and do what';

--
-- Contenu de la table `user_roles`
--

INSERT INTO `user_roles` (`user_role_id`, `user_role_name`) VALUES
(1, 'Public'),
(2, 'Prospect'),
(3, 'Member'),
(4, 'Admin');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `FK_BFDD316828D797FE` FOREIGN KEY (`art_parent_id`) REFERENCES `articles` (`art_id`),
  ADD CONSTRAINT `FK_BFDD3168A5BA57E2` FOREIGN KEY (`rs_id`) REFERENCES `resources` (`rs_id`),
  ADD CONSTRAINT `FK_BFDD3168C69D3FB` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `FK_BFDD3168D7077436` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`lang_id`);

--
-- Contraintes pour la table `articles_categories`
--
ALTER TABLE `articles_categories`
  ADD CONSTRAINT `FK_DE004A0E4A863625` FOREIGN KEY (`art_id`) REFERENCES `articles` (`art_id`),
  ADD CONSTRAINT `FK_DE004A0EC4A519B9` FOREIGN KEY (`ctgr_id`) REFERENCES `categories` (`ctgr_id`);

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_5F9E962A4A863625` FOREIGN KEY (`art_id`) REFERENCES `articles` (`art_id`),
  ADD CONSTRAINT `FK_5F9E962AC69D3FB` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `FK_5F9E962AD7077436` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`lang_id`);

--
-- Contraintes pour la table `menus_categories`
--
ALTER TABLE `menus_categories`
  ADD CONSTRAINT `menus_categories_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`menu_id`),
  ADD CONSTRAINT `menus_categories_ibfk_2` FOREIGN KEY (`ctgr_id`) REFERENCES `categories` (`ctgr_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
