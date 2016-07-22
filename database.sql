-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jul 22, 2016 at 03:20 AM
-- Server version: 5.5.45-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `techdefeat`
--

-- --------------------------------------------------------

--
-- Table structure for table `r_category`
--

CREATE TABLE IF NOT EXISTS `r_category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `description` text COLLATE latin1_general_ci,
  `image` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `meta_title` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `meta_description` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` int(1) DEFAULT NULL COMMENT '1:Enable;0:Disble',
  `date_created` datetime NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_category`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=32 ;

-- --------------------------------------------------------

--
-- Table structure for table `r_comment`
--

CREATE TABLE IF NOT EXISTS `r_comment` (
  `id_comment` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(99) COLLATE latin1_general_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `message` text COLLATE latin1_general_ci,
  `post_id` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_comment`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Table structure for table `r_country`
--

CREATE TABLE IF NOT EXISTS `r_country` (
  `id_country` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1:Enable; 0:Disable',
  PRIMARY KEY (`id_country`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `r_image`
--

CREATE TABLE IF NOT EXISTS `r_image` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `r_message`
--

CREATE TABLE IF NOT EXISTS `r_message` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `message` text COLLATE latin1_general_ci,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_message`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `r_page`
--

CREATE TABLE IF NOT EXISTS `r_page` (
  `id_page` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `page_heading` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `page_description` text COLLATE latin1_general_ci,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_page`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `r_post`
--

CREATE TABLE IF NOT EXISTS `r_post` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(1) NOT NULL,
  `id_category` int(11) DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL,
  `meta_title` varchar(155) COLLATE latin1_general_ci NOT NULL,
  `meta_keywords` varchar(155) COLLATE latin1_general_ci NOT NULL,
  `meta_description` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `title` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `seo_url` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `description` text COLLATE latin1_general_ci,
  `image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `favourites` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_post`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Table structure for table `r_ramzan_time`
--

CREATE TABLE IF NOT EXISTS `r_ramzan_time` (
  `id_ramzan` int(11) NOT NULL AUTO_INCREMENT,
  `r_date` date DEFAULT NULL,
  `r_saheri` time DEFAULT NULL,
  `r_fazar` time DEFAULT NULL,
  `r_zohar` time DEFAULT NULL,
  `r_asar` time DEFAULT NULL,
  `r_iftar` time DEFAULT NULL,
  `r_maghrib` time DEFAULT NULL,
  `r_isha` time DEFAULT NULL,
  PRIMARY KEY (`id_ramzan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `r_seo_url`
--

CREATE TABLE IF NOT EXISTS `r_seo_url` (
  `id_seo_url` int(11) NOT NULL AUTO_INCREMENT,
  `seo_url` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `id_category` int(11) DEFAULT '0',
  `id_post` int(11) DEFAULT '0',
  `id_page` int(11) DEFAULT '0',
  `id_user` int(11) DEFAULT '0',
  PRIMARY KEY (`id_seo_url`),
  UNIQUE KEY `seo_url` (`seo_url`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=49 ;

-- --------------------------------------------------------

--
-- Table structure for table `r_site_details`
--

CREATE TABLE IF NOT EXISTS `r_site_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `owner_email` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email_from` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `replay_email` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `title` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `google_analytics_code` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `copyrights` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `r_subscribe`
--

CREATE TABLE IF NOT EXISTS `r_subscribe` (
  `id_email` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `r_task`
--

CREATE TABLE IF NOT EXISTS `r_task` (
  `id_task` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_task_status` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_task`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `r_task_comment`
--

CREATE TABLE IF NOT EXISTS `r_task_comment` (
  `id_task_comment` int(11) NOT NULL AUTO_INCREMENT,
  `id_task` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `comment` text,
  `date_added` datetime DEFAULT NULL,
  PRIMARY KEY (`id_task_comment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `r_task_status`
--

CREATE TABLE IF NOT EXISTS `r_task_status` (
  `id_task_status` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_task_status`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `r_task_user`
--

CREATE TABLE IF NOT EXISTS `r_task_user` (
  `id_task_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_task` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  PRIMARY KEY (`id_task_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `r_user`
--

CREATE TABLE IF NOT EXISTS `r_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_role` int(11) NOT NULL,
  `name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `phone` varchar(99) COLLATE latin1_general_ci DEFAULT NULL,
  `department` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `password` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `skills` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `id_country` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `meta_title` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `meta_description` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `meta_title` (`meta_title`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `r_user_role`
--

CREATE TABLE IF NOT EXISTS `r_user_role` (
  `id_user_role` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user_role`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
