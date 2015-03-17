-- phpMyAdmin SQL Dump
-- version 4.0.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Ott 10, 2014 alle 12:06
-- Versione del server: 5.5.38-0ubuntu0.14.04.1
-- Versione PHP: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--------------------------------------------------------

--
-- Struttura della tabella `sys_user`
--

CREATE TABLE IF NOT EXISTS `sys_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `username` varchar(150) DEFAULT '',
  `password` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `blocked` tinyint(1) DEFAULT '0',
  `sendemail` tinyint(1) DEFAULT '0',
  `activationcode` varchar(100) DEFAULT NULL,
  `registerdate` datetime DEFAULT '0000-00-00 00:00:00',
  `lastvisit` datetime DEFAULT '0000-00-00 00:00:00',
  `sys_userrole_fk` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `sys_user`
--

INSERT INTO `sys_user` (`id`, `name`, `username`, `password`, `email`, `blocked`, `sendemail`, `activationcode`, `registerdate`, `lastvisit`, `sys_userrole_fk`) VALUES
(1, 'root', 'root', 'root', 'root@root', 0, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `sys_userlog`
--

CREATE TABLE IF NOT EXISTS `sys_userlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fk` int(11) DEFAULT '0',
  `sessionid` varchar(150) DEFAULT NULL,
  `source` varchar(150) DEFAULT NULL,
  `timestamp` datetime DEFAULT '0000-00-00 00:00:00',
  `resource` varchar(255) DEFAULT NULL,
  `task` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `result` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `sys_userlog`
--

INSERT INTO `sys_userlog` (`id`, `user_fk`, `sessionid`, `source`, `timestamp`, `resource`, `task`, `details`, `result`) VALUES
(1, 1, 's0o0toeog5tjph3jgpldb0ous0', 'external', '2014-10-10 12:06:19', '127.0.0.1', 'LOGIN', NULL, 'true');

-- --------------------------------------------------------

--
-- Struttura della tabella `sys_userlogged`
--

CREATE TABLE IF NOT EXISTS `sys_userlogged` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fk` int(11) DEFAULT '0',
  `sessionid` varchar(150) DEFAULT NULL,
  `source` varchar(150) DEFAULT NULL,
  `accessdate` datetime DEFAULT '0000-00-00 00:00:00',
  `lastoperation` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=745 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `sys_userrole`
--

CREATE TABLE IF NOT EXISTS `sys_userrole` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT '',
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `sys_userrole`
--

INSERT INTO `sys_userrole` (`id`, `name`, `description`) VALUES
(1, 'Amministratore', 'Amministratore di sistema'),
(2, 'Operatore', 'Operatore');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
