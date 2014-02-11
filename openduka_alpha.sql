-- phpMyAdmin SQL Dump
-- version 3.3.10.4
-- http://www.phpmyadmin.net
--
-- Host: mysql.alpha.openduka.org
-- Generation Time: Feb 10, 2014 at 09:54 PM
-- Server version: 5.1.56
-- PHP Version: 5.3.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `openduka_alpha`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_users`
--

DROP TABLE IF EXISTS `api_users`;
CREATE TABLE IF NOT EXISTS `api_users` (
  `au_id` int(11) NOT NULL AUTO_INCREMENT,
  `au_email` text,
  `au_name` text,
  `au_organization` text,
  `au_url` text,
  `au_description` text,
  `au_key` text,
  `au_joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `au_code` text NOT NULL,
  `au_confirmed` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`au_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `DocumentType`
--

DROP TABLE IF EXISTS `DocumentType`;
CREATE TABLE IF NOT EXISTS `DocumentType` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DocTypeName` varchar(255) NOT NULL,
  `Viewed` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `DocUploaded`
--

DROP TABLE IF EXISTS `DocUploaded`;
CREATE TABLE IF NOT EXISTS `DocUploaded` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `doc_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `pages` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DocTypeID` varchar(255) NOT NULL,
  `data_table` text NOT NULL,
  `representation` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1257 ;

-- --------------------------------------------------------

--
-- Table structure for table `Entity`
--

DROP TABLE IF EXISTS `Entity`;
CREATE TABLE IF NOT EXISTS `Entity` (
  `ID` int(9) NOT NULL AUTO_INCREMENT,
  `EntityPosition` varchar(255) NOT NULL,
  `Name` text NOT NULL,
  `EntityTypeID` int(11) NOT NULL,
  `EntityContext` text NOT NULL,
  `DocID` varchar(255) NOT NULL,
  `EntityMap` text NOT NULL,
  `EntityOrganisation` varchar(255) NOT NULL,
  `EffectiveDate` varchar(255) NOT NULL,
  `UniqueInfo` text NOT NULL,
  `Verb` varchar(255) NOT NULL,
  `Appointer` varchar(255) NOT NULL,
  `UserID` int(11) NOT NULL,
  `EntryDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DocTypeID` varchar(255) NOT NULL DEFAULT '7,',
  `Merged` tinyint(4) NOT NULL DEFAULT '0',
  `MergedTo` int(11) NOT NULL,
  `MostVisited` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5286 ;

-- --------------------------------------------------------

--
-- Table structure for table `EntityType`
--

DROP TABLE IF EXISTS `EntityType`;
CREATE TABLE IF NOT EXISTS `EntityType` (
  `EntityTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `EntityType` varchar(255) NOT NULL,
  `Active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`EntityTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Table structure for table `SysTables`
--

DROP TABLE IF EXISTS `SysTables`;
CREATE TABLE IF NOT EXISTS `SysTables` (
  `TableName` varchar(255) NOT NULL,
  `Viewed` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
