-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 29. Dez 2012 um 13:17
-- Server Version: 5.5.25
-- PHP-Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `contao3`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tl_member`
--

DROP TABLE IF EXISTS `tl_member`;
CREATE TABLE `tl_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tstamp` int(10) unsigned NOT NULL DEFAULT '0',
  `firstname` varchar(255) NOT NULL DEFAULT '',
  `lastname` varchar(255) NOT NULL DEFAULT '',
  `dateOfBirth` varchar(11) NOT NULL DEFAULT '',
  `gender` varchar(32) NOT NULL DEFAULT '',
  `company` varchar(255) NOT NULL DEFAULT '',
  `street` varchar(255) NOT NULL DEFAULT '',
  `postal` varchar(32) NOT NULL DEFAULT '',
  `city` varchar(255) NOT NULL DEFAULT '',
  `state` varchar(64) NOT NULL DEFAULT '',
  `country` varchar(2) NOT NULL DEFAULT '',
  `phone` varchar(64) NOT NULL DEFAULT '',
  `mobile` varchar(64) NOT NULL DEFAULT '',
  `fax` varchar(64) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `website` varchar(255) NOT NULL DEFAULT '',
  `language` varchar(2) NOT NULL DEFAULT '',
  `groups` blob,
  `login` char(1) NOT NULL DEFAULT '',
  `username` varchar(64) NOT NULL DEFAULT '',
  `password` varchar(128) NOT NULL DEFAULT '',
  `assignDir` char(1) NOT NULL DEFAULT '',
  `homeDir` varchar(255) NOT NULL DEFAULT '',
  `disable` char(1) NOT NULL DEFAULT '',
  `start` varchar(10) NOT NULL DEFAULT '',
  `stop` varchar(10) NOT NULL DEFAULT '',
  `dateAdded` int(10) unsigned NOT NULL DEFAULT '0',
  `lastLogin` int(10) unsigned NOT NULL DEFAULT '0',
  `currentLogin` int(10) unsigned NOT NULL DEFAULT '0',
  `loginCount` smallint(5) unsigned NOT NULL DEFAULT '3',
  `locked` int(10) unsigned NOT NULL DEFAULT '0',
  `session` blob,
  `autologin` varchar(32) DEFAULT NULL,
  `createdOn` int(10) unsigned NOT NULL DEFAULT '0',
  `activation` varchar(32) NOT NULL DEFAULT '',
  `newsletter` blob,
  `apikey` varchar(255) NOT NULL DEFAULT '',
  `encryptionkey` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `autologin` (`autologin`),
  KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `activation` (`activation`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `tl_member`
--

INSERT INTO `tl_member` (`id`, `tstamp`, `firstname`, `lastname`, `dateOfBirth`, `gender`, `company`, `street`, `postal`, `city`, `state`, `country`, `phone`, `mobile`, `fax`, `email`, `website`, `language`, `groups`, `login`, `username`, `password`, `assignDir`, `homeDir`, `disable`, `start`, `stop`, `dateAdded`, `lastLogin`, `currentLogin`, `loginCount`, `locked`, `session`, `autologin`, `createdOn`, `activation`, `newsletter`, `apikey`, `encryptionkey`) VALUES
(1, 1356777591, 'John', 'Smith', '238118400', 'male', '', '', '', '', '', '', '', '', '', 'j.smith@example.com', '', 'en', 0x613a313a7b693a303b733a313a2232223b7d, '1', 'j.smith', '3b842bcd6faab4047ab49f9a99fa0704b9c9d2d7', '', '', '', '', '', 1259754224, 0, 0, 3, 0, '', NULL, 0, '', '', '098f6bcd4621d373cade4e832627b4f6', 'testtesttesttest'),
(2, 1259754224, 'Donna', 'Evans', '191635200', 'female', '', '', '', '', '', '', '', '', '', 'd.evans@example.com', '', 'en', 0x613a313a7b693a303b733a313a2231223b7d, '1', 'd.evans', 'cea7a6c1b33fe43fe3db9131f58504574854fc95:46ca32f618fef57e45e90ce', '', '', '', '', '', 1259754224, 1337957447, 1340274105, 3, 0, '', NULL, 0, '', '', '', ''),
(3, 1259754224, 'John', 'Doe', '0', '', '', '', '', '', '', '', '', '', '', 'j.doe@example.com', '', 'en', 0x613a323a7b693a303b733a313a2232223b693a313b733a313a2231223b7d, '1', 'j.doe', '7a86a8cf9d7510cc4661b217133f2eed37981b75', '', '', '', '', '', 1259754224, 0, 0, 3, 0, '', NULL, 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tl_member_group`
--

DROP TABLE IF EXISTS `tl_member_group`;
CREATE TABLE `tl_member_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tstamp` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `redirect` char(1) NOT NULL DEFAULT '',
  `jumpTo` int(10) unsigned NOT NULL DEFAULT '0',
  `disable` char(1) NOT NULL DEFAULT '',
  `start` varchar(10) NOT NULL DEFAULT '',
  `stop` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `tl_member_group`
--

INSERT INTO `tl_member_group` (`id`, `tstamp`, `name`, `redirect`, `jumpTo`, `disable`, `start`, `stop`) VALUES
(1, 1172600419, 'Violin Students', '1', 6, '', '', ''),
(2, 1172600394, 'Piano Students', '1', 7, '', '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tl_rpc`
--

DROP TABLE IF EXISTS `tl_rpc`;
CREATE TABLE `tl_rpc` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tstamp` int(10) unsigned NOT NULL DEFAULT '0',
  `method` varchar(255) NOT NULL DEFAULT '',
  `active` char(1) NOT NULL DEFAULT '',
  `configuration` blob,
  PRIMARY KEY (`id`),
  UNIQUE KEY `method` (`method`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `tl_rpc`
--

INSERT INTO `tl_rpc` (`id`, `tstamp`, `method`, `active`, `configuration`) VALUES
(2, 1356776118, 'pong', '1', 0x613a313a7b693a303b733a313a2234223b7d),
(3, 1356776108, 'notActivePong', '', 0x613a313a7b693a303b733a313a2234223b7d),
(4, 1356776102, 'feGroupPong', '1', 0x613a313a7b693a303b733a313a2235223b7d),
(5, 1356776084, 'beGroupPong', '1', 0x613a313a7b693a303b733a313a2236223b7d),
(6, 1356776089, 'adminPong', '1', 0x613a313a7b693a303b733a313a2231223b7d),
(7, 1356776058, 'generateHash', '1', 0x613a313a7b693a303b733a313a2234223b7d),
(8, 1356782702, 'noConfigPong', '1', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tl_rpc_configuration`
--

DROP TABLE IF EXISTS `tl_rpc_configuration`;
CREATE TABLE `tl_rpc_configuration` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tstamp` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(32) NOT NULL DEFAULT '',
  `provider` varchar(32) NOT NULL DEFAULT '',
  `secure` char(1) NOT NULL DEFAULT '',
  `fe_groups` blob,
  `be_groups` blob,
  `admins` char(1) NOT NULL DEFAULT '',
  `ipList` varchar(5) NOT NULL DEFAULT '',
  `ipListWhite` blob,
  `ipListBlack` blob,
  `notPublic` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `tl_rpc_configuration`
--

INSERT INTO `tl_rpc_configuration` (`id`, `tstamp`, `name`, `provider`, `secure`, `fe_groups`, `be_groups`, `admins`, `ipList`, `ipListWhite`, `ipListBlack`, `notPublic`) VALUES
(1, 1356775922, 'Admin Test', 'json', '', NULL, NULL, '1', '', NULL, NULL, '1'),
(4, 1356775974, 'Public Test', 'json', '', NULL, NULL, '', '', NULL, NULL, ''),
(5, 1356777790, 'FE Group Test', 'json', '', 0x613a313a7b693a303b733a313a2232223b7d, NULL, '', '', NULL, NULL, '1'),
(6, 1356776031, 'BE Group Test', 'json', '', NULL, 0x613a313a7b693a303b733a313a2231223b7d, '', '', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tl_user`
--

DROP TABLE IF EXISTS `tl_user`;
CREATE TABLE `tl_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tstamp` int(10) unsigned NOT NULL DEFAULT '0',
  `username` varchar(64) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `language` varchar(2) NOT NULL DEFAULT '',
  `backendTheme` varchar(32) NOT NULL DEFAULT '',
  `uploader` varchar(32) NOT NULL DEFAULT '',
  `showHelp` char(1) NOT NULL DEFAULT '',
  `thumbnails` char(1) NOT NULL DEFAULT '',
  `useRTE` char(1) NOT NULL DEFAULT '',
  `useCE` char(1) NOT NULL DEFAULT '',
  `password` varchar(128) NOT NULL DEFAULT '',
  `pwChange` char(1) NOT NULL DEFAULT '',
  `admin` char(1) NOT NULL DEFAULT '',
  `groups` blob,
  `inherit` varchar(12) NOT NULL DEFAULT '',
  `modules` blob,
  `themes` blob,
  `pagemounts` blob,
  `alpty` blob,
  `filemounts` blob,
  `fop` blob,
  `forms` blob,
  `formp` blob,
  `disable` char(1) NOT NULL DEFAULT '',
  `start` varchar(10) NOT NULL DEFAULT '',
  `stop` varchar(10) NOT NULL DEFAULT '',
  `session` blob,
  `dateAdded` int(10) unsigned NOT NULL DEFAULT '0',
  `lastLogin` int(10) unsigned NOT NULL DEFAULT '0',
  `currentLogin` int(10) unsigned NOT NULL DEFAULT '0',
  `loginCount` smallint(5) unsigned NOT NULL DEFAULT '3',
  `locked` int(10) unsigned NOT NULL DEFAULT '0',
  `calendars` blob,
  `calendarp` blob,
  `calendarfeeds` blob,
  `calendarfeedp` blob,
  `faqs` blob,
  `faqp` blob,
  `news` blob,
  `newp` blob,
  `newsfeeds` blob,
  `newsfeedp` blob,
  `newsletters` blob,
  `newsletterp` blob,
  `apikey` varchar(255) NOT NULL DEFAULT '',
  `encryptionkey` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `tl_user`
--

INSERT INTO `tl_user` (`id`, `tstamp`, `username`, `name`, `email`, `language`, `backendTheme`, `uploader`, `showHelp`, `thumbnails`, `useRTE`, `useCE`, `password`, `pwChange`, `admin`, `groups`, `inherit`, `modules`, `themes`, `pagemounts`, `alpty`, `filemounts`, `fop`, `forms`, `formp`, `disable`, `start`, `stop`, `session`, `dateAdded`, `lastLogin`, `currentLogin`, `loginCount`, `locked`, `calendars`, `calendarp`, `calendarfeeds`, `calendarfeedp`, `faqs`, `faqp`, `news`, `newp`, `newsfeeds`, `newsfeedp`, `newsletters`, `newsletterp`, `apikey`, `encryptionkey`) VALUES
(1, 1356777604, 'k.jones', 'Kevin Jones', 'k.jones@example.com', 'de', 'default', 'FileUpload', '1', '1', '1', '1', '$6$f6a9581ccc9240f4$1uSh0e9WdLfaZXm0NSfHWmdo35IpSkZ4DLvoIal4bbb.y0FMwHc.XPPn7biS7O3QthIIsWhjfi0Y8SEzebNiU0', '', '1', '', '', '', NULL, 0x613a303a7b7d, NULL, 0x613a303a7b7d, '', NULL, NULL, '', '', '', 0x613a393a7b733a373a2272656665726572223b613a353a7b733a343a226c617374223b733a33333a222f636f6e74616f2f6d61696e2e7068703f646f3d636f6e66696775726174696f6e223b733a373a2263757272656e74223b733a32363a222f636f6e74616f2f6d61696e2e7068703f646f3d6d6574686f64223b733a31303a22746c5f61727469636c65223b733a32373a222f636f6e74616f2f6d61696e2e7068703f646f3d61727469636c65223b733a373a22746c5f70616765223b733a32343a222f636f6e74616f2f6d61696e2e7068703f646f3d70616765223b733a31333a22746c5f7270635f69706c697374223b733a32363a222f636f6e74616f2f6d61696e2e7068703f646f3d69706c697374223b7d733a373a2243555252454e54223b613a313a7b733a333a22494453223b613a373a7b693a303b733a313a2236223b693a313b733a313a2235223b693a323b733a313a2234223b693a333b733a313a2237223b693a343b733a313a2238223b693a353b733a313a2233223b693a363b733a313a2232223b7d7d733a393a22434c4950424f415244223b613a333a7b733a32303a22746c5f7270635f636f6e66696775726174696f6e223b613a303a7b7d733a31333a22746c5f7270635f69706c697374223b613a303a7b7d733a31383a22746c5f7270635f69706c6973745f6974656d223b613a303a7b7d7d733a31313a226e65775f7265636f726473223b613a333a7b733a32303a22746c5f7270635f636f6e66696775726174696f6e223b613a363a7b693a303b693a313b693a313b693a323b693a323b693a333b693a333b693a343b693a343b693a353b693a353b693a363b7d733a31333a22746c5f7270635f69706c697374223b613a313a7b693a303b693a313b7d733a31383a22746c5f7270635f69706c6973745f6974656d223b613a313a7b693a303b693a313b7d7d733a31353a226669656c647365745f737461746573223b613a353a7b733a31313a22746c5f73657474696e6773223b613a31313a7b733a31343a2274696d656f75745f6c6567656e64223b693a313b733a31333a22676c6f62616c5f6c6567656e64223b693a313b733a31343a22707269766163795f6c6567656e64223b693a313b733a31353a2273656375726974795f6c6567656e64223b693a313b733a31323a2266696c65735f6c6567656e64223b693a313b733a31343a2275706c6f6164735f6c6567656e64223b693a313b733a31333a227365617263685f6c6567656e64223b693a313b733a31313a22736d74705f6c6567656e64223b693a313b733a31323a2263686d6f645f6c6567656e64223b693a313b733a31333a227570646174655f6c6567656e64223b693a313b733a31373a227265706f7369746f72795f6c6567656e64223b693a313b7d733a393a22746c5f6d656d626572223b613a313a7b733a31303a227270635f6c6567656e64223b693a313b7d733a373a22746c5f75736572223b613a343a7b733a31343a226261636b656e645f6c6567656e64223b693a313b733a31323a227468656d655f6c6567656e64223b693a313b733a31353a2270617373776f72645f6c6567656e64223b693a313b733a31303a227270635f6c6567656e64223b693a313b7d733a31303a22746c5f61727469636c65223b613a323a7b733a31333a227465617365725f6c6567656e64223b693a303b733a31333a226578706572745f6c6567656e64223b693a313b7d733a373a22746c5f70616765223b613a353a7b733a31363a2270726f7465637465645f6c6567656e64223b693a313b733a31333a226c61796f75745f6c6567656e64223b693a313b733a31323a2263686d6f645f6c6567656e64223b693a313b733a31333a226578706572745f6c6567656e64223b693a313b733a31333a227461626e61765f6c6567656e64223b693a313b7d7d733a32333a22746c5f61727469636c655f746c5f706167655f74726565223b613a323a7b693a313b693a313b693a31393b693a303b7d733a32363a22746c5f61727469636c655f746c5f61727469636c655f74726565223b613a353a7b693a31333b693a303b693a313b693a303b693a31373b693a303b693a31303b693a303b693a363b693a303b7d733a31303a2243555252454e545f4944223b733a313a2231223b733a31323a22746c5f706167655f74726565223b613a373a7b693a313b693a313b693a31393b693a303b693a31363b693a303b693a323b693a303b693a333b693a303b693a343b693a303b693a353b693a303b7d7d, 1257428510, 1356777762, 1356782630, 3, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '098f6bcd4621d373cade4e832627b4f6', 'testtesttesttest'),
(2, 1302529708, 'j.wilson', 'James Wilson', 'j.wilson@example.com', 'en', 'default', '', '1', '1', '1', '1', 'babe801666efc8a28081c9b6a0d5fc50eac7de87', '', '', 0x613a313a7b693a303b733a313a2231223b7d, 'extend', 0x613a353a7b693a303b733a373a2261727469636c65223b693a313b733a343a226e657773223b693a323b733a383a2263616c656e646172223b693a333b733a343a2270616765223b693a343b733a353a2266696c6573223b7d, NULL, NULL, 0x613a333a7b693a303b733a373a22726567756c6172223b693a313b733a383a227265646972656374223b693a323b733a373a22666f7277617264223b7d, 0x613a313a7b693a303b4e3b7d, 0x613a333a7b693a303b733a323a226631223b693a313b733a323a226632223b693a323b733a323a226633223b7d, NULL, NULL, '', '', '', '', 1259754527, 0, 0, 3, 0, 0x613a323a7b693a303b733a313a2233223b693a313b733a313a2231223b7d, NULL, NULL, NULL, NULL, NULL, 0x613a323a7b693a303b733a313a2233223b693a313b733a313a2231223b7d, NULL, NULL, NULL, NULL, NULL, '', ''),
(3, 1302529708, 'h.lewis', 'Helen Lewis', 'h.lewis@example.com', 'en', 'default', '', '1', '1', '1', '1', '22cce67837ea3e18b1ce6b323d1e281e434e1a71', '', '', 0x613a313a7b693a303b733a313a2231223b7d, 'extend', 0x613a353a7b693a303b733a373a2261727469636c65223b693a313b733a343a226e657773223b693a323b733a383a2263616c656e646172223b693a333b733a343a2270616765223b693a343b733a353a2266696c6573223b7d, NULL, NULL, 0x613a333a7b693a303b733a373a22726567756c6172223b693a313b733a383a227265646972656374223b693a323b733a373a22666f7277617264223b7d, 0x613a313a7b693a303b4e3b7d, 0x613a333a7b693a303b733a323a226631223b693a313b733a323a226632223b693a323b733a323a226633223b7d, '', NULL, '', '', '', '', 1259754527, 0, 0, 3, 0, 0x613a323a7b693a303b733a313a2231223b693a313b733a313a2232223b7d, NULL, NULL, NULL, NULL, NULL, 0x613a323a7b693a303b733a313a2231223b693a313b733a313a2232223b7d, NULL, NULL, NULL, '', NULL, '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tl_user_group`
--

DROP TABLE IF EXISTS `tl_user_group`;
CREATE TABLE `tl_user_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tstamp` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `modules` blob,
  `themes` blob,
  `pagemounts` blob,
  `alpty` blob,
  `filemounts` blob,
  `fop` blob,
  `forms` blob,
  `formp` blob,
  `alexf` blob,
  `disable` char(1) NOT NULL DEFAULT '',
  `start` varchar(10) NOT NULL DEFAULT '',
  `stop` varchar(10) NOT NULL DEFAULT '',
  `calendars` blob,
  `calendarp` blob,
  `calendarfeeds` blob,
  `calendarfeedp` blob,
  `faqs` blob,
  `faqp` blob,
  `news` blob,
  `newp` blob,
  `newsfeeds` blob,
  `newsfeedp` blob,
  `newsletters` blob,
  `newsletterp` blob,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `tl_user_group`
--

INSERT INTO `tl_user_group` (`id`, `tstamp`, `name`, `modules`, `themes`, `pagemounts`, `alpty`, `filemounts`, `fop`, `forms`, `formp`, `alexf`, `disable`, `start`, `stop`, `calendars`, `calendarp`, `calendarfeeds`, `calendarfeedp`, `faqs`, `faqp`, `news`, `newp`, `newsfeeds`, `newsfeedp`, `newsletters`, `newsletterp`) VALUES
(1, 1333985828, 'Editors', 0x613a353a7b693a303b733a373a2261727469636c65223b693a313b733a343a226e657773223b693a323b733a383a2263616c656e646172223b693a333b733a343a2270616765223b693a343b733a353a2266696c6573223b7d, NULL, 0x34, 0x613a333a7b693a303b733a373a22726567756c6172223b693a313b733a373a22666f7277617264223b693a323b733a383a227265646972656374223b7d, 0x613a313a7b693a303b693a323b7d, 0x613a333a7b693a303b733a323a226631223b693a313b733a323a226632223b693a323b733a323a226633223b7d, NULL, NULL, 0x613a3138393a7b693a303b733a31373a22746c5f61727469636c653a3a7469746c65223b693a313b733a31373a22746c5f61727469636c653a3a616c696173223b693a323b733a31383a22746c5f61727469636c653a3a617574686f72223b693a333b733a32303a22746c5f61727469636c653a3a696e436f6c756d6e223b693a343b733a32303a22746c5f61727469636c653a3a6b6579776f726473223b693a353b733a32323a22746c5f61727469636c653a3a73686f77546561736572223b693a363b733a32333a22746c5f61727469636c653a3a7465617365724373734944223b693a373b733a31383a22746c5f61727469636c653a3a746561736572223b693a383b733a32313a22746c5f61727469636c653a3a7072696e7461626c65223b693a393b733a31373a22746c5f61727469636c653a3a6373734944223b693a31303b733a31373a22746c5f61727469636c653a3a7370616365223b693a31313b733a31383a22746c5f63616c656e6461723a3a7469746c65223b693a31323b733a31393a22746c5f63616c656e6461723a3a6a756d70546f223b693a31333b733a32323a22746c5f63616c656e6461723a3a70726f746563746564223b693a31343b733a31393a22746c5f63616c656e6461723a3a67726f757073223b693a31353b733a32363a22746c5f63616c656e6461723a3a616c6c6f77436f6d6d656e7473223b693a31363b733a31393a22746c5f63616c656e6461723a3a6e6f74696679223b693a31373b733a32323a22746c5f63616c656e6461723a3a736f72744f72646572223b693a31383b733a32303a22746c5f63616c656e6461723a3a70657250616765223b693a31393b733a32313a22746c5f63616c656e6461723a3a6d6f646572617465223b693a32303b733a31393a22746c5f63616c656e6461723a3a6262636f6465223b693a32313b733a32353a22746c5f63616c656e6461723a3a726571756972654c6f67696e223b693a32323b733a32373a22746c5f63616c656e6461723a3a64697361626c6543617074636861223b693a32333b733a32353a22746c5f63616c656e6461725f6576656e74733a3a7469746c65223b693a32343b733a32353a22746c5f63616c656e6461725f6576656e74733a3a616c696173223b693a32353b733a32363a22746c5f63616c656e6461725f6576656e74733a3a617574686f72223b693a32363b733a32373a22746c5f63616c656e6461725f6576656e74733a3a61646454696d65223b693a32373b733a32393a22746c5f63616c656e6461725f6576656e74733a3a737461727454696d65223b693a32383b733a32373a22746c5f63616c656e6461725f6576656e74733a3a656e6454696d65223b693a32393b733a32393a22746c5f63616c656e6461725f6576656e74733a3a737461727444617465223b693a33303b733a32373a22746c5f63616c656e6461725f6576656e74733a3a656e6444617465223b693a33313b733a32363a22746c5f63616c656e6461725f6576656e74733a3a746561736572223b693a33323b733a32373a22746c5f63616c656e6461725f6576656e74733a3a64657461696c73223b693a33333b733a32383a22746c5f63616c656e6461725f6576656e74733a3a616464496d616765223b693a33343b733a32393a22746c5f63616c656e6461725f6576656e74733a3a73696e676c65535243223b693a33353b733a32333a22746c5f63616c656e6461725f6576656e74733a3a616c74223b693a33363b733a32343a22746c5f63616c656e6461725f6576656e74733a3a73697a65223b693a33373b733a33313a22746c5f63616c656e6461725f6576656e74733a3a696d6167656d617267696e223b693a33383b733a32383a22746c5f63616c656e6461725f6576656e74733a3a696d61676555726c223b693a33393b733a32383a22746c5f63616c656e6461725f6576656e74733a3a66756c6c73697a65223b693a34303b733a32373a22746c5f63616c656e6461725f6576656e74733a3a63617074696f6e223b693a34313b733a32383a22746c5f63616c656e6461725f6576656e74733a3a666c6f6174696e67223b693a34323b733a32393a22746c5f63616c656e6461725f6576656e74733a3a726563757272696e67223b693a34333b733a33303a22746c5f63616c656e6461725f6576656e74733a3a72657065617445616368223b693a34343b733a33313a22746c5f63616c656e6461725f6576656e74733a3a726563757272656e636573223b693a34353b733a33323a22746c5f63616c656e6461725f6576656e74733a3a616464456e636c6f73757265223b693a34363b733a32393a22746c5f63616c656e6461725f6576656e74733a3a656e636c6f73757265223b693a34373b733a32363a22746c5f63616c656e6461725f6576656e74733a3a736f75726365223b693a34383b733a32363a22746c5f63616c656e6461725f6576656e74733a3a6a756d70546f223b693a34393b733a32393a22746c5f63616c656e6461725f6576656e74733a3a61727469636c654964223b693a35303b733a32333a22746c5f63616c656e6461725f6576656e74733a3a75726c223b693a35313b733a32363a22746c5f63616c656e6461725f6576656e74733a3a746172676574223b693a35323b733a32383a22746c5f63616c656e6461725f6576656e74733a3a637373436c617373223b693a35333b733a33303a22746c5f63616c656e6461725f6576656e74733a3a6e6f436f6d6d656e7473223b693a35343b733a31363a22746c5f636f6e74656e743a3a74797065223b693a35353b733a32303a22746c5f636f6e74656e743a3a686561646c696e65223b693a35363b733a31363a22746c5f636f6e74656e743a3a74657874223b693a35373b733a32303a22746c5f636f6e74656e743a3a616464496d616765223b693a35383b733a32313a22746c5f636f6e74656e743a3a73696e676c65535243223b693a35393b733a31353a22746c5f636f6e74656e743a3a616c74223b693a36303b733a31373a22746c5f636f6e74656e743a3a7469746c65223b693a36313b733a31363a22746c5f636f6e74656e743a3a73697a65223b693a36323b733a32333a22746c5f636f6e74656e743a3a696d6167656d617267696e223b693a36333b733a32303a22746c5f636f6e74656e743a3a696d61676555726c223b693a36343b733a32303a22746c5f636f6e74656e743a3a66756c6c73697a65223b693a36353b733a31393a22746c5f636f6e74656e743a3a63617074696f6e223b693a36363b733a32303a22746c5f636f6e74656e743a3a666c6f6174696e67223b693a36373b733a31363a22746c5f636f6e74656e743a3a68746d6c223b693a36383b733a32303a22746c5f636f6e74656e743a3a6c69737474797065223b693a36393b733a32313a22746c5f636f6e74656e743a3a6c6973746974656d73223b693a37303b733a32323a22746c5f636f6e74656e743a3a7461626c656974656d73223b693a37313b733a31393a22746c5f636f6e74656e743a3a73756d6d617279223b693a37323b733a31373a22746c5f636f6e74656e743a3a7468656164223b693a37333b733a31373a22746c5f636f6e74656e743a3a74666f6f74223b693a37343b733a31373a22746c5f636f6e74656e743a3a746c656674223b693a37353b733a32303a22746c5f636f6e74656e743a3a736f727461626c65223b693a37363b733a32313a22746c5f636f6e74656e743a3a736f7274496e646578223b693a37373b733a32313a22746c5f636f6e74656e743a3a736f72744f72646572223b693a37383b733a31393a22746c5f636f6e74656e743a3a6d6f6f54797065223b693a37393b733a32333a22746c5f636f6e74656e743a3a6d6f6f486561646c696e65223b693a38303b733a32303a22746c5f636f6e74656e743a3a6d6f6f5374796c65223b693a38313b733a32323a22746c5f636f6e74656e743a3a6d6f6f436c6173736573223b693a38323b733a32313a22746c5f636f6e74656e743a3a686967686c69676874223b693a38333b733a31393a22746c5f636f6e74656e743a3a7368436c617373223b693a38343b733a31363a22746c5f636f6e74656e743a3a636f6465223b693a38353b733a31353a22746c5f636f6e74656e743a3a75726c223b693a38363b733a31383a22746c5f636f6e74656e743a3a746172676574223b693a38373b733a32313a22746c5f636f6e74656e743a3a6c696e6b5469746c65223b693a38383b733a31373a22746c5f636f6e74656e743a3a656d626564223b693a38393b733a31353a22746c5f636f6e74656e743a3a72656c223b693a39303b733a32303a22746c5f636f6e74656e743a3a757365496d616765223b693a39313b733a32303a22746c5f636f6e74656e743a3a6d756c7469535243223b693a39323b733a32323a22746c5f636f6e74656e743a3a757365486f6d65446972223b693a39333b733a31383a22746c5f636f6e74656e743a3a706572526f77223b693a39343b733a31393a22746c5f636f6e74656e743a3a70657250616765223b693a39353b733a32353a22746c5f636f6e74656e743a3a6e756d6265724f664974656d73223b693a39363b733a31383a22746c5f636f6e74656e743a3a736f72744279223b693a39373b733a32323a22746c5f636f6e74656e743a3a67616c6c65727954706c223b693a39383b733a32303a22746c5f636f6e74656e743a3a637465416c696173223b693a39393b733a32343a22746c5f636f6e74656e743a3a61727469636c65416c696173223b693a3130303b733a31393a22746c5f636f6e74656e743a3a61727469636c65223b693a3130313b733a31363a22746c5f636f6e74656e743a3a666f726d223b693a3130323b733a31383a22746c5f636f6e74656e743a3a6d6f64756c65223b693a3130333b733a32313a22746c5f636f6e74656e743a3a70726f746563746564223b693a3130343b733a31383a22746c5f636f6e74656e743a3a67726f757073223b693a3130353b733a31383a22746c5f636f6e74656e743a3a677565737473223b693a3130363b733a31373a22746c5f636f6e74656e743a3a6373734944223b693a3130373b733a31373a22746c5f636f6e74656e743a3a7370616365223b693a3130383b733a32313a22746c5f636f6e74656e743a3a636f6d5f6f72646572223b693a3130393b733a32333a22746c5f636f6e74656e743a3a636f6d5f70657250616765223b693a3131303b733a32343a22746c5f636f6e74656e743a3a636f6d5f6d6f646572617465223b693a3131313b733a32323a22746c5f636f6e74656e743a3a636f6d5f6262636f6465223b693a3131323b733a33303a22746c5f636f6e74656e743a3a636f6d5f64697361626c6543617074636861223b693a3131333b733a32383a22746c5f636f6e74656e743a3a636f6d5f726571756972654c6f67696e223b693a3131343b733a32343a22746c5f636f6e74656e743a3a636f6d5f74656d706c617465223b693a3131353b733a31373a22746c5f6e6577733a3a686561646c696e65223b693a3131363b733a31343a22746c5f6e6577733a3a616c696173223b693a3131373b733a31353a22746c5f6e6577733a3a617574686f72223b693a3131383b733a31333a22746c5f6e6577733a3a64617465223b693a3131393b733a31333a22746c5f6e6577733a3a74696d65223b693a3132303b733a32303a22746c5f6e6577733a3a737562686561646c696e65223b693a3132313b733a31353a22746c5f6e6577733a3a746561736572223b693a3132323b733a31333a22746c5f6e6577733a3a74657874223b693a3132333b733a31373a22746c5f6e6577733a3a616464496d616765223b693a3132343b733a31383a22746c5f6e6577733a3a73696e676c65535243223b693a3132353b733a31323a22746c5f6e6577733a3a616c74223b693a3132363b733a31333a22746c5f6e6577733a3a73697a65223b693a3132373b733a32303a22746c5f6e6577733a3a696d6167656d617267696e223b693a3132383b733a31373a22746c5f6e6577733a3a696d61676555726c223b693a3132393b733a31373a22746c5f6e6577733a3a66756c6c73697a65223b693a3133303b733a31363a22746c5f6e6577733a3a63617074696f6e223b693a3133313b733a31373a22746c5f6e6577733a3a666c6f6174696e67223b693a3133323b733a32313a22746c5f6e6577733a3a616464456e636c6f73757265223b693a3133333b733a31383a22746c5f6e6577733a3a656e636c6f73757265223b693a3133343b733a31353a22746c5f6e6577733a3a736f75726365223b693a3133353b733a31353a22746c5f6e6577733a3a6a756d70546f223b693a3133363b733a31383a22746c5f6e6577733a3a61727469636c654964223b693a3133373b733a31323a22746c5f6e6577733a3a75726c223b693a3133383b733a31353a22746c5f6e6577733a3a746172676574223b693a3133393b733a31373a22746c5f6e6577733a3a637373436c617373223b693a3134303b733a31393a22746c5f6e6577733a3a6e6f436f6d6d656e7473223b693a3134313b733a31373a22746c5f6e6577733a3a6665617475726564223b693a3134323b733a32323a22746c5f6e6577735f617263686976653a3a7469746c65223b693a3134333b733a32333a22746c5f6e6577735f617263686976653a3a6a756d70546f223b693a3134343b733a32363a22746c5f6e6577735f617263686976653a3a70726f746563746564223b693a3134353b733a32333a22746c5f6e6577735f617263686976653a3a67726f757073223b693a3134363b733a33303a22746c5f6e6577735f617263686976653a3a616c6c6f77436f6d6d656e7473223b693a3134373b733a32333a22746c5f6e6577735f617263686976653a3a6e6f74696679223b693a3134383b733a32363a22746c5f6e6577735f617263686976653a3a736f72744f72646572223b693a3134393b733a32343a22746c5f6e6577735f617263686976653a3a70657250616765223b693a3135303b733a32353a22746c5f6e6577735f617263686976653a3a6d6f646572617465223b693a3135313b733a32333a22746c5f6e6577735f617263686976653a3a6262636f6465223b693a3135323b733a32393a22746c5f6e6577735f617263686976653a3a726571756972654c6f67696e223b693a3135333b733a33313a22746c5f6e6577735f617263686976653a3a64697361626c6543617074636861223b693a3135343b733a31343a22746c5f706167653a3a7469746c65223b693a3135353b733a31343a22746c5f706167653a3a616c696173223b693a3135363b733a31333a22746c5f706167653a3a74797065223b693a3135373b733a31383a22746c5f706167653a3a706167655469746c65223b693a3135383b733a31373a22746c5f706167653a3a6c616e6775616765223b693a3135393b733a31353a22746c5f706167653a3a726f626f7473223b693a3136303b733a32303a22746c5f706167653a3a6465736372697074696f6e223b693a3136313b733a31373a22746c5f706167653a3a7265646972656374223b693a3136323b733a31353a22746c5f706167653a3a6a756d70546f223b693a3136333b733a31323a22746c5f706167653a3a75726c223b693a3136343b733a31353a22746c5f706167653a3a746172676574223b693a3136353b733a31323a22746c5f706167653a3a646e73223b693a3136363b733a31353a22746c5f706167653a3a6d6f62696c65223b693a3136373b733a31373a22746c5f706167653a3a66616c6c6261636b223b693a3136383b733a31393a22746c5f706167653a3a61646d696e456d61696c223b693a3136393b733a31393a22746c5f706167653a3a64617465466f726d6174223b693a3137303b733a31393a22746c5f706167653a3a74696d65466f726d6174223b693a3137313b733a32303a22746c5f706167653a3a646174696d466f726d6174223b693a3137323b733a32323a22746c5f706167653a3a637265617465536974656d6170223b693a3137333b733a32303a22746c5f706167653a3a736974656d61704e616d65223b693a3137343b733a31353a22746c5f706167653a3a75736553534c223b693a3137353b733a32303a22746c5f706167653a3a6175746f666f7277617264223b693a3137363b733a31383a22746c5f706167653a3a70726f746563746564223b693a3137373b733a31353a22746c5f706167653a3a67726f757073223b693a3137383b733a32323a22746c5f706167653a3a696e636c7564654c61796f7574223b693a3137393b733a31353a22746c5f706167653a3a6c61796f7574223b693a3138303b733a32313a22746c5f706167653a3a696e636c7564654361636865223b693a3138313b733a31343a22746c5f706167653a3a6361636865223b693a3138323b733a31373a22746c5f706167653a3a6e6f536561726368223b693a3138333b733a31373a22746c5f706167653a3a637373436c617373223b693a3138343b733a31363a22746c5f706167653a3a736974656d6170223b693a3138353b733a31333a22746c5f706167653a3a68696465223b693a3138363b733a31353a22746c5f706167653a3a677565737473223b693a3138373b733a31373a22746c5f706167653a3a746162696e646578223b693a3138383b733a31383a22746c5f706167653a3a6163636573736b6579223b7d, '', '', '', 0x613a313a7b693a303b733a313a2231223b7d, NULL, NULL, NULL, NULL, NULL, 0x613a313a7b693a303b733a313a2231223b7d, NULL, NULL, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
