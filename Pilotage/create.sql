-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 25 Août 2013 à 22:49
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `apocalyspace`
--

-- --------------------------------------------------------

--
-- Structure de la table `BtoP`
--

CREATE TABLE IF NOT EXISTS `BtoP` (
  `buildingId` int(11) NOT NULL,
  `planetId` int(11) NOT NULL,
  `buildingLevel` int(11) DEFAULT '0',
  `buildingPopulation` int(11) DEFAULT '0',
  PRIMARY KEY (`buildingId`,`planetId`),
  KEY `planetId` (`planetId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `buildings`
--

CREATE TABLE IF NOT EXISTS `buildings` (
  `bl_id` int(11) NOT NULL AUTO_INCREMENT,
  `bl_name` varchar(40) DEFAULT NULL,
  `bl_description` text,
  `bl_buildingType` int(11) DEFAULT NULL,
  `bl_picture` varchar(64) DEFAULT NULL,
  `bl_cost1` int(11) DEFAULT NULL,
  `bl_cost2` int(11) DEFAULT NULL,
  `bl_cost3` int(11) DEFAULT NULL,
  `bl_buildingTime` int(11) DEFAULT '600',
  `bl_costMultiplier` float(3,2) DEFAULT '2.00',
  PRIMARY KEY (`bl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Structure de la table `communications`
--

CREATE TABLE IF NOT EXISTS `communications` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `com_senderId` int(11) NOT NULL,
  `com_recipientId` int(11) NOT NULL,
  `com_subject` varchar(255) DEFAULT NULL,
  `com_message` text,
  `com_sendTime` int(11) NOT NULL,
  `com_view` int(11) NOT NULL DEFAULT '0' COMMENT '1: lu - 0: non lu',
  PRIMARY KEY (`com_id`),
  KEY `com_senderId` (`com_senderId`),
  KEY `com_recipientId` (`com_recipientId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Structure de la table `defenseplans`
--

CREATE TABLE IF NOT EXISTS `defenseplans` (
  `dpl_id` int(11) NOT NULL AUTO_INCREMENT,
  `dpl_name` varchar(60) DEFAULT NULL,
  `dpl_userId` int(11) DEFAULT NULL,
  `dpl_modules` varchar(255) DEFAULT NULL,
  `dpl_cost1` int(11) DEFAULT NULL,
  `dpl_cost2` int(11) DEFAULT NULL,
  `dpl_cost3` int(11) DEFAULT NULL,
  `dpl_baseTime` int(11) DEFAULT NULL,
  PRIMARY KEY (`dpl_id`),
  KEY `dpl_userId` (`dpl_userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `defenses`
--

CREATE TABLE IF NOT EXISTS `defenses` (
  `def_id` int(11) NOT NULL DEFAULT '0',
  `def_planetId` int(11) NOT NULL DEFAULT '0',
  `def_quantity` int(11) DEFAULT '0',
  PRIMARY KEY (`def_id`,`def_planetId`),
  KEY `def_planetId` (`def_planetId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `fleets`
--

CREATE TABLE IF NOT EXISTS `fleets` (
  `fl_id` int(11) NOT NULL AUTO_INCREMENT,
  `fl_userId` int(11) NOT NULL,
  `fl_type` int(11) DEFAULT NULL,
  `fl_originPlanetId` int(11) DEFAULT NULL,
  `fl_destinationPlanetId` int(11) DEFAULT NULL,
  `fl_departingTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fl_arrivalTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fl_resource1` int(11) DEFAULT '0',
  `fl_resource2` int(11) DEFAULT '0',
  `fl_resource3` int(11) DEFAULT '0',
  PRIMARY KEY (`fl_id`),
  KEY `fl_originPlanetId` (`fl_originPlanetId`),
  KEY `fl_destinationPlanetId` (`fl_destinationPlanetId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `FtoS`
--

CREATE TABLE IF NOT EXISTS `FtoS` (
  `fleetId` int(11) NOT NULL DEFAULT '0',
  `shipId` int(11) NOT NULL DEFAULT '0',
  `fleetQuantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`fleetId`,`shipId`),
  KEY `shipId` (`shipId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `mod_id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_name` varchar(40) DEFAULT NULL,
  `mod_bonusType` int(11) DEFAULT NULL,
  `mod_bonusValue` varchar(100) DEFAULT NULL,
  `mod_baseTime` int(11) DEFAULT NULL,
  `mod_cost1` int(11) DEFAULT NULL,
  `mod_cost2` int(11) DEFAULT NULL,
  `mod_cost3` int(11) DEFAULT NULL,
  PRIMARY KEY (`mod_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Structure de la table `mtou`
--

CREATE TABLE IF NOT EXISTS `MtoU` (
  `moduleId` int(11) NOT NULL DEFAULT '0',
  `userId` int(11) NOT NULL DEFAULT '0',
  `moduleType` int(11) DEFAULT NULL,
  `moduleView` int(11) DEFAULT '0',
  PRIMARY KEY (`moduleId`,`userId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ongoingBuilds`
--

CREATE TABLE IF NOT EXISTS `ongoingBuilds` (
  `gb_id` int(11) NOT NULL AUTO_INCREMENT,
  `gb_buildType` int(11) NOT NULL,
  `gb_buildId` int(11) NOT NULL,
  `gb_buildQuantity` int(11) NOT NULL,
  `gb_planetId` int(11) DEFAULT NULL,
  `gb_userId` int(11) DEFAULT NULL,
  `gb_startTime` int(11) NOT NULL,
  `gb_endTime` int(11) NOT NULL,
  PRIMARY KEY (`gb_id`),
  KEY `gb_userId` (`gb_userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `planets`
--

CREATE TABLE IF NOT EXISTS `planets` (
  `pl_id` int(11) NOT NULL AUTO_INCREMENT,
  `pl_name` varchar(40) NOT NULL,
  `pl_planetSize` int(11) DEFAULT NULL,
  `pl_population` int(11) DEFAULT NULL,
  `pl_userId` int(11) NOT NULL,
  `pl_posX` int(11) DEFAULT NULL,
  `pl_posY` int(11) DEFAULT NULL,
  `pl_res1` int(11) DEFAULT NULL,
  `pl_res2` int(11) DEFAULT NULL,
  `pl_res3` int(11) DEFAULT NULL,
  `pl_pr` int(11) NOT NULL,
  `pl_prod_res1` int(11) NOT NULL DEFAULT '0',
  `pl_prod_res2` int(11) NOT NULL DEFAULT '0',
  `pl_prod_res3` int(11) NOT NULL DEFAULT '0',
  `pl_prod_pr` int(11) NOT NULL,
  `pl_prod_time` int(11) NOT NULL,
  `pl_natality_time` int(11) NOT NULL,
  `pl_natality` int(11) NOT NULL,
  `pl_primary` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pl_id`),
  UNIQUE KEY `pl_id` (`pl_id`),
  UNIQUE KEY `uc_Position` (`pl_posX`,`pl_posY`),
  KEY `pl_userId` (`pl_userId`),
  KEY `pl_id_2` (`pl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Structure de la table `shipplans`
--

CREATE TABLE IF NOT EXISTS `shipplans` (
  `spl_id` int(11) NOT NULL AUTO_INCREMENT,
  `spl_name` varchar(60) DEFAULT NULL,
  `spl_userId` int(11) DEFAULT NULL,
  `spl_modules` varchar(255) DEFAULT NULL,
  `spl_cost1` int(11) DEFAULT NULL,
  `spl_cost2` int(11) DEFAULT NULL,
  `spl_cost3` int(11) DEFAULT NULL,
  `spl_baseTime` int(11) DEFAULT NULL,
  PRIMARY KEY (`spl_id`),
  KEY `spl_userId` (`spl_userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ships`
--

CREATE TABLE IF NOT EXISTS `ships` (
  `shp_id` int(11) NOT NULL DEFAULT '0',
  `shp_planetId` int(11) NOT NULL DEFAULT '0',
  `shp_quantity` int(11) DEFAULT '0',
  PRIMARY KEY (`shp_id`,`shp_planetId`),
  KEY `shp_planetId` (`shp_planetId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `st_moduleId` int(11) NOT NULL DEFAULT '0',
  `st_planetId` int(11) NOT NULL DEFAULT '0',
  `st_quantity` int(11) DEFAULT '0',
  PRIMARY KEY (`st_moduleId`,`st_planetId`),
  KEY `st_planetId` (`st_planetId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `technologies`
--

CREATE TABLE IF NOT EXISTS `technologies` (
  `th_id` int(11) NOT NULL AUTO_INCREMENT,
  `th_name` varchar(40) DEFAULT NULL,
  `th_pitch` varchar(255) NOT NULL,
  `th_description` text,
  `th_informations` varchar(255) NOT NULL,
  PRIMARY KEY (`th_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Structure de la table `TtoU`
--

CREATE TABLE IF NOT EXISTS `TtoU` (
  `userId` int(11) NOT NULL DEFAULT '0',
  `techId` int(11) NOT NULL DEFAULT '0',
  `techLevel` int(11) DEFAULT '0',
  PRIMARY KEY (`userId`,`techId`),
  KEY `techId` (`techId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `passwordHash` char(32) NOT NULL,
  `factionName` varchar(50) NOT NULL DEFAULT 'vagabonds',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `BtoP`
--
ALTER TABLE `BtoP`
  ADD CONSTRAINT `BtoP_ibfk_3` FOREIGN KEY (`buildingId`) REFERENCES `buildings` (`bl_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `BtoP_ibfk_4` FOREIGN KEY (`planetId`) REFERENCES `planets` (`pl_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `communications`
--
ALTER TABLE `communications`
  ADD CONSTRAINT `communications_ibfk_3` FOREIGN KEY (`com_senderId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `communications_ibfk_4` FOREIGN KEY (`com_recipientId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `defenseplans`
--
ALTER TABLE `defenseplans`
  ADD CONSTRAINT `defenseplans_ibfk_2` FOREIGN KEY (`dpl_userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `defenses`
--
ALTER TABLE `defenses`
  ADD CONSTRAINT `defenses_ibfk_3` FOREIGN KEY (`def_id`) REFERENCES `defenseplans` (`dpl_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `defenses_ibfk_4` FOREIGN KEY (`def_planetId`) REFERENCES `planets` (`pl_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `fleets`
--
ALTER TABLE `fleets`
  ADD CONSTRAINT `fleets_ibfk_3` FOREIGN KEY (`fl_originPlanetId`) REFERENCES `planets` (`pl_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fleets_ibfk_4` FOREIGN KEY (`fl_destinationPlanetId`) REFERENCES `planets` (`pl_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `FtoS`
--
ALTER TABLE `FtoS`
  ADD CONSTRAINT `FtoS_ibfk_3` FOREIGN KEY (`fleetId`) REFERENCES `fleets` (`fl_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FtoS_ibfk_4` FOREIGN KEY (`shipId`) REFERENCES `shipplans` (`spl_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `mtou`
--
ALTER TABLE `mtou`
  ADD CONSTRAINT `mtou_ibfk_3` FOREIGN KEY (`moduleId`) REFERENCES `modules` (`mod_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mtou_ibfk_4` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ongoingBuilds`
--
ALTER TABLE `ongoingBuilds`
  ADD CONSTRAINT `ongoingBuilds_ibfk_2` FOREIGN KEY (`gb_userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `planets`
--
ALTER TABLE `planets`
  ADD CONSTRAINT `planets_ibfk_2` FOREIGN KEY (`pl_userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `shipplans`
--
ALTER TABLE `shipplans`
  ADD CONSTRAINT `shipplans_ibfk_2` FOREIGN KEY (`spl_userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ships`
--
ALTER TABLE `ships`
  ADD CONSTRAINT `ships_ibfk_3` FOREIGN KEY (`shp_id`) REFERENCES `shipplans` (`spl_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ships_ibfk_4` FOREIGN KEY (`shp_planetId`) REFERENCES `planets` (`pl_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_3` FOREIGN KEY (`st_moduleId`) REFERENCES `modules` (`mod_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_ibfk_4` FOREIGN KEY (`st_planetId`) REFERENCES `planets` (`pl_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `TtoU`
--
ALTER TABLE `TtoU`
  ADD CONSTRAINT `TtoU_ibfk_3` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `TtoU_ibfk_4` FOREIGN KEY (`techId`) REFERENCES `technologies` (`th_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
