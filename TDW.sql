-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 13 jan. 2023 à 03:23
-- Version du serveur : 8.0.27
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetweb22`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Entées'),
(2, 'Plats'),
(3, 'Desserts'),
(4, 'Boissons');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `postID` int NOT NULL,
  `userID` int NOT NULL,
  PRIMARY KEY (`postID`,`userID`),
  KEY `userID` (`userID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `contient`
--

DROP TABLE IF EXISTS `contient`;
CREATE TABLE IF NOT EXISTS `contient` (
  `id` int NOT NULL,
  `recetteID` int DEFAULT NULL,
  `ingredientID` int DEFAULT NULL,
  `quantity` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recetteID` (`recetteID`),
  KEY `ingredientID` (`ingredientID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `contient`
--

INSERT INTO `contient` (`id`, `recetteID`, `ingredientID`, `quantity`) VALUES
(3, 14, 1, '5kg'),
(2, 17, 2, '4kg'),
(4, 14, 1, '5kg');

-- --------------------------------------------------------

--
-- Structure de la table `contientinfos`
--

DROP TABLE IF EXISTS `contientinfos`;
CREATE TABLE IF NOT EXISTS `contientinfos` (
  `ingredientID` int NOT NULL,
  `informationID` int NOT NULL,
  `quantity` int DEFAULT NULL,
  PRIMARY KEY (`ingredientID`,`informationID`),
  KEY `informationID` (`informationID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `contientinfos`
--

INSERT INTO `contientinfos` (`ingredientID`, `informationID`, `quantity`) VALUES
(5, 1, 787),
(5, 2, 8787),
(5, 3, 7887),
(5, 4, 878),
(6, 1, 44),
(6, 2, 44),
(6, 3, 44),
(6, 4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `description` longtext COLLATE latin1_bin,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id`, `name`, `description`, `date`) VALUES
(1, 'El-aid', '[value-3]', '2020-10-10'),
(2, 'Achoura', '[value-3]', '2023-10-12');

-- --------------------------------------------------------

--
-- Structure de la table `information`
--

DROP TABLE IF EXISTS `information`;
CREATE TABLE IF NOT EXISTS `information` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `seuil` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `information`
--

INSERT INTO `information` (`id`, `name`, `seuil`) VALUES
(1, 'lipide', 100),
(2, 'proteine', 70),
(3, 'glucides', 50),
(4, 'vitamine', 70);

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE latin1_bin NOT NULL,
  `healthy` tinyint(1) DEFAULT NULL,
  `season` enum('tous','hiver','automne','printemps','ete') CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `calories` int DEFAULT NULL,
  PRIMARY KEY (`id`,`name`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`id`, `name`, `healthy`, `season`, `calories`) VALUES
(1, 'Tomat rouge', 1, '', 100),
(2, 'Orange noir', 1, '', 50),
(3, 'Orange blue', 0, '', 20),
(4, 'xsxsxs', 1, 'tous', 87),
(5, 'sahbi', 1, 'tous', 8787),
(6, 'dede', 1, 'tous', 564);

-- --------------------------------------------------------

--
-- Structure de la table `like`
--

DROP TABLE IF EXISTS `like`;
CREATE TABLE IF NOT EXISTS `like` (
  `recetteID` int NOT NULL,
  `userID` int NOT NULL,
  PRIMARY KEY (`userID`,`recetteID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `like`
--

INSERT INTO `like` (`recetteID`, `userID`) VALUES
(4, 1),
(5, 1),
(7, 1),
(11, 1),
(15, 1),
(4, 9),
(5, 9),
(9, 9),
(11, 9),
(22, 9),
(25, 9),
(8, 10);

-- --------------------------------------------------------

--
-- Structure de la table `link`
--

DROP TABLE IF EXISTS `link`;
CREATE TABLE IF NOT EXISTS `link` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `type` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `href` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `icon` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `menuID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menuID` (`menuID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `link`
--

INSERT INTO `link` (`id`, `name`, `type`, `href`, `icon`, `menuID`) VALUES
(1, 'Acceuil', 'link', '/', 'null', 1),
(2, 'idées', 'link', '/ideas', 'null', 1),
(3, 'Healthy', 'link', '/healthy', NULL, 1),
(4, 'Saisons', 'link', '/saisons', NULL, 1),
(5, 'fêtes', 'link', '/fetes', NULL, 1),
(6, 'nutrition', 'link', '/nutrition', NULL, 1),
(7, 'contact', 'link', '/contact', NULL, 1),
(8, 'Se Connecter', 'button', '/signUp', '[value-5]', 1);

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int NOT NULL,
  `page` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `logo` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `menu`
--

INSERT INTO `menu` (`id`, `page`, `logo`) VALUES
(1, 'Home', 'logo.png');

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL,
  `tags` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `postID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `postID` (`postID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `description` longtext COLLATE latin1_bin,
  `type` enum('news','recette') COLLATE latin1_bin DEFAULT NULL,
  `coverImage` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `cardImage` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `video` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `event` int DEFAULT NULL,
  `status` enum('valid','pending','rejected') COLLATE latin1_bin DEFAULT NULL,
  `createdBy` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event` (`event`),
  KEY `createdBy` (`createdBy`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `title`, `description`, `type`, `coverImage`, `cardImage`, `video`, `event`, `status`, `createdBy`) VALUES
(17, 'xs', 'xs', '', 'recipe.png', 'recipe.png', 'xs', 2, 'valid', 1),
(18, 'xsxs', 'xsxs', '', '360_F_496507919_qEkorRQUx9MaYiDZr5iwhnZVmxO6eVCe.jpg', 'recipe.png', 'xs', 1, 'pending', 1),
(14, 'Big title here', 'this is the s is the s is the s is the s is the s is thes is the s is the s is the s is the description this is the description this is the description this is the description', '', 'recipe.png', 'recipe.png', 'dede', 0, 'pending', 1),
(15, 'new ', 'recetter', '', 'recipe.png', 'recipe.png', 'de', 1, 'pending', 9),
(16, 'sz', 'sz', '', 'recipe.png', 'recipe.png', 'sz', 1, 'pending', 1),
(19, 'Big title here', 'cdcdcdcdcd', '', '360_F_496507919_qEkorRQUx9MaYiDZr5iwhnZVmxO6eVCe.jpg', 'recipe.png', 'cd', 1, 'pending', 1),
(20, 'xsxs', 'xsxs', '', '8.png', 'recipe.png', 'cd', 1, 'pending', 9),
(21, 'xsxs', 'xsxs', '', '8.png', 'recipe.png', 'cd', 1, 'pending', 1),
(22, 'xsxs', 'xsxs', '', '8.png', 'recipe.png', 'cd', 1, 'pending', 1),
(23, 'xsxs', 'xsxs', '', '8.png', 'recipe.png', 'cd', 1, 'pending', 9),
(24, 'xsxs', 'xsxs', '', '8.png', 'recipe.png', 'cd', 1, 'pending', 1),
(25, 'xsxs', 'xsxs', '', '8.png', 'recipe.png', 'cd', 1, 'pending', 1),
(26, 'xsxs', 'xsxs', '', '8.png', 'recipe.png', 'cd', 1, 'pending', 1),
(27, 'xsxsxs', 'xsxsxsxsxsxsxsxsxsxsxsxsxsxsxsxsxsxsxsxsxsxsxsxsxsxsxsxsxsxs', '', '8.png', 'recipe.png', 'cdcd', 1, 'pending', 1),
(28, 'Recette full name title', 'Unlike its Texan predecessor, Cincinnati Chili has a sweeter flavor, thanks to the use of spices like cinnamon, nutmeg, cloves, allspice, and sometimes even cocoa powder or unsweetened chocolate.\n\nWhile considered a polarizing dish, the regional favorite got quite a bit of attention back in February, when Cincinnati Bengals fans were shotgunning cans of Skyline-branded Cincinnati chili to celebrate the team making it to the Super Bowl.\n\nThe 100-year-old midwestern dish is commonly ordered over spaghetti and topped with some combination of cheddar cheese, diced onion, and red kidney beans. It can also be served with oyster crackers, hot sauce, or poured over a hot dog, called a \"Coney.\"', '', 'recipe3.webp', 'recipe.png', 'cdcd', 1, 'pending', 1),
(29, 'xsxsxs', 'xsxs xsxsxsx sxsx sxsx sxsxsxsxsxsxs xsxsxs xsxs xsxsxsxsx sxsx sxsxs', '', '8.png', 'recipe.png', 'cdcd', 1, 'pending', 1),
(30, 'xsxsxs', 'xsxs xsxsxsx sxsx sxsx sxsxsxsxsxsxs xsxsxs xsxs xsxsxsxsx sxsx sxsxs', '', '8.png', 'recipe.png', 'cdcd', 1, 'pending', 1),
(31, 'xsxsxs', 'xsxs xsxsxsx sxsx sxsx sxsxsxsxsxsxs xsxsxs xsxs xsxsxsxsx sxsx sxsxs', '', '8.png', 'recipe.png', 'cdcd', 1, 'pending', 1),
(32, 'xsxsxs', 'xsxs xsxsxsx sxsx sxsx sxsxsxsxsxsxs xsxsxs xsxs xsxsxsxsx sxsx sxsxs', '', '8.png', 'recipe.png', 'cdcd', 1, 'pending', 1),
(33, 'xsxsxs', 'xsxs xsxsxsx sxsx sxsx sxsxsxsxsxsxs xsxsxs xsxs xsxsxsxsx sxsx sxsxs', '', '8.png', 'recipe.png', 'cdcd', 1, 'pending', 1),
(34, 'xsxsxs', 'xsxs xsxsxsx sxsx sxsx sxsxsxsxsxsxs xsxsxs xsxs xsxsxsxsx sxsx sxsxs', '', '8.png', 'recipe.png', 'cdcd', 1, 'pending', 1),
(35, 'xsxsxs', 'xsxs xsxsxsx sxsx sxsx sxsxsxsxsxsxs xsxsxs xsxs xsxsxsxsx sxsx sxsxs', '', '8.png', 'recipe.png', 'cdcd', 1, 'pending', 1),
(36, 'xsxsxs', 'xsxs xsxsxsx sxsx sxsx sxsxsxsxsxsxs xsxsxs xsxs xsxsxsxsx sxsx sxsxs', '', '8.png', 'recipe.png', 'cdcd', 1, 'pending', 1),
(37, 'xsxsxs', 'xsxs xsxsxsx sxsx sxsx sxsxsxsxsxsxs xsxsxs xsxs xsxsxsxsx sxsx sxsxs', '', '8.png', 'recipe.png', 'cdcd', 1, 'pending', 1),
(38, 'xsxsxs', 'xsxs xsxsxsx sxsx sxsx sxsxsxsxsxsxs xsxsxs xsxs xsxsxsxsx sxsx sxsxs', '', '8.png', 'recipe.png', 'cdcd', 1, 'pending', 1),
(39, 'de', 'de', '', NULL, 'recipe.png', 'de', 1, 'pending', 1),
(40, 'xs', 'xs', '', NULL, 'recipe.png', 'xs', 1, 'pending', 1),
(41, 'de', 'de', '', NULL, 'recipe.png', 'de', 1, 'pending', 1),
(42, 'de', 'de', '', NULL, 'recipe.png', 'de', 1, 'pending', 1),
(43, 'de', 'de', '', NULL, 'recipe.png', 'de', 1, 'pending', 1),
(44, 'de', 'de', '', NULL, 'recipe.png', 'de', 1, 'pending', 1),
(45, 'de', 'de', '', '8.png', 'recipe.png', 'de', 1, 'pending', 1),
(46, 'de', 'de', '', '8.png', 'recipe.png', 'de', 1, 'pending', 1),
(47, 'de', 'de', '', '8.png', 'recipe.png', 'de', 1, 'pending', 1),
(48, 'de', 'de', '', '8.png', 'recipe.png', 'de', 1, 'pending', 1),
(49, 'de', 'de', '', '8.png', 'recipe.png', 'de', 1, 'pending', 1),
(50, 'de', 'de', '', '8.png', 'recipe.png', 'de', 1, 'pending', 1),
(51, 'de', 'de', '', '8.png', 'recipe.png', 'de', 1, 'pending', 1),
(52, 'de', 'de', '', '8.png', 'recipe.png', 'de', 1, 'pending', 1),
(53, 'dede', 'de', '', 'teblette.jpg', 'recipe.png', 'de', 1, 'pending', 1),
(54, 'de', 'de', '', 'Asset 1.png', 'recipe.png', 'de', 1, 'pending', 1);

-- --------------------------------------------------------

--
-- Structure de la table `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `recetteID` int NOT NULL,
  `userID` int NOT NULL,
  `note` int DEFAULT NULL,
  PRIMARY KEY (`userID`,`recetteID`),
  KEY `recetteID` (`recetteID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `rating`
--

INSERT INTO `rating` (`recetteID`, `userID`, `note`) VALUES
(5, 1, 5),
(5, 2, 4),
(17, 1, 3),
(17, 2, 2),
(17, 3, 4),
(4, 3, 5),
(6, 3, 1),
(6, 9, 2),
(17, 9, 4);

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

DROP TABLE IF EXISTS `recette`;
CREATE TABLE IF NOT EXISTS `recette` (
  `id` int NOT NULL AUTO_INCREMENT,
  `preparationTime` int DEFAULT NULL,
  `cookTime` int DEFAULT NULL,
  `restTime` int DEFAULT NULL,
  `categoryID` int DEFAULT NULL,
  `postID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoryID` (`categoryID`),
  KEY `postID` (`postID`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`id`, `preparationTime`, `cookTime`, `restTime`, `categoryID`, `postID`) VALUES
(5, 554, 545, 5454, 2, 14),
(6, 54, 54, 54, 1, 17),
(4, 0, 15, 0, 1, 15),
(7, 2, 2, 2, 2, 18),
(8, 1, 1, 1, 1, 19),
(9, 2, 2, 2, 3, 20),
(10, 2, 2, 2, 3, 21),
(11, 2, 2, 2, 3, 22),
(12, 2, 2, 2, 3, 23),
(13, 2, 2, 2, 3, 24),
(14, 2, 2, 2, 3, 25),
(15, 2, 2, 2, 1, 26),
(16, 3, 3, 2, 4, 27),
(17, 3, 3, 2, 4, 28),
(18, 3, 3, 2, 4, 29),
(19, 3, 3, 2, 1, 30),
(20, 3, 3, 2, 1, 31),
(21, 3, 3, 2, 2, 32),
(22, 3, 3, 2, 2, 33),
(23, 3, 3, 2, 2, 34),
(24, 3, 3, 2, 2, 35),
(25, 3, 3, 2, 4, 36),
(26, 3, 3, 2, 4, 37),
(27, 3, 3, 2, 4, 38),
(28, 2, 2, 2, 1, 39),
(29, 2, 2, 2, 1, 40),
(30, 3, 2, 2, 1, 41),
(31, 3, 2, 2, 1, 42),
(32, 3, 2, 2, 1, 43),
(33, 3, 2, 2, 1, 44),
(34, 3, 2, 2, 1, 45),
(35, 3, 2, 2, 1, 46),
(36, 3, 2, 2, 1, 47),
(37, 3, 2, 2, 1, 48),
(38, 3, 2, 2, 1, 49),
(39, 3, 2, 2, 1, 50),
(40, 3, 2, 2, 1, 51),
(41, 3, 2, 2, 1, 52),
(42, 2, 2, 2, 1, 53),
(43, 2, 2, 2, 4, 54);

-- --------------------------------------------------------

--
-- Structure de la table `save`
--

DROP TABLE IF EXISTS `save`;
CREATE TABLE IF NOT EXISTS `save` (
  `newsID` int NOT NULL,
  `userID` int NOT NULL,
  PRIMARY KEY (`userID`,`newsID`),
  KEY `newsID` (`newsID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `socialmedia`
--

DROP TABLE IF EXISTS `socialmedia`;
CREATE TABLE IF NOT EXISTS `socialmedia` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `icon` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `href` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `menuID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menuID` (`menuID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `socialmedia`
--

INSERT INTO `socialmedia` (`id`, `name`, `icon`, `href`, `menuID`) VALUES
(1, 'facebook', 'facebook.png', '[value-4]', 1),
(2, 'gmail', 'google.png', '[value-4]', 1),
(3, 'youtub', 'youtube.png', '[value-4]', 1),
(4, 'instagram', 'instagram.png', '[value-4]', 1),
(5, 'messenger', 'messenger.png', '[value-4]', 1),
(6, 'whatsapp', 'whatsapp.png', '[value-4]', 1);

-- --------------------------------------------------------

--
-- Structure de la table `step`
--

DROP TABLE IF EXISTS `step`;
CREATE TABLE IF NOT EXISTS `step` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `description` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `recetteID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recetteID` (`recetteID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `step`
--

INSERT INTO `step` (`id`, `title`, `description`, `recetteID`) VALUES
(1, 'first step', 'The content team should provide a document to the ui team in order to start, the UI/UX team will then create forms and send them to GDG and WTM members/managers to collect more ideas.', 17),
(2, 'second step', 'The content team should provide a document to the ui team in order to start, the UI/UX team will then create forms and send them to GDG and WTM members/managers to ', 17),
(3, 'third step', 'The content team should provide a document to the ui team in order to start, the UI/UX team will then create forms and send them to GDG and WTM members/managers to ', 17),
(4, '4th step', 'This the fisert step this is the fiirst step', 17),
(5, '5th step', 'The content team should provide a document to the ui team in order to start, the UI/UX team will then create forms and send them to GDG and WTM members/managers to ', 17);

-- --------------------------------------------------------

--
-- Structure de la table `style`
--

DROP TABLE IF EXISTS `style`;
CREATE TABLE IF NOT EXISTS `style` (
  `id` int NOT NULL,
  `theme` enum('darkMode','lightMode') COLLATE latin1_bin DEFAULT NULL,
  `primaryColor` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `secondaryColor` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `fontFamilly` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `rounded` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `swiper`
--

DROP TABLE IF EXISTS `swiper`;
CREATE TABLE IF NOT EXISTS `swiper` (
  `id` int NOT NULL,
  `type` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `speed` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `swiper`
--

INSERT INTO `swiper` (`id`, `type`, `speed`) VALUES
(1, 'left', 5);

-- --------------------------------------------------------

--
-- Structure de la table `swiperslide`
--

DROP TABLE IF EXISTS `swiperslide`;
CREATE TABLE IF NOT EXISTS `swiperslide` (
  `id` int NOT NULL,
  `image` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `title` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `description` longtext COLLATE latin1_bin,
  `href` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `swiperID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `swiperID` (`swiperID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `swiperslide`
--

INSERT INTO `swiperslide` (`id`, `image`, `title`, `description`, `href`, `swiperID`) VALUES
(1, 'swiperBg1.jpg', 'Get your recipe now!', 'This is the swiper description This is the swiper description This is the swiper description ', '/login', 1),
(2, 'swiperBg2.jpg', 'Get yours now!', 'This is the swiper This is the swiper description This is the swiper description ', '/login', 1),
(3, 'swiperBg3.jpg', 'Get recipe now!', 'This is the swiper description This is the swiper description This is the  ', '/login', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` enum('utilisateur','admin') COLLATE latin1_bin DEFAULT NULL,
  `firstName` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `lastName` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `sex` enum('male','female') COLLATE latin1_bin DEFAULT NULL,
  `status` enum('valid','pending','rejected') COLLATE latin1_bin DEFAULT NULL,
  `password` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `email` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `photo` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `role`, `firstName`, `lastName`, `dateOfBirth`, `sex`, `status`, `password`, `email`, `photo`) VALUES
(1, 'admin', 'admin', 'Sahbi', '0000-00-00', '', 'rejected', 'admin', 'jo_sahbi@esi.dz', 'profile.png'),
(2, '', 'Nedjem eddine', 'Sahbi', '0000-00-00', '', 'pending', '[value-8]', '[value-9]', NULL),
(3, 'utilisateur', 'root', 'xsxs', '2023-01-13', 'male', 'valid', '', 'xsxsx@xs', NULL),
(4, 'utilisateur', 'xs', 'xsxs', '2023-01-13', 'male', 'valid', 'xsxs', 'xsxsx@xs', NULL),
(5, 'utilisateur', 'xsxs', 'xsxs', '2023-01-12', 'male', 'valid', 'xsxs', 'xsxs@xsx', NULL),
(6, 'utilisateur', 'xsxs', 'xxsxs', '2023-01-19', 'male', 'valid', 'xsxs', 'xsx@xsxs', NULL),
(7, 'utilisateur', 'xsxs', 'xsxs', '2023-02-04', 'male', 'pending', 'xsxs', 'xsxs@xsxs', NULL),
(8, 'utilisateur', 'xs', 'xsxs', '2023-01-13', 'male', 'valid', 'xsxs', 'xs@xsxs', NULL),
(9, 'utilisateur', 'Sahbi', 'Ouael nedjme eddine', '2023-01-19', 'male', 'valid', 'dzdz', 'jo_sahbi@esi.dz', NULL),
(10, 'utilisateur', 'sahbi', 'Ouael', '2023-01-12', 'male', 'pending', '123456789', 'Ouael@gmail.com', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
