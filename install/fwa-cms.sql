-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2016 at 10:01 AM
-- Server version: 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fwa-cms`
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
  `top` int(1) NOT NULL,
  `status` int(1) DEFAULT NULL COMMENT '1:Enable;0:Disble',
  `date_created` datetime NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` int(1) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

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
  `id_post` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_comment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `r_country`
--

CREATE TABLE IF NOT EXISTS `r_country` (
  `id_country` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1:Enable; 0:Disable',
  PRIMARY KEY (`id_country`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `r_country`
--

INSERT INTO `r_country` (`id_country`, `name`, `status`) VALUES
(1, 'India', 1),
(2, 'Australia', 1);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

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
  `top` int(1) NOT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_page`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

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
  `short_description` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `description` text COLLATE latin1_general_ci,
  `image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `favourites` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `source` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `image_source` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_post`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=36 ;

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
  `id_question` int(11) DEFAULT '0',
  PRIMARY KEY (`id_seo_url`),
  UNIQUE KEY `seo_url` (`seo_url`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=86 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `r_subscriber`
--

CREATE TABLE IF NOT EXISTS `r_subscriber` (
  `id_subscriber` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_subscriber`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

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
  `activate_link` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `skills` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `id_country` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `meta_title` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `meta_description` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `meta_title` (`meta_title`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `r_user`
--

INSERT INTO `r_user` (`id_user`, `id_user_role`, `name`, `phone`, `department`, `email`, `password`, `status`, `activate_link`, `skills`, `id_country`, `image`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
(1, 1, 'Demo', '7207556743', 'Demo', 'demo@snopzer.com', '4b443ee8c47d6bbc4d43c3717ab68ab0', 1, '', 'Demo', 1, 'demo.png', '', '', ''),
(9, 2, 'john', '3216549870', '', 'john@snopzer.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '', '', 2, NULL, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `r_user_role`
--

CREATE TABLE IF NOT EXISTS `r_user_role` (
  `id_user_role` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user_role`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `r_user_role`
--

INSERT INTO `r_user_role` (`id_user_role`, `role`, `status`, `date_created`, `date_updated`) VALUES
(1, 'Super Admin', 1, '0000-00-00 00:00:00', '2016-09-25 01:25:35');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
