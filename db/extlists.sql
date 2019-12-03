-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 03 déc. 2019 à 08:47
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `extlists`
--
CREATE DATABASE IF NOT EXISTS `extlists` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `extlists`;

-- --------------------------------------------------------

--
-- Structure de la table `action`
--

DROP TABLE IF EXISTS `action`;
CREATE TABLE IF NOT EXISTS `action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `action` varchar(30) NOT NULL,
  `global` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `action`
--

INSERT INTO `action` (`id`, `name`, `action`, `global`) VALUES
(1, 'Checked', 'checked', 0),
(2, 'Ordered', 'ordered', 0),
(3, 'Labeled', 'labeled', 0);

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(45) DEFAULT NULL,
  `checked` tinyint(1) DEFAULT NULL,
  `value` varchar(45) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `dateC` datetime DEFAULT NULL,
  `dateM` datetime DEFAULT NULL,
  `idSlate` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Item_Slate1_idx` (`idSlate`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id`, `label`, `checked`, `value`, `order`, `dateC`, `dateM`, `idSlate`, `idUser`) VALUES
(7, 'Pain', NULL, NULL, NULL, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `itemproperty`
--

DROP TABLE IF EXISTS `itemproperty`;
CREATE TABLE IF NOT EXISTS `itemproperty` (
  `idItem` int(11) NOT NULL,
  `idProperty` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `value` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idItem`,`idProperty`,`idUser`) USING BTREE,
  KEY `fk_Item_has_Property_Property1_idx` (`idProperty`),
  KEY `fk_Item_has_Property_Item1_idx` (`idItem`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `partage`
--

DROP TABLE IF EXISTS `partage`;
CREATE TABLE IF NOT EXISTS `partage` (
  `iduser` int(11) NOT NULL,
  `idSlate` int(11) NOT NULL,
  PRIMARY KEY (`iduser`,`idSlate`),
  KEY `fk_user_has_Slate_Slate1_idx` (`idSlate`),
  KEY `fk_user_has_Slate_user1_idx` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `partage`
--

INSERT INTO `partage` (`iduser`, `idSlate`) VALUES
(1, 1),
(3, 1),
(4, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `property`
--

DROP TABLE IF EXISTS `property`;
CREATE TABLE IF NOT EXISTS `property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `property`
--

INSERT INTO `property` (`id`, `name`) VALUES
(1, 'color');

-- --------------------------------------------------------

--
-- Structure de la table `slate`
--

DROP TABLE IF EXISTS `slate`;
CREATE TABLE IF NOT EXISTS `slate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `description` text,
  `idUser` int(11) NOT NULL,
  `idTemplate` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Slate_user_idx` (`idUser`),
  KEY `fk_Slate_Template1_idx` (`idTemplate`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `slate`
--

INSERT INTO `slate` (`id`, `title`, `description`, `idUser`, `idTemplate`) VALUES
(1, 'Mes courses', 'Liste pour mes courses a Leclerc', 1, 1),
(2, 'Mes musiques préférées', 'Playlist', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `template`
--

DROP TABLE IF EXISTS `template`;
CREATE TABLE IF NOT EXISTS `template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_name` (`name`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `template`
--

INSERT INTO `template` (`id`, `name`, `description`, `idUser`) VALUES
(1, 'Todo', 'Todo list simple', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `templateaction`
--

DROP TABLE IF EXISTS `templateaction`;
CREATE TABLE IF NOT EXISTS `templateaction` (
  `idTemplate` int(11) NOT NULL,
  `idAction` int(11) NOT NULL,
  PRIMARY KEY (`idTemplate`,`idAction`),
  KEY `fk_Template_has_Action_Action1_idx` (`idAction`),
  KEY `fk_Template_has_Action_Template1_idx` (`idTemplate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `templateaction`
--

INSERT INTO `templateaction` (`idTemplate`, `idAction`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `templateproperty`
--

DROP TABLE IF EXISTS `templateproperty`;
CREATE TABLE IF NOT EXISTS `templateproperty` (
  `idTemplate` int(11) NOT NULL,
  `idProperty` int(11) NOT NULL,
  PRIMARY KEY (`idTemplate`,`idProperty`),
  KEY `fk_Template_has_Property_Property1_idx` (`idProperty`),
  KEY `fk_Template_has_Property_Template1_idx` (`idTemplate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `fname`, `name`, `email`, `password`) VALUES
(1, 'jc', 'JC HERON', 'myaddressmail@gmail.com', '0000'),
(2, 'npriou', 'NATHAN PRIOU', 'priounathan@gmail.com', '12345'),
(3, 'tgoupil', 'THEO GOUPIL', 'theo.goupil@sts-sio-caen.info', '0000'),
(4, 'droyer', 'DAMIEN ROYER', 'damien.royer@sts-sio-caen.info', '0000');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fk_Item_Slate1` FOREIGN KEY (`idSlate`) REFERENCES `slate` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `itemproperty`
--
ALTER TABLE `itemproperty`
  ADD CONSTRAINT `fk_Item_has_Property_Item1` FOREIGN KEY (`idItem`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Item_has_Property_Property1` FOREIGN KEY (`idProperty`) REFERENCES `property` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `itemproperty_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `partage`
--
ALTER TABLE `partage`
  ADD CONSTRAINT `fk_user_has_Slate_Slate1` FOREIGN KEY (`idSlate`) REFERENCES `slate` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_has_Slate_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `slate`
--
ALTER TABLE `slate`
  ADD CONSTRAINT `fk_Slate_Template1` FOREIGN KEY (`idTemplate`) REFERENCES `template` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Slate_user` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `template`
--
ALTER TABLE `template`
  ADD CONSTRAINT `template_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `templateaction`
--
ALTER TABLE `templateaction`
  ADD CONSTRAINT `fk_Template_has_Action_Action1` FOREIGN KEY (`idAction`) REFERENCES `action` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Template_has_Action_Template1` FOREIGN KEY (`idTemplate`) REFERENCES `template` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `templateproperty`
--
ALTER TABLE `templateproperty`
  ADD CONSTRAINT `fk_Template_has_Property_Property1` FOREIGN KEY (`idProperty`) REFERENCES `property` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Template_has_Property_Template1` FOREIGN KEY (`idTemplate`) REFERENCES `template` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
