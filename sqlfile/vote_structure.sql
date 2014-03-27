-- phpMyAdmin SQL Dump
-- http://www.phpmyadmin.net
--
-- 生成日期: 2014 年 03 月 26 日 23:33

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `GLJJJhtzrpAHWHTstqYu`
--

-- --------------------------------------------------------

--
-- 表的结构 `vote_project`
--

CREATE TABLE IF NOT EXISTS `vote_project` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_no` varchar(20) NOT NULL,
  `project_school` varchar(20) NOT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `project_logo` varchar(255) DEFAULT NULL,
  `project_ticket` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=151 ;

-- --------------------------------------------------------

--
-- 表的结构 `vote_user`
--

CREATE TABLE IF NOT EXISTS `vote_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `left_ticket` int(11) NOT NULL DEFAULT '10',
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16101 ;

-- --------------------------------------------------------

--
-- 表的结构 `vote_vote`
--

CREATE TABLE IF NOT EXISTS `vote_vote` (
  `vote_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vote_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`vote_id`),
  KEY `vote_project` (`project_id`),
  KEY `vote_user` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18811 ;

--
-- 限制导出的表
--

--
-- 限制表 `vote_vote`
--
ALTER TABLE `vote_vote`
  ADD CONSTRAINT `vote_project` FOREIGN KEY (`project_id`) REFERENCES `vote_project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vote_user` FOREIGN KEY (`user_id`) REFERENCES `vote_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
