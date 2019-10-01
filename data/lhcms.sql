-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 年 02 月 19 日 11:14
-- 服务器版本: 5.5.53
-- PHP 版本: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `lh`
--

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `artid` int(11) NOT NULL AUTO_INCREMENT,
  `classid` int(11) DEFAULT '0',
  `classname` varchar(50) DEFAULT NULL,
  `parentid` int(11) DEFAULT '0',
  `parentname` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `descrip` longtext,
  `keywords` longtext,
  `author` varchar(50) DEFAULT NULL,
  `origin` varchar(50) DEFAULT NULL,
  `content` longtext,
  `addtime` datetime DEFAULT NULL,
  `hits` int(11) DEFAULT '0',
  `tj` tinyint(1) DEFAULT '0',
  `savepathfilename` longtext,
  PRIMARY KEY (`artid`),
  KEY `BigClassID` (`parentid`),
  KEY `smallclassid` (`classid`),
  KEY `typeid` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `cd`
--

CREATE TABLE IF NOT EXISTS `cd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cdname` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) NOT NULL,
  `classname` varchar(50) DEFAULT NULL,
  `menuis` tinyint(1) DEFAULT '1',
  `menuxh` int(11) NOT NULL DEFAULT '0',
  `lmis` tinyint(1) DEFAULT '1',
  `lmxh` int(11) DEFAULT '0',
  PRIMARY KEY (`classid`),
  KEY `BigClassID` (`classid`),
  KEY `showid` (`menuis`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `hd`
--

CREATE TABLE IF NOT EXISTS `hd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `url` longtext,
  `picture` varchar(100) DEFAULT NULL,
  `lb` int(11) DEFAULT '0',
  `xh` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `lhadmin`
--

CREATE TABLE IF NOT EXISTS `lhadmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lhuser` varchar(50) DEFAULT NULL,
  `lhpassword` varchar(50) DEFAULT NULL,
  `dj` varchar(50) DEFAULT NULL,
  `lm` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lhadmin`
--

INSERT INTO `lhadmin` (`id`, `lhuser`, `lhpassword`, `dj`, `lm`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '1', '');

-- --------------------------------------------------------

--
-- 表的结构 `sys`
--

CREATE TABLE IF NOT EXISTS `sys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `website` varchar(50) DEFAULT NULL,
  `weburl` varchar(50) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `beianhao` varchar(50) DEFAULT NULL,
  `lhkeywords` longtext,
  `lhdescrip` longtext,
  `newsperpage` int(11) DEFAULT '0',
  `showhit` tinyint(1) DEFAULT NULL,
  `indexjt` tinyint(1) DEFAULT NULL,
  `artjt` tinyint(1) DEFAULT NULL,
  `listjt` tinyint(1) DEFAULT NULL,
  `moban` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `sys`
--

INSERT INTO `sys` (`id`, `website`, `weburl`, `mail`, `beianhao`, `lhkeywords`, `lhdescrip`, `newsperpage`, `showhit`, `indexjt`, `artjt`, `listjt`, `moban`) VALUES
(1, '烈火文章管理系统', 'http://www.strongfire.cn', '', '', '文章管理系统，烈火文章管理系统', '烈火文章管理系简单实用，操作方便，界面简洁。', 30, 1, 0, 0, 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
