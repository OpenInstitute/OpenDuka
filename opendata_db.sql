-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 04, 2013 at 12:03 PM
-- Server version: 5.5.29
-- PHP Version: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `opendata_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `City`
--

CREATE TABLE IF NOT EXISTS `City` (
  `CityID` int(11) NOT NULL AUTO_INCREMENT,
  `City` varchar(255) NOT NULL,
  `DocID` varchar(255) NOT NULL DEFAULT '0,',
  PRIMARY KEY (`CityID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `Company`
--

CREATE TABLE IF NOT EXISTS `Company` (
  `CompanyID` int(11) NOT NULL AUTO_INCREMENT,
  `Company` varchar(255) NOT NULL,
  `DocID` varchar(255) NOT NULL DEFAULT '0,',
  PRIMARY KEY (`CompanyID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Country`
--

CREATE TABLE IF NOT EXISTS `Country` (
  `CountryID` int(11) NOT NULL AUTO_INCREMENT,
  `Country` varchar(255) NOT NULL,
  `DocID` varchar(255) NOT NULL DEFAULT '0,',
  PRIMARY KEY (`CountryID`),
  KEY `CountryID` (`CountryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `Currency`
--

CREATE TABLE IF NOT EXISTS `Currency` (
  `CurrencyID` int(11) NOT NULL AUTO_INCREMENT,
  `Currency` varchar(255) NOT NULL,
  `DocID` varchar(255) NOT NULL DEFAULT '0,',
  PRIMARY KEY (`CurrencyID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `DocUploaded`
--

CREATE TABLE IF NOT EXISTS `DocUploaded` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `doc_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `pages` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `canonical_url` varchar(255) NOT NULL,
  `contributor` varchar(255) NOT NULL,
  `contributor_organization` varchar(255) NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `search` varchar(255) NOT NULL,
  `pagetext` varchar(255) NOT NULL,
  `pageimage` varchar(255) NOT NULL,
  `DocText` text NOT NULL,
  `DocType` varchar(255) NOT NULL,
  `entities` text NOT NULL,
  `representation` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=330 ;

-- --------------------------------------------------------

--
-- Table structure for table `EmailAddress`
--

CREATE TABLE IF NOT EXISTS `EmailAddress` (
  `EmailID` int(11) NOT NULL AUTO_INCREMENT,
  `EmailAddress` varchar(255) NOT NULL,
  `DocID` varchar(255) NOT NULL DEFAULT '0,',
  PRIMARY KEY (`EmailID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Facility`
--

CREATE TABLE IF NOT EXISTS `Facility` (
  `FacilityID` int(11) NOT NULL AUTO_INCREMENT,
  `Facility` varchar(255) NOT NULL,
  `DocID` varchar(255) NOT NULL DEFAULT '0,',
  PRIMARY KEY (`FacilityID`),
  KEY `FacilityID` (`FacilityID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `FaxNumber`
--

CREATE TABLE IF NOT EXISTS `FaxNumber` (
  `FaxNumberID` int(11) NOT NULL AUTO_INCREMENT,
  `FaxNumber` varchar(255) NOT NULL,
  `DocID` varchar(255) NOT NULL DEFAULT '0,',
  PRIMARY KEY (`FaxNumberID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `IndustryTerm`
--

CREATE TABLE IF NOT EXISTS `IndustryTerm` (
  `IndustryTermID` int(11) NOT NULL AUTO_INCREMENT,
  `IndustryTerm` varchar(255) NOT NULL,
  `DocID` varchar(255) NOT NULL DEFAULT '0,',
  PRIMARY KEY (`IndustryTermID`),
  KEY `IndustryTermID` (`IndustryTermID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Location`
--

CREATE TABLE IF NOT EXISTS `Location` (
  `LocationID` int(11) NOT NULL AUTO_INCREMENT,
  `Location` varchar(255) NOT NULL,
  `DocID` varchar(255) NOT NULL DEFAULT '0,',
  PRIMARY KEY (`LocationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Organization`
--

CREATE TABLE IF NOT EXISTS `Organization` (
  `OrganizationID` int(11) NOT NULL AUTO_INCREMENT,
  `Organization` varchar(255) NOT NULL,
  `DocID` varchar(255) NOT NULL DEFAULT '0,',
  PRIMARY KEY (`OrganizationID`),
  KEY `OrganizationID` (`OrganizationID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `Person`
--

CREATE TABLE IF NOT EXISTS `Person` (
  `PersonID` int(11) NOT NULL AUTO_INCREMENT,
  `Person` varchar(255) NOT NULL,
  `DocID` varchar(255) NOT NULL DEFAULT '0,',
  PRIMARY KEY (`PersonID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `PhoneNumber`
--

CREATE TABLE IF NOT EXISTS `PhoneNumber` (
  `PhoneNumberID` int(11) NOT NULL AUTO_INCREMENT,
  `PhoneNumber` varchar(255) NOT NULL,
  `DocID` varchar(255) NOT NULL DEFAULT '0,',
  PRIMARY KEY (`PhoneNumberID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Position`
--

CREATE TABLE IF NOT EXISTS `Position` (
  `PositionID` int(11) NOT NULL AUTO_INCREMENT,
  `Position` varchar(255) NOT NULL,
  `DocID` varchar(255) NOT NULL DEFAULT '0,',
  PRIMARY KEY (`PositionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `SocialTag`
--

CREATE TABLE IF NOT EXISTS `SocialTag` (
  `SocialTagID` int(11) NOT NULL AUTO_INCREMENT,
  `SocialTag` varchar(255) NOT NULL,
  `DocID` varchar(255) NOT NULL DEFAULT '0,',
  PRIMARY KEY (`SocialTagID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SubTexts`
--

CREATE TABLE IF NOT EXISTS `SubTexts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EntityType` varchar(255) NOT NULL,
  `EntityID` int(11) NOT NULL,
  `Verb` varchar(255) NOT NULL DEFAULT 'appointed',
  `JoinEntityType` varchar(255) NOT NULL,
  `JoinEntityID` int(11) NOT NULL,
  `Dated` varchar(150) NOT NULL,
  `DocID` int(11) NOT NULL,
  `Processed` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Technology`
--

CREATE TABLE IF NOT EXISTS `Technology` (
  `TechnologyID` int(11) NOT NULL AUTO_INCREMENT,
  `Technology` varchar(255) NOT NULL,
  `DocID` varchar(255) NOT NULL DEFAULT '0,',
  PRIMARY KEY (`TechnologyID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `URL`
--

CREATE TABLE IF NOT EXISTS `URL` (
  `URLID` int(11) NOT NULL AUTO_INCREMENT,
  `URL` varchar(255) NOT NULL,
  `DocID` varchar(255) NOT NULL DEFAULT '0,',
  PRIMARY KEY (`URLID`),
  KEY `URLID` (`URLID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
