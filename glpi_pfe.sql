-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 22 mai 2019 à 20:51
-- Version du serveur :  5.7.24
-- Version de PHP :  7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `glpi_pfe`
--

-- --------------------------------------------------------

--
-- Structure de la table `gs_affectation`
--

DROP TABLE IF EXISTS `gs_affectation`;
CREATE TABLE IF NOT EXISTS `gs_affectation` (
  `affectation_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `bureau_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `matriel_id` int(11) NOT NULL,
  PRIMARY KEY (`affectation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gs_bureau`
--

DROP TABLE IF EXISTS `gs_bureau`;
CREATE TABLE IF NOT EXISTS `gs_bureau` (
  `bureau_id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_bureau` varchar(45) DEFAULT NULL,
  `code_bureau` varchar(45) DEFAULT NULL,
  `site_id` int(11) NOT NULL,
  `chef_bureau` varchar(125) NOT NULL,
  `mail_chef` varchar(125) NOT NULL,
  `adresse` varchar(125) NOT NULL,
  `ip_chef` varchar(25) NOT NULL,
  `Actif` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`bureau_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gs_delegation`
--

DROP TABLE IF EXISTS `gs_delegation`;
CREATE TABLE IF NOT EXISTS `gs_delegation` (
  `delegation_id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_delegation` varchar(45) DEFAULT NULL,
  `Actif` tinyint(1) DEFAULT '1',
  `gouvernorat_id` int(11) NOT NULL,
  PRIMARY KEY (`delegation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gs_event`
--

DROP TABLE IF EXISTS `gs_event`;
CREATE TABLE IF NOT EXISTS `gs_event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(32) NOT NULL,
  `trigger` text NOT NULL,
  `action` text NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gs_gouvernorat`
--

DROP TABLE IF EXISTS `gs_gouvernorat`;
CREATE TABLE IF NOT EXISTS `gs_gouvernorat` (
  `gouvernorat_id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_gouvernorat` varchar(45) DEFAULT NULL,
  `Actif` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`gouvernorat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gs_language`
--

DROP TABLE IF EXISTS `gs_language`;
CREATE TABLE IF NOT EXISTS `gs_language` (
  `language_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `code` varchar(5) NOT NULL,
  `locale` varchar(255) NOT NULL,
  `image` varchar(64) NOT NULL,
  `directory` varchar(32) NOT NULL,
  `filename` varchar(64) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `gs_marque_matriel`
--

DROP TABLE IF EXISTS `gs_marque_matriel`;
CREATE TABLE IF NOT EXISTS `gs_marque_matriel` (
  `marque_matriel_id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_marque_matriel` varchar(125) DEFAULT NULL,
  `type_matriel_id` int(11) NOT NULL,
  `Actif` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`marque_matriel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gs_matriel`
--

DROP TABLE IF EXISTS `gs_matriel`;
CREATE TABLE IF NOT EXISTS `gs_matriel` (
  `matriel_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `type_matriel_id` int(11) NOT NULL,
  `bureau_id` int(11) NOT NULL,
  `coupon` varchar(252) NOT NULL,
  `mac` varchar(25) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `plus_info` text NOT NULL,
  `fiche` varchar(125) NOT NULL,
  `date_achat` date DEFAULT NULL,
  `date_affectation` date DEFAULT NULL,
  `date_prevu` date DEFAULT NULL,
  `garantie` tinyint(4) NOT NULL,
  `internet` tinyint(4) NOT NULL,
  `connecte` varchar(1) NOT NULL,
  PRIMARY KEY (`matriel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gs_personnel`
--

DROP TABLE IF EXISTS `gs_personnel`;
CREATE TABLE IF NOT EXISTS `gs_personnel` (
  `personnel_id` int(11) NOT NULL AUTO_INCREMENT,
  `internet` tinyint(4) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(96) NOT NULL,
  `matricule` varchar(40) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `profession_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `bureau_id` int(11) NOT NULL,
  PRIMARY KEY (`personnel_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `gs_profession`
--

DROP TABLE IF EXISTS `gs_profession`;
CREATE TABLE IF NOT EXISTS `gs_profession` (
  `profession_id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_profession` varchar(45) DEFAULT NULL,
  `Actif` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`profession_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gs_setting`
--

DROP TABLE IF EXISTS `gs_setting`;
CREATE TABLE IF NOT EXISTS `gs_setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(32) NOT NULL,
  `key` varchar(64) NOT NULL,
  `value` text NOT NULL,
  `serialized` tinyint(1) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`setting_id`),
  KEY `fk_gs_setting_gs_store1_idx` (`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `gs_site`
--

DROP TABLE IF EXISTS `gs_site`;
CREATE TABLE IF NOT EXISTS `gs_site` (
  `site_id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_site` varchar(45) DEFAULT NULL,
  `code_site` varchar(45) DEFAULT NULL,
  `gouvernorat_id` int(11) NOT NULL,
  `adresse` varchar(125) NOT NULL,
  `nom_chef` varchar(125) NOT NULL,
  `ip_chef` varchar(125) NOT NULL,
  `mail_chef` varchar(125) NOT NULL,
  `analyste` varchar(125) NOT NULL,
  `analyste_ip` varchar(25) NOT NULL,
  `Actif` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`site_id`,`gouvernorat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gs_store`
--

DROP TABLE IF EXISTS `gs_store`;
CREATE TABLE IF NOT EXISTS `gs_store` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `url` varchar(255) NOT NULL,
  `ssl` varchar(255) NOT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gs_ticket`
--

DROP TABLE IF EXISTS `gs_ticket`;
CREATE TABLE IF NOT EXISTS `gs_ticket` (
  `ticket_id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon` varchar(125) NOT NULL,
  `matriel_id` int(11) NOT NULL,
  `type_ticket_id` int(11) NOT NULL,
  `date_ticket_open` date NOT NULL,
  `date_ticke_close` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `fiche` varchar(120) NOT NULL,
  `plus_info` text NOT NULL,
  `casse` tinyint(4) NOT NULL,
  `date_transfert_cimf` date DEFAULT NULL,
  `panne` text NOT NULL,
  `traveau` text NOT NULL,
  `date_transfert_casse` date DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `fax_joint` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`ticket_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gs_type_matriel`
--

DROP TABLE IF EXISTS `gs_type_matriel`;
CREATE TABLE IF NOT EXISTS `gs_type_matriel` (
  `type_matriel_id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_type_mariel` varchar(125) DEFAULT NULL,
  `Actif` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`type_matriel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gs_type_ticket`
--

DROP TABLE IF EXISTS `gs_type_ticket`;
CREATE TABLE IF NOT EXISTS `gs_type_ticket` (
  `type_ticket_id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_type_ticket` varchar(125) NOT NULL,
  `Actif` tinyint(4) NOT NULL,
  PRIMARY KEY (`type_ticket_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gs_user`
--

DROP TABLE IF EXISTS `gs_user`;
CREATE TABLE IF NOT EXISTS `gs_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(9) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(96) NOT NULL,
  `image` varchar(255) NOT NULL,
  `code` varchar(45) NOT NULL,
  `matricule` varchar(40) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `gs_profession_profession_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `gs_user_group`
--

DROP TABLE IF EXISTS `gs_user_group`;
CREATE TABLE IF NOT EXISTS `gs_user_group` (
  `user_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `permission` text NOT NULL,
  PRIMARY KEY (`user_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
