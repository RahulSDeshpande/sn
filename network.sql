-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 07, 2012 at 02:13 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `network`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `friend1` int(11) NOT NULL,
  `friend2` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`friend1`, `friend2`, `status`) VALUES
(1, 3, 2),
(1, 5, 2),
(1, 6, 1),
(1, 2, 1),
(7, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `grpid` int(11) NOT NULL AUTO_INCREMENT,
  `time` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pic` text NOT NULL,
  PRIMARY KEY (`grpid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`grpid`, `time`, `admin`, `name`, `pic`) VALUES
(1, 1333666029, 1, 'Dr. MGR University', ''),
(8, 1333786803, 7, 'Sex and the City', ''),
(9, 1333794911, 7, 'hellolgf', ''),
(10, 1333796352, 7, 'desi gals', '');

-- --------------------------------------------------------

--
-- Table structure for table `grpmem`
--

CREATE TABLE IF NOT EXISTS `grpmem` (
  `grpid` int(11) NOT NULL,
  `memid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grpmem`
--

INSERT INTO `grpmem` (`grpid`, `memid`, `status`) VALUES
(1, 1, 0),
(8, 7, 0),
(9, 7, 0),
(10, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `grpposts`
--

CREATE TABLE IF NOT EXISTS `grpposts` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `grpid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `ref` int(11) NOT NULL DEFAULT '0',
  `posttext` text NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `grpposts`
--

INSERT INTO `grpposts` (`p_id`, `grpid`, `userid`, `ref`, `posttext`, `time`) VALUES
(42, 9, 7, 0, 'ranix das ravi saurabhasdadasd', 1333794939),
(44, 8, 7, 0, 'ranix das ravi saurabhasdadasd', 1333794939),
(45, 8, 7, 0, 'A social network is a social structure made up of a set of actors (such as individuals or organizations) and the dyadic ties between these actors (such as relationships, connections, or interactions). A social network perspective is employed to model the structure of a social group, how this structure influences other variables, or how structures change over time..', 1333796330),
(46, 9, 7, 0, 'A social network is a social structure made up of a set of actors (such as individuals or organizations) and the dyadic ties between these actors (such as relationships, connections, or interactions). A social network perspective is employed to model the structure of a social group, how this structure influences other variables, or how structures change over time..', 1333796330),
(47, 8, 7, 0, 'A social network is a social structure made up of a set of actors (such as individuals or organizations) and the dyadic ties between these actors (such as relationships, connections, or interactions). A social network perspective is employed to model the structure of a social group, how this structure influences other variables, or how structures change over timeA social network is a social structure made up of a set of actors (such as individuals or organizations) and the dyadic ties between these actors (such as relationships, connections, or interactions). A social network perspective is employed to model the structure of a social group, how this structure influences other variables, or how structures change over timeA social network is a social structure made up of a set of actors (such as individuals or organizations) and the dyadic ties between these actors (such as relationships, connections, or interactions). A social network perspective is employed to model the structure of a social group, how this structure influences other variables, or how structures change over time', 1333796367),
(48, 10, 7, 0, 'A social network is a social structure made up of a set of actors (such as individuals or organizations) and the dyadic ties between these actors (such as relationships, connections, or interactions). A social network perspective is employed to model the structure of a social group, how this structure influences other variables, or how structures change over timeA social network is a social structure made up of a set of actors (such as individuals or organizations) and the dyadic ties between these actors (such as relationships, connections, or interactions). A social network perspective is employed to model the structure of a social group, how this structure influences other variables, or how structures change over time', 1333796383),
(49, 8, 7, 0, 'A social network is a social structure made up of a set of actors (such as individuals or organizations) and the dyadic ties between these actors (such as relationships, connections, or interactions). A social network perspective is employed to model the structure of a social group, how this structure influences other variables, or how structures change over timeA social network is a social structure made up of a set of actors (such as individuals or organizations) and the dyadic ties between these actors (such as relationships, connections, or interactions). A social network perspective is employed to model the structure of a social group, how this structure influences other variables, or how structures change over time', 1333796383),
(50, 9, 7, 0, 'A social network is a social structure made up of a set of actors (such as individuals or organizations) and the dyadic ties between these actors (such as relationships, connections, or interactions). A social network perspective is employed to model the structure of a social group, how this structure influences other variables, or how structures change over timeA social network is a social structure made up of a set of actors (such as individuals or organizations) and the dyadic ties between these actors (such as relationships, connections, or interactions). A social network perspective is employed to model the structure of a social group, how this structure influences other variables, or how structures change over time', 1333796383);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `ref` int(11) NOT NULL DEFAULT '0',
  `posttext` text NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`p_id`, `userid`, `ref`, `posttext`, `time`) VALUES
(7, 7, 0, 'A good way to approach an essay is to envision it as a Five Part project. An essay is made up of the Introduction, Three main points (the body), and the Conclusion. So it looks like this:I. IntroductionII. Point OneIII. Point TwoIV. Point ThreeV. Conclusion', 1333724119),
(8, 7, 0, 'A good way to approach an essay is to envision it as a Five Part project. An essay is made up of the Introduction, Three main points (the body), and the Conclusion. So it looks like this:I. IntroductionII. Point OneIII. Point TwoIV. Point ThreeV. Conclusion', 1333724220),
(9, 7, 8, 'An Introduction should answer three questions 1. What am I talking about in this paper? By answering this question you let the reader know what the subject of the paper is. For example, if your paper were about a particular book, your answer to this question would give the title, author, and any other necessary information. 2. How am I going to talk about it? This is where you let the reader know how your paper is organized. Here you very briefly introduce your main points or the evidence that will prove your point. 3. What am I going to prove in this paper? This is the dreaded THESIS STATEMENT. The thesis is usually the last sentence in the first paragraph and it clearly states the argument or point you are making in your paper. The Bodyâ€¦ ', 1333724284),
(10, 7, 0, ' An Introduction should answer three questions 1. What am I talking about in this paper? By answering this question you let the reader know what the subject of the paper is. For example, if your paper were about a particular book, your answer to this question would give the title, author, and any other necessary information. 2. How am I going to talk about it? This is where you let the reader know how your paper is organized. Here you very briefly introduce your main points or the evidence that will prove your point. 3. What am I going to prove in this paper? This is the dreaded THESIS STATEMENT. The thesis is usually the last sentence in the first paragraph and it clearly states the argument or point you are making in your paper. The Bodyâ€¦', 1333724393),
(11, 7, 10, ' A good way to approach an essay is to envision it as a Five Part project. An essay is made up of the Introduction, Three main points (the body), and the Conclusion. So it looks like this:I. IntroductionII. Point OneIII. Point TwoIV. Point ThreeV. Conclusion  ', 1333724407),
(13, 7, 10, 'The name of Cooum appears to be derived from Tamil literature. The word coovalan denotes a person who is well versed in the science of ground water, well water and stagnant water. The river is also considered to be the shortest classified river draining into the Bay of Bengal and is only about 65 km (40 miles) long. Its source is in a place by the same name Cooum or Koovam in Tiruvallur district', 1333724616),
(15, 7, 10, ' A good way to approach an essay is to envision it as a Five Part project. An essay is made up of the Introduction, Three main points (the body), and the Conclusion. So it looks like this:I. IntroductionII. Point OneIII. Point TwoIV. Point ThreeV. Conclusion', 1333774504),
(17, 7, 0, 'hi', 1333782540),
(18, 7, 0, 'hi', 1333782548),
(19, 7, 17, 'asdasd', 1333782552),
(20, 7, 0, 'asdasd', 1333782575),
(21, 7, 0, 'hello', 1333782584),
(22, 7, 21, 'hkjkjkljl', 1333782615),
(23, 7, 0, 'A social network is a social structure made up of a set of actors (such as individuals or organizations) and the dyadic ties between these actors (such as relationships, connections, or interactions). A social network perspective is employed to model the structure of a social group, how this structure influences other variables, or how structures change over timeA social network is a social structure made up of a set of actors (such as individuals or organizations) and the dyadic ties between these actors (such as relationships, connections, or interactions). A social network perspective is employed to model the structure of a social group, how this structure influences other variables, or how structures change over timeA social network is a social structure made up of a set of actors (such as individuals or organizations) and the dyadic ties between these actors (such as relationships, connections, or interactions). A social network perspective is employed to model the structure of a social group, how this structure influences other variables, or how structures change over time', 1333798532),
(24, 7, 23, 'A social network is a social structure made up of a set of actors (such as individuals or organizations) and the dyadic ties between these actors (such as relationships, connections, or interactions). A social network perspective is employed to model the structure of a social group, how this structure influences other variables, or how structures change over timeA social network is a social structure made up of a set of actors (such as individuals or organizations) and the dyadic ties between these actors (such as relationships, connections, or interactions). A social network perspective is employed to model the structure of a social group, how this structure influences other variables, or how structures change over time', 1333798541),
(25, 7, 23, 'A social network is a social structure made up of a set of actors (such as individuals or organizations) and the dyadic ties between these actors (such as relationships, connections, or interactions). A social network perspective is employed to model the structure of a social group, how this structure influences other variables, or how structures change over time', 1333798551);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `userid` int(11) NOT NULL,
  `currentcity` varchar(50) NOT NULL,
  `hometown` varchar(50) NOT NULL,
  `interest` text NOT NULL,
  `about` text NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`userid`, `currentcity`, `hometown`, `interest`, `about`) VALUES
(7, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `sex` varchar(6) NOT NULL,
  `dob` int(11) NOT NULL,
  `pic` text NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `email`, `password`, `firstname`, `lastname`, `sex`, `dob`, `pic`) VALUES
(2, 'Priya@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Priya', 'Singh', 'female', 0, ''),
(3, 'rahul@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'rahul', 'das', 'male', 0, ''),
(5, 'saurabh@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'saurabh', 'anand', 'male', 0, ''),
(7, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Ranix', 'Das', 'male', 0, 'IMG_1762-1.JPG');
