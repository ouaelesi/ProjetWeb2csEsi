-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 20 jan. 2023 à 09:28
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
  `id` int NOT NULL AUTO_INCREMENT,
  `postID` int DEFAULT NULL,
  `userID` int DEFAULT NULL,
  `commentText` text COLLATE latin1_bin,
  PRIMARY KEY (`id`),
  KEY `userID` (`userID`),
  KEY `postID` (`postID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `postID`, `userID`, `commentText`) VALUES
(1, 49, 1, 'This is the fisrt comment from ouael '),
(2, 49, 1, 'This is the second comment from me again\r\n'),
(3, 49, 2, 'this is the third comment '),
(4, 49, 2, 'the fourth one '),
(5, 53, 2, 'ggvggv'),
(6, 52, 2, 'hbhbhh'),
(7, 50, 2, 'szsz'),
(8, 47, 2, 'gfgf'),
(9, 59, 2, 'commentaire'),
(10, 61, 2, 'comment \r\n'),
(11, 63, 1, 'Couskous 100_/');

-- --------------------------------------------------------

--
-- Structure de la table `contient`
--

DROP TABLE IF EXISTS `contient`;
CREATE TABLE IF NOT EXISTS `contient` (
  `id` int NOT NULL AUTO_INCREMENT,
  `recetteID` int DEFAULT NULL,
  `ingredientID` int DEFAULT NULL,
  `quantity` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recetteID` (`recetteID`),
  KEY `ingredientID` (`ingredientID`)
) ENGINE=MyISAM AUTO_INCREMENT=120 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `contient`
--

INSERT INTO `contient` (`id`, `recetteID`, `ingredientID`, `quantity`) VALUES
(10, 47, 13, '10 cl'),
(11, 47, 12, '1 pincée'),
(12, 47, 10, '3'),
(13, 47, 8, '200 g'),
(14, 47, 11, '10 cl'),
(15, 47, 14, '100 g'),
(16, 47, 16, '200 g'),
(17, 47, 17, '150 g'),
(98, 48, 18, '20g'),
(101, 59, 62, '2'),
(100, 48, 22, '1'),
(21, 48, 19, '1 petit'),
(22, 48, 23, '1 cuillère à soupe'),
(23, 49, 24, '250g'),
(24, 49, 10, '1'),
(25, 49, 25, '50g'),
(26, 49, 8, '50g'),
(27, 49, 26, ' '),
(28, 50, 8, '180g'),
(29, 50, 24, '1 boule'),
(30, 50, 10, '2'),
(31, 50, 11, '1 verre'),
(32, 50, 12, '1 sachet'),
(33, 50, 14, '1 poignée'),
(34, 50, 27, '100g'),
(35, 50, 15, '1 shachet'),
(36, 51, 28, '4'),
(37, 51, 24, '250g'),
(38, 51, 22, '2'),
(39, 51, 29, '20 cl'),
(40, 51, 30, '50g'),
(41, 51, 13, '5 cuillères à soupe'),
(42, 51, 31, '1 cuillère à soupe'),
(43, 51, 32, 'Quelques feuilles'),
(44, 52, 33, '5'),
(45, 52, 35, '50g'),
(46, 52, 36, '30g'),
(47, 53, 37, '50g'),
(48, 53, 38, '2 c.à.c'),
(49, 53, 44, '30 cl'),
(50, 53, 39, ' '),
(51, 53, 19, '2'),
(52, 53, 42, '500g'),
(53, 53, 41, '1 c.a.c'),
(54, 53, 22, '65g'),
(55, 54, 37, '30g'),
(56, 54, 8, '1 c.à.c rase'),
(57, 54, 45, ' '),
(58, 54, 12, ' '),
(59, 54, 39, ' '),
(60, 54, 46, '4L'),
(61, 54, 19, '2'),
(62, 55, 37, '100 g'),
(63, 55, 12, '1 pincée'),
(64, 55, 47, '1 pot'),
(65, 55, 48, '1'),
(66, 55, 52, '400 g'),
(67, 55, 51, '500 g'),
(68, 55, 50, '5 cuillères'),
(69, 55, 49, '1 pincée'),
(70, 56, 8, '3 mesures'),
(71, 56, 37, '1 mesure'),
(72, 56, 54, '1 sac'),
(73, 56, 10, '2'),
(74, 56, 15, '1/2 paquet'),
(75, 56, 55, 'Extrait  de'),
(76, 56, 58, '1/2 mesure'),
(77, 56, 49, '1 sac'),
(78, 56, 57, ' '),
(79, 57, 59, '4'),
(80, 57, 53, '2 littres'),
(81, 57, 58, '100 a 150 g'),
(82, 57, 60, '2 cuillères ou 3 a soupe'),
(88, 58, 61, '1'),
(89, 58, 62, '1'),
(90, 58, 59, '1'),
(91, 58, 58, '2'),
(92, 58, 63, '1 c.a.s'),
(102, 59, 58, '10g'),
(103, 59, 53, '10cl'),
(104, 60, 64, '2'),
(105, 60, 58, '20g'),
(106, 60, 53, '40cl'),
(107, 61, 22, '200g'),
(108, 61, 53, '40cl'),
(109, 61, 58, '20g'),
(110, 62, 65, '500g'),
(111, 62, 37, '250g'),
(112, 62, 56, '1 c-soupe'),
(113, 62, 49, ' '),
(114, 62, 66, 'quelques'),
(115, 63, 67, ' '),
(116, 63, 33, '2'),
(117, 63, 12, ' '),
(118, 63, 22, '2'),
(119, 63, 49, ' ');

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
(8, 1, 50),
(8, 2, 70),
(8, 3, 80),
(8, 4, 50),
(9, 1, 50),
(9, 2, 70),
(9, 3, 80),
(9, 4, 50),
(10, 1, 20),
(10, 2, 100),
(10, 3, 100),
(10, 4, 50),
(11, 1, 20),
(11, 2, 400),
(11, 3, 51),
(11, 4, 51),
(12, 1, 500),
(12, 2, 50),
(12, 3, 100),
(12, 4, 100),
(13, 1, 30),
(13, 2, 21),
(13, 3, 30),
(13, 4, 30),
(14, 1, 54),
(14, 2, 51),
(14, 3, 5),
(14, 4, 331),
(15, 1, 51),
(15, 2, 54),
(15, 3, 54),
(15, 4, 54),
(16, 1, 21),
(16, 2, 54),
(16, 3, 54),
(16, 4, 21),
(17, 1, 12),
(17, 2, 21),
(17, 3, 12),
(17, 4, 12),
(18, 1, 20),
(18, 2, 200),
(18, 3, 10),
(18, 4, 20),
(19, 1, 14),
(19, 2, 51),
(19, 3, 21),
(19, 4, 21),
(20, 1, 17),
(20, 2, 14),
(20, 3, 19),
(20, 4, 15),
(21, 1, 16),
(21, 2, 15),
(21, 3, 17),
(21, 4, 13),
(22, 1, 15),
(22, 2, 15),
(22, 3, 17),
(22, 4, 19),
(23, 1, 15),
(23, 2, 155),
(23, 3, 15),
(23, 4, 15),
(24, 1, 54),
(24, 2, 65),
(24, 3, 48),
(24, 4, 94),
(25, 1, 87),
(25, 2, 84),
(25, 3, 97),
(25, 4, 97),
(26, 1, 97),
(26, 2, 54),
(26, 3, 84),
(26, 4, 62),
(27, 1, 20),
(27, 2, 15),
(27, 3, 10),
(27, 4, 16),
(28, 1, 16),
(28, 2, 15),
(28, 3, 16),
(28, 4, 16),
(29, 1, 40),
(29, 2, 40),
(29, 3, 50),
(29, 4, 50),
(30, 1, 54),
(30, 2, 48),
(30, 3, 48),
(30, 4, 64),
(31, 1, 15),
(31, 2, 15),
(31, 3, 15),
(31, 4, 15),
(32, 1, 4),
(32, 2, 4),
(32, 3, 12),
(32, 4, 7),
(33, 1, 54),
(33, 2, 54),
(33, 3, 5),
(33, 4, 54),
(34, 1, 31),
(34, 2, 47),
(34, 3, 54),
(34, 4, 64),
(35, 1, 51),
(35, 2, 97),
(35, 3, 5),
(35, 4, 3),
(36, 1, 7),
(36, 2, 9),
(36, 3, 7),
(36, 4, 3),
(37, 1, 455),
(37, 2, 54),
(37, 3, 5),
(37, 4, 4),
(38, 1, 4),
(38, 2, 40),
(38, 3, 5),
(38, 4, 5),
(39, 1, 54),
(39, 2, 4),
(39, 3, 4),
(39, 4, 4),
(40, 1, 4),
(40, 2, 44),
(40, 3, 4),
(40, 4, 4),
(41, 1, 4),
(41, 2, 4),
(41, 3, 4),
(41, 4, 4),
(42, 1, 4),
(42, 2, 4),
(42, 3, 4),
(42, 4, 4),
(43, 1, 44),
(43, 2, 444),
(43, 3, 4),
(43, 4, 4),
(44, 1, 11),
(44, 2, 111),
(44, 3, 1),
(44, 4, 1),
(45, 1, 54),
(45, 2, 4),
(45, 3, 54),
(45, 4, 45),
(46, 1, 54),
(46, 2, 45),
(46, 3, 4),
(46, 4, 4),
(47, 1, 10),
(47, 2, 65),
(47, 3, 51),
(47, 4, 51),
(48, 1, 54),
(48, 2, 32),
(48, 3, 87),
(48, 4, 98),
(49, 1, 87),
(49, 2, 54),
(49, 3, 87),
(49, 4, 65),
(50, 1, 45),
(50, 2, 98),
(50, 3, 78),
(50, 4, 87),
(51, 1, 9),
(51, 2, 54),
(51, 3, 8),
(51, 4, 7),
(52, 1, 9),
(52, 2, 3),
(52, 3, 7),
(52, 4, 5),
(53, 1, 8),
(53, 2, 4),
(53, 3, 4),
(53, 4, 4),
(54, 1, 45),
(54, 2, 54),
(54, 3, 4),
(54, 4, 9),
(55, 1, 455),
(55, 2, 54),
(55, 3, 5),
(55, 4, 5),
(56, 1, 5),
(56, 2, 4),
(56, 3, 5),
(56, 4, 5),
(57, 1, 54),
(57, 2, 45),
(57, 3, 45),
(57, 4, 45),
(58, 1, 45),
(58, 2, 454),
(58, 3, 54),
(58, 4, 4),
(59, 1, 55),
(59, 2, 4),
(59, 3, 44),
(59, 4, 4),
(60, 1, 4),
(60, 2, 44),
(60, 3, 44),
(60, 4, 4),
(61, 1, 4),
(61, 2, 4),
(61, 3, 8),
(61, 4, 45),
(62, 1, 6),
(62, 2, 5),
(62, 3, 54),
(62, 4, 54),
(63, 1, 8),
(63, 2, 6),
(63, 3, 7),
(63, 4, 3),
(64, 1, 221),
(64, 2, 13),
(64, 3, 13),
(64, 4, 15),
(65, 1, 12),
(65, 2, 13),
(65, 3, 17),
(65, 4, 19),
(66, 1, 54),
(66, 2, 4),
(66, 3, 4),
(66, 4, 4),
(67, 1, 4),
(67, 2, 45),
(67, 3, 14),
(67, 4, 5),
(68, 1, 4),
(68, 2, 4),
(68, 3, 4),
(68, 4, 4);

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
(2, 'Achoura', '[value-3]', '2023-10-12'),
(3, 'Ramadan', 'description for ramadan', '0000-00-00'),
(4, 'Mouloud', 'mouloud', '0000-00-00'),
(0, 'No event', '[value-3]', '0000-00-00');

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
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`id`, `name`, `healthy`, `season`, `calories`) VALUES
(13, 'Huile d\'olive', 1, 'tous', 55),
(12, 'Sel', 1, 'tous', 50),
(11, 'Lait chaud', 1, 'ete', 500),
(8, 'farine', 0, 'tous', 500),
(10, 'Ouef', 1, 'tous', 600),
(14, 'Gruyère râpé', 0, 'tous', 54),
(15, 'Levure chimique', 1, 'tous', 54),
(16, 'Lardon', 1, 'tous', 54),
(17, ' Olive verte', 0, 'tous', 54),
(18, ' Maïs', 1, 'ete', 100),
(19, 'Oignon', 1, 'tous', 41),
(20, 'Échalote', 1, 'hiver', 15),
(21, 'Concombre', 1, 'tous', 15),
(22, 'Tomate', 1, 'hiver', 15),
(23, 'Mayonnaise', 0, 'tous', 200),
(24, 'Mozzarella', 0, 'tous', 45),
(25, 'Chapelure', 0, 'tous', 51),
(26, 'Huile', 0, 'tous', 54),
(27, 'Chorizo', 0, 'tous', 41),
(28, 'Aubergines', 1, 'tous', 15),
(29, 'Coulis de tomates', 1, 'tous', 40),
(30, 'Parmesan', 1, 'tous', 47),
(31, 'Origan', 1, 'ete', 15),
(32, 'Basilic', 1, 'ete', 5),
(33, 'pommes de terre', 1, 'ete', 54),
(34, 'pommes de terre', 1, 'ete', 54),
(35, 'sauce barbecue', 0, 'tous', 54),
(36, 'gouda', 1, 'tous', 4),
(37, 'beurre', 0, 'tous', 54),
(38, 'cumin en poudre', 0, 'tous', 54),
(39, 'poivre', 1, 'tous', 54),
(40, 'gousses', 1, 'tous', 54),
(41, 'chili en poudre', 0, 'tous', 54),
(42, 'boeuf haché', 1, 'tous', 54),
(43, 'haricots rouges', 1, 'tous', 54),
(44, 'bouillon de boeuf', 1, 'tous', 54),
(45, 'persil', 1, 'ete', 5),
(46, 'moules', 1, 'tous', 54),
(47, 'miel', 1, 'tous', 200),
(48, 'huile de friture', 0, 'tous', 54),
(49, 'cannelle', 1, 'tous', 54),
(50, 'café d\'eau de fleur d\'oranger', 1, 'tous', 54),
(51, 'pâte de dattes', 1, 'tous', 87),
(52, 'blé', 1, 'tous', 8),
(53, 'eau', 1, 'tous', 4),
(54, 'sucre en poudre', 0, 'tous', 54),
(55, 'vanille', 0, 'tous', 54),
(56, 'Eau de fleur d’oranger', 0, 'tous', 54),
(57, 'Sucre glace', 0, 'tous', 54),
(58, 'sucre', 0, 'tous', 545),
(59, 'citron', 1, 'automne', 4),
(60, 'eau de fleur', 1, 'tous', 44),
(61, 'Ananas', 1, 'ete', 5),
(62, 'orange', 1, 'tous', 54),
(63, 'café de gingembre', 1, 'tous', 4),
(64, 'kiwi', 1, 'ete', 14),
(65, 'semoule', 1, 'tous', 15),
(66, 'amandes émondées', 0, 'tous', 44),
(67, 'viande', 1, 'tous', 54),
(68, 'pommes de terre', 1, 'printemps', 4);

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
(49, 1),
(47, 2),
(49, 2),
(50, 2),
(57, 2),
(59, 2),
(47, 10),
(52, 10),
(53, 10);

-- --------------------------------------------------------

--
-- Structure de la table `link`
--

DROP TABLE IF EXISTS `link`;
CREATE TABLE IF NOT EXISTS `link` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `type` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `href` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `icon` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `menuID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menuID` (`menuID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `link`
--

INSERT INTO `link` (`id`, `name`, `type`, `href`, `icon`, `menuID`) VALUES
(1, 'Acceuil', 'link', '/', 'null', 1),
(2, 'idées', 'link', '/ideas', 'null', 1),
(4, 'Healthy', 'link', '/healthy?seuil=0.5', NULL, 1),
(5, 'Saisons', 'link', '/saisons?season=hiver&limit=10', NULL, 1),
(6, 'fêtes', 'link', '/fetes', NULL, 1),
(7, 'nutrition', 'link', '/nutritions', NULL, 1),
(8, 'contact', 'link', '/contact', NULL, 1),
(9, 'Se Connecter', 'button', '/login', '[value-5]', 1),
(3, 'News', 'link', '/news', '[value-5]', 1);

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
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userID` int DEFAULT NULL,
  `subject` text COLLATE latin1_bin,
  `body` text COLLATE latin1_bin,
  PRIMARY KEY (`id`),
  KEY `userID` (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `userID`, `subject`, `body`) VALUES
(5, 2, 'My message subjects ', 'This is the message this is the message'),
(7, 1, 'un message 2', 'this is the message of ouael sahbi to the adin\n');

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tags` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `postID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `postID` (`postID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`id`, `tags`, `postID`) VALUES
(4, 'burger, recipes, cheese, Fastfood', 71),
(3, 'poulet, recette , blog', 70),
(5, 'légumes, griller , recettes', 82),
(6, 'antipasti, recette, article', 83);

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
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `title`, `description`, `type`, `coverImage`, `cardImage`, `video`, `event`, `status`, `createdBy`) VALUES
(58, 'Cake aux olives, jambon et fromage', 'Savourez ce cake aux olives, jambon et fromage. Une recette familiale à petit prix et facile de cake salé idéal pour un pique-nique ensoleillé ! En fromage j\'utilise souvent le gruyère ou le comté.', 'recette', 'recipe.png', 'recipe.png', 'https://www.youtube.com/embed/CA6uSRKayE4\" title=\"YouTube video player', 0, 'valid', 3),
(59, 'Salade de maïs', 'Une salade minceur toute en couleurs composée de nombreux légumes pour se faire plaisir.', 'recette', 'Saladedemais-1000x500.jpg', 'Saladedemais-1000x500.jpg', 'https://www.youtube.com/embed/6ozj3CoOx7E', 0, 'valid', 1),
(60, 'Sticks de mozzarella panée', 'De délicieux bâtonnets de mozzarella panée et croustillants à déguster bien chauds à l\'apéritif !\r\n\r\nConseils : \r\nPréparez cette recette au dernier moment pour servir les bâtonnets de mozzarella bien croustillants et fondants en bouche. Vos invités vont se régaler à l\'apéritif ! Vous pouvez aussi préparer ces sticks de mozza pour un dîner sur le pouce et les accompagner d\'une salade verte. ', 'recette', 'i19565-batonnets-de-mozzarella-frits.jpg', 'i19565-batonnets-de-mozzarella-frits.jpg', 'https://www.youtube.com/embed/BIzt77gLDPw', 0, 'valid', 1),
(61, 'Cake au chorizo et à la mozzarella', 'Un cake coloré pour un super apéritif. Il sent bon l\'été !', 'recette', 'Cake-Mozza-Chorizo.jpg', 'Cake-Mozza-Chorizo.jpg', 'https://www.youtube.com/embed/8aQ80diZpTI', 0, 'valid', 1),
(62, 'Aubergines à la mozzarella', ' Un plat familial et convivial super facile à préparer et surtout tellement délicieux. Un gratin d’aubergines à la mozzarella agréablement parfumé au basilic.  Une recette que j’ai préparé plusieurs fois et toute la famille était satisfaite.', 'recette', '34704_w1024h576c1cx2736cy1824.jpg', '34704_w1024h576c1cx2736cy1824.jpg', 'https://www.youtube.com/embed/_Ii4eqsyDZY\" title=\"YouTube video player', 0, 'pending', 1),
(63, 'Poutine typiquement québécoise', 'La poutine est un plat québécois typique très apprécié dans la belle province. Bien que récent, les premières recettes datent des années 1960, la poutine est en quelque sorte le plat traditionnel national du Québec. Très prisé en hiver par grand froid, il a le mérite de bien caler les estomacs.', 'recette', 'poutine entête.jpg', 'poutine entête.jpg', 'https://www.youtube.com/embed/J8SFe_CJA5w', 0, 'valid', 1),
(64, 'Chili con carne facile', 'Le chili con carne (chili à la viande) est une sorte de ragoût de viande(s) épicé originaire du sud des États-Unis dont les ingrédients essentiels de la variante la plus connue sont la viande de bœuf et le chili ', 'recette', '126214_w1024h576c1cx1124cy721.webp', '126214_w1024h576c1cx1124cy721.webp', 'https://www.youtube.com/embed/wPWpmEIM37U', 0, 'pending', 1),
(65, 'Moules marinières', 'Les moules marinières ou moules à la marinière sont une spécialité culinaire traditionnelle à base de moules préparées avec une sauce marinière (beurre, échalotes, vin blanc, persil).', 'recette', 'moules-marinieres-61458-1.jpg', 'moules-marinieres-61458-1.jpg', 'https://www.youtube.com/embed/aOnIzGZKzx4', 0, 'valid', 1),
(70, 'La meilleure façon de faire mariner du poulet', 'Avant, je pensais que les marinades ne servaient à rien. Ou pour être plus précise, je n\'étais pas trop sûre de ce qu\'elles apportent à un plat en matière de saveurs –ce qui est probablement imputable à mon engouement débordant pour la moutarde au miel lorsque j\'étais jeune. Je ne savais pas trop comment ni pourquoi l\'utiliser pour conserver l\'humidité d\'une viande ou d\'un poisson alors que la saumure à sec (ou salage) suffisait largement. Du coup, le plus souvent, je passais mon tour.\r\n\r\nEt puis il y a quelques années, Eric, un collègue, m\'a fait goûter un bout de son saumon. Jamais je n\'avais connu une telle expérience: cette bouchée était plus juteuse qu\'une pêche, alors que le poisson était cuit au point de se défaire; sa saveur était uniforme, pas juste en surface. Il était en train de mettre au point une recette de saumon mariné et tous les jours, pendant quelques semaines, j\'ai eu droit à un échantillon de son plat, chaque fois un peu modifié. Chaque bouchée de s\'avérait meilleure que la précédente. Et je suis tombée dedans.\r\n\r\nJe me suis lancée à tâtons. J\'ai commencé avec Harold McGee, prolifique ingénieur agroalimentaire, pour analyser le véritable objectif et la définition de la chose. «Les marinades sont des liquides acides, à base de vinaigre à l\'origine, et qui comprennent aujourd\'hui des ingrédients comme du vin, des jus de fruit, du lait de baratte et du yaourt, dans lesquels le cuisinier immerge la nourriture pendant plusieurs heures, voire plusieurs jours, avant de la cuire», écrit-il dans On Food and Cooking. «Elles sont utilisées depuis la Renaissance, lorsque leur fonction première était de ralentir la décomposition et de donner du goût. Aujourd\'hui, les viandes sont avant tout marinées pour être aromatisées, moins sèches et plus tendres.»\r\n\r\nÀ partir de là, j\'avoue être devenue un tantinet obsédée. Je me suis lancée dans cette pratique sans doute plus qu\'il n\'était raisonnable, allant même jusqu\'à faire mariner une unique coquille Saint-Jacques dans une mixture composée de six ingrédients différents. Mais peu importent les détails. Ce qui compte, c\'est que lorsqu\'on m\'a demandé de tester autant de marinades pour poulet que mon (minuscule) réfrigérateur pouvait en contenir, j\'ai répondu tellement vite par l\'affirmative que je me suis foulé le pouce gauche. Voilà ce que ça a donné.', 'news', 'sophia-louw-w5l0ongixf4-unsplash.jpg', 'sophia-louw-w5l0ongixf4-unsplash.jpg', 'https://www.youtube.com/embed/H6boThcfNS4', 2, 'pending', 1),
(71, 'La meilleure façon de faire les cheeseburgers', 'Au 1500 West Colorado Boulevard à Pasadena, en Californie –un lieu qui, par ailleurs, ne paie pas de mine–, si vous baissez les yeux, vous serez peut-être surpris de trouver la plaque suivante: «Sur ce site, en 1924, Lionel Sternberger, âgé de 16 ans, a mis pour la première fois du fromage sur un hamburger et l\'a servi à un client, inventant ainsi le cheeseburger.»\r\n\r\nL\'endroit est connu sous le nom de «Rite Spot», du nom d\'une entreprise aujourd\'hui disparue où Lionel Sternberger retournait des steaks et construisait des tours de pain et de tranches de charcuterie. L\'histoire raconte que l\'adolescent travaillait à la sandwicherie quand, un jour, il décida de tenter une expérience en insérant une tranche de fromage dans un burger. Selon d\'autres témoignages, Lionel Sternberger aurait utilisé le fromage pour recouvrir un burger mal cuit. Quelle que soit la vérité, près de cent ans se sont écoulés depuis ce fatidique premier cheeseburger. Depuis, il n\'a cessé de se réinventer.\r\n\r\nIl existe des burgers épais, minces, des smash burgers (le steak est écrasé froid sur une plaque brûlante), à deux étages (double-deckers) et des burgers de type «diner» (servis dans les restaurants américains). Ils peuvent être garnis d\'agneau, de lentilles ou de ce qui vous plaira. Ils sont servis sur des petits pains à la fécule de pomme de terre, au sésame, des muffins anglais, ou enveloppés dans des feuilles de laitue. Un jour, dans un aéroport, on m\'a servi un cheeseburger sur un demi-toast!\r\n\r\nQuelle que soit votre recette, elle doit cocher certaines cases: une viande savoureuse, un fromage fondant, un pain qui s\'imbibe bien et des garnitures qui complètent sans voler la vedette. Alors, comment obtenir le résultat parfait? C\'est ce que nous allons voir.', 'news', 'pexels-daniel-reche-3616956.jpg', 'pexels-daniel-reche-3616956.jpg', 'https://www.youtube.com/embed/4ZlZ9iFelW8', 0, 'pending', 1),
(72, 'Makrout', 'Le makroud ou makrout, également orthographié maqroudh ou maqrouth (en arabe : ??????? et ??????? ; en berbère : ?????? et ??????), est une pâtisserie maghrébine, à base de semoule de blé et de pâte de dattes, reconnaissable à sa forme en losange. C\'est une pâtisserie très populaire au Maghreb (Algérie1, Maroc, Libye et Tunisie2) et également à Malte.', 'recette', '0c9b61793ff84cb51a6d0b8b48ef88ff.jpg', '0c9b61793ff84cb51a6d0b8b48ef88ff.jpg', 'https://www.youtube.com/embed/MoVjYPKO6x4', 1, 'valid', 1),
(73, 'CORNES DE GAZELLES ALGÉRIENNES', 'Tcharek Msaker est un gâteau algérien, des cornes de gazelles enrobées de sucre glace farcies aux amandes que l’on prépare souvent pour les fêtes de l’Aid et autres cérémonies en Algérie.', 'recette', '1650875366.jpg', '1650875366.jpg', 'https://www.youtube.com/embed/csuMFvXAJFs', 1, 'pending', 3),
(74, 'Cherbet, citronnade Algerienne', 'La cherbet ou sherbet est une citronnade algérienne présente sur toutes les tables durant le mois de ramadan. La meilleure cherbet est celle de la ville de Boufarik dont la recette reste secrète. C’est notre boisson préférée, elle s’est répandu sur tout le territoire algérien et se vend sur toutes les rues d’Alger.', 'recette', 'i146291-cherbet.jpg', 'i146291-cherbet.jpg', 'https://www.youtube.com/embed/8dsTYocXHPM', 3, 'pending', 1),
(76, 'Jus d\'ananas', 'Les enfants adorent les jus de fruits sucrés et ont du mal avec les jus amers ou acides. Cette recette de jus de fruits frais est donc parfaite pour combler les petits bouts : elle ne contient que de la pomme et de l’ananas.\r\n\r\n', 'recette', 'Recette-jus-fruit-frais5.jpg', 'Recette-jus-fruit-frais5.jpg', 'https://www.youtube.com/embed/cp9E1-Q3usc', 0, 'valid', 1),
(77, 'Jus d\'orange', 'Cette recette est pour 200 ml de jus d\'orange', 'recette', 'jus-d-orange-presse_289335989_ban.webp', 'jus-d-orange-presse_289335989_ban.webp', 'https://www.youtube.com/embed/E5wOp4vR6vE', 0, 'valid', 2),
(78, 'Jus de kiwi', 'Vert ou golden, le kiwi est un petit fruit qui nous apporte beaucoup, et notamment de la vitamine C. Alors on prépare un jus pour profiter de toutes ses qualités : voici notre recette de jus de kiwi à l\'extracteur de jus.', 'recette', 'Recette-jus-fruit-frais2.jpg', 'Recette-jus-fruit-frais2.jpg', 'https://www.youtube.com/embed/frmJZvgSvUw', 0, 'pending', 2),
(79, 'Jus de tomates', 'Tout le monde a déjà goûté au moins une fois au jus de tomate ! Mais avez-vous déjà testé un jus préparé avec des tomates fraîchement pressées ? Incomparable avec un jus en bouteille acheté dans le commerce. Nous vous donnons la recette du jus de tomates à l\'extracteur de jus, essayez et comparez !', 'recette', 'Recette-jus-fruit-frais7.jpg', 'Recette-jus-fruit-frais7.jpg', 'https://www.youtube.com/embed/MMroIuAJTyY', 0, 'pending', 2),
(80, 'Tamina', 'A l’occasion du Mouloud (Mawlid nabawi cherif) je vous poste la recette basique de Tamina ou Tammina appelée  aussi taknatta.', 'recette', 'photo.png', 'photo.png', 'https://www.youtube.com/embed/GkB38BgJ7nI', 4, 'pending', 2),
(81, 'Couscous algérien', 'A la maison, le couscous algérien c’est chaque dimanche, parfois je prépare le couscous aux légumes, d’autres fois au poulet. Mais celui que je préfère c’est le couscous kabyle el mesfouf aux fèves et petits pois arrose d’un bon filet d’huile d’olive et accompagne d’un bon verre de lben (babeurre)… le bonheur !!!', 'recette', 'galettes-couscous-trois-delices-venus-dalgerie.jpg', 'galettes-couscous-trois-delices-venus-dalgerie.jpg', 'https://www.youtube.com/embed/fPmK8fD1Cf0', 2, 'pending', 2),
(82, 'La meilleure façon de faire griller les légumes', 'Quand je ne suis pas préposée au gril, je regarde faire, sans pouvoir détacher mes yeux de l\'appareil (à voir si vos photos de vacances me font le même effet.) Cuisiner sur la braise m\'a toujours fascinée, peut-être parce que j\'ai été élevée par un père qui a abandonné le culte religieux officiel pour celui du barbecue, ou bien parce qu\'une bouchée de poitrine de porc dorée à la perfection est une expérience universellement transcendantale. Et contrairement au voisin qui me raconte comment il s\'est rompu le talon d\'Achille, le gril n\'est jamais à court de moyens de me surprendre lors d\'une soirée grillades.\r\n\r\nParlons des légumes d\'été. Chacun d\'entre eux a un type de saveur et une texture différents; chacun exige son propre protocole de cuisson. Pour cet article, je me suis concentrée uniquement sur le gril au gaz, bien qu\'il existe évidemment de nombreux appareils (peut-être meilleurs) qui permettent d\'obtenir des légumes merveilleusement tendres, comme les grils au bois, au charbon de bois (comme le Weber de base, ou comme le barbecue kamado), les barbecues hibachi, les grils à pellets, etc.', 'news', 'pexels-askar-abayev-5637760.jpg', 'pexels-askar-abayev-5637760.jpg', 'https://www.youtube.com/embed/AMJ3uZcRwho', 0, 'pending', 1),
(83, 'Arrêtons les mensonges sur les antipasti', 'J\'ai toujours été un peu gêné par les idées reçues sur la gestuelle italienne, mais je dois avouer que j\'ai lâché l\'affaire. Dans ce cas-là, au moins, toutes les légendes sont vraies.\r\n\r\nEn particulier, il y a un geste que je fais beaucoup, et qui est très consensuel et compris par tout le monde. Le geste est le suivant: il s\'agit de courber la main, avec les doigts orientés vers le bas. Puis on tourne la main, comme pour dessiner des petits cercles imaginaires, et c\'est là que les problèmes commencent. Car, ce geste, dans l\'italien kinésique, veut dire deux choses complètement différentes.\r\n\r\nLe premier usage sert à évoquer des pratiques obscures, pas forcément illicites mais qui impliquent une intrigue, où quelqu\'un s\'est mis d\'accord avec quelqu\'un d\'autre en secret. Comme pour dire à son interlocuteur «voilà, tu sais comment ça se passe». Le second usage, au contraire, s\'applique uniquement quand on est au restaurant ou dans une trattoria, quand on s\'apprête à passer la commande. Dans ce cas, la main plane et tourne de haut sur la table, pour indiquer –sans possibilité de malentendu– qu\'on aimerait bien d\'abord partager une petite sélection d\'antipasti.\r\n\r\nCe geste a fait l\'objet d\'un mème assez populaire, que je regarde souvent, pour reprendre un peu de bonne humeur, dans les moments où la nuit est sombre. Le personnage qui fait le geste s\'appelle Paolo Gentiloni, ancien Premier ministre et –depuis quelques heures seulement– membre italien auprès de la Commission européenne.', 'news', 'rare.png', 'rare.png', 'https://www.youtube.com/embed/HD8-ySA9e3U', 0, 'pending', 1);

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
(48, 10, 3),
(54, 1, 3),
(54, 2, 2),
(49, 2, 4),
(47, 2, 4),
(50, 2, 5),
(51, 2, 2),
(53, 2, 2),
(52, 2, 1),
(57, 2, 4),
(59, 2, 2),
(60, 2, 2),
(61, 2, 3),
(63, 1, 4),
(50, 1, 2);

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
  `difficulty` enum('tres facile','facile','moyenne','difficile','tres difficile') CHARACTER SET latin1 COLLATE latin1_bin DEFAULT 'facile',
  `cookMethode` enum('Bouillir','Vapeur','Frire','Griller','Cuire au four','Rôtir','Glacer','Etuver') COLLATE latin1_bin DEFAULT 'Bouillir',
  PRIMARY KEY (`id`),
  KEY `categoryID` (`categoryID`),
  KEY `postID` (`postID`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`id`, `preparationTime`, `cookTime`, `restTime`, `categoryID`, `postID`, `difficulty`, `cookMethode`) VALUES
(47, 15, 45, 15, 1, 58, 'facile', 'Bouillir'),
(48, 10, 0, 1, 2, 59, 'facile', 'Bouillir'),
(49, 10, 15, 10, 1, 60, 'facile', 'Bouillir'),
(50, 10, 25, 10, 1, 61, 'facile', 'Bouillir'),
(51, 15, 10, 10, 1, 62, 'facile', 'Bouillir'),
(52, 25, 15, 5, 2, 63, 'facile', 'Bouillir'),
(53, 35, 20, 10, 2, 64, 'facile', 'Bouillir'),
(54, 60, 30, 10, 2, 65, 'facile', 'Bouillir'),
(55, 60, 55, 60, 3, 72, 'facile', 'Bouillir'),
(56, 30, 25, 20, 3, 73, 'facile', 'Bouillir'),
(57, 15, 0, 15, 4, 74, 'facile', 'Bouillir'),
(58, 10, 0, 5, 4, 76, 'tres facile', 'Glacer'),
(59, 10, 0, 5, 4, 77, 'tres facile', 'Glacer'),
(60, 15, 0, 5, 4, 78, 'tres facile', 'Bouillir'),
(61, 15, 0, 5, 4, 79, 'tres facile', 'Glacer'),
(62, 20, 5, 5, 3, 80, 'facile', 'Glacer'),
(63, 60, 30, 12, 2, 81, 'moyenne', 'Cuire au four');

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

--
-- Déchargement des données de la table `save`
--

INSERT INTO `save` (`newsID`, `userID`) VALUES
(4, 2),
(1, 10),
(3, 10),
(4, 10);

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
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `description` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `recetteID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recetteID` (`recetteID`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `step`
--

INSERT INTO `step` (`id`, `title`, `description`, `recetteID`) VALUES
(7, '1 ere étape ', 'Faire bouillir de l\'eau, et y plonger les lardons 2 minutes. Les égoutter, puis les faire revenir dans une poêle, sans matières grasses, jusqu\'à ce qu\'ils soient bien dorés.', 47),
(8, '2 eme étape', 'Dans un saladier (ou dans le bol du robot), mettre la farine, la levure, les œufs, le sel, le poivre et l\'huile. Bien mélanger, puis ajouter le lait chaud, le fromage râpé, les olives égouttées et les lardons.', 47),
(9, 'Pour finir', 'Graisser un moule à cake, le tapisser de papier sulfurisé beurré et y verser la préparation. Mettre au four 45 minutes environ à thermostat 6/7 (200°C), en couvrant avec un papier aluminium à mi-cuisson si le cake dore trop vite. Laisser tiédir dans le mo', 47),
(10, '1 ere etape', 'Épluchez l’échalote et l\'oignon. Coupez-les finement. Épluchez le concombre, coupez-le en dés. Égouttez le maïs. Lavez la tomate, coupez-la en deux.', 48),
(11, '2 eme étape', 'Dans un saladier, mélangez le maïs, l\'oignon rouge, l’échalote, le concombre, la mayonnaise, le ketchup et la moutarde', 48),
(12, '3 eme étape', 'Mettez au réfrigérateur 1 heure, servez la salade de maïs bien fraîche.', 48),
(13, '1 ere etape', 'Découpez la mozzarella en bâtonnets. Épongez-les délicatement avec du papier absorbant. Trempez-les dans la farine, puis dans l\'œuf battu et pour finir dans la chapelure.', 49),
(14, '2 eme etape', 'Dans une poêle huilée à feu vif, faites-les cuire jusqu\'à ce que la panure dore puis baissez le feu afin que les bâtonnets deviennent bien croustillants. Poivrez, et ajoutez au dernier moment un peu de fleur de sel sur les sticks. Servez les sticks de moz', 49),
(15, 'Conseils : ', 'Préparez cette recette au dernier moment pour servir les bâtonnets de mozzarella bien croustillants et fondants en bouche. Vos invités vont se régaler à l\'apéritif ! Vous pouvez aussi préparer ces sticks de mozza pour un dîner sur le pouce et les accompag', 49),
(16, '1.', 'Préchauffez votre four à 200°C. Coupez le chorizo en petits morceaux ainsi que la mozzarella.', 50),
(17, '2.', 'Dans un bol, versez la farine et la levure puis ajoutez les œufs et mélangez. Ajoutez le lait, salez, poivrez et incorporez le chorizo et la mozzarella. Mélangez en ajoutant le gruyère râpé.', 50),
(18, '3.', 'Dans un moule à cake, placez une feuille de papier sulfurisé, puis versez la pâte. Enfournez 20 à 30 minutes environ. Sortez-le du four, laissez le refroidir 10 minutes avant de le couper.', 50),
(19, '1.', 'Faites préchauffer le four à 200° C (thermostat 6/7).', 51),
(20, '2.', 'Lavez et coupez les aubergines en fines tranches dans le sens de la longueur.', 51),
(21, '3.', 'Faites-les dorer 5 à 6 minutes à la poêle dans l\'huile d\'olive bien chaude en les retournant. Égouttez-les sur du papier absorbant. Salez et poivrez.', 51),
(22, '4.', 'Découpez la mozzarella en gros dés et parsemez-les d\'origan. Coupez les tomates en cubes.', 51),
(23, '5.', 'Sur chaque tranche d\'aubergine, déposez des cubes de mozzarella et de tomates puis roulez-les.', 51),
(24, '6.', 'Versez le coulis de tomate dans un plat. Disposez les roulés d\'aubergines par-dessus et saupoudrez de parmesan. Faites gratiner 10 minutes sous le gril du four. Parsemez de basilic ciselé et servez les aubergines à la mozzarella bien chaudes.', 51),
(25, 'ÉTAPE 1', 'Éplucher les pommes de terre et les couper en forme de frites. Faire frire les pommes de terre à 160-170°C et ensuite à 180-190°C durant 2 min.', 52),
(26, 'ÉTAPE 2', 'De préférence dans un bol pas trop haut (du style bol à pâtes), y mettre les frites, ajouter le fromage en grains et verser la sauce brune chaude.', 52),
(27, 'ÉTAPE 3', 'Et c\'est prêt !', 52),
(28, 'ÉTAPE 1', 'Préchauffer le four à 180°C (thermostat 6).\r\n', 53),
(29, 'ÉTAPE 2', 'Hacher l\'oignon et l\'ail.', 53),
(30, 'ÉTAPE 3', 'Dans une cocotte en fonte, faire fondre le beurre, et ensuite dorer doucement l\'oignon et l’ail.', 53),
(31, 'ÉTAPE 4', 'Incorporer le boeuf haché et laisser cuire doucement 10 min.', 53),
(32, 'ÉTAPE 5', 'Mélanger le chili, le cumin, le concentré de tomates, et incorporer le tout au boeuf. Ajouter les haricots, le bouillon, du sel et du poivre.', 53),
(33, 'ÉTAPE 6', 'ÉTAPE 6', 53),
(34, 'ÉTAPE 1', 'Hachez les échalotes.', 54),
(35, 'ÉTAPE 2', 'Grattez bien et lavez les moules. Mettez-les dans une cocotte avec 1 noix de beurre, les échalotes hachées et le vin blanc.', 54),
(36, 'ÉTAPE 3', 'Faites-les ouvrir dans la cocotte couverte, sur feu vif pendant quelques minutes. Mélangez 2 ou 3 fois pendant la cuisson.', 54),
(37, 'ÉTAPE 4', 'Dès qu\'elles sont ouvertes, retirez les moules de la cocotte en conservant le jus de la cuisson. Déposez-les dans 1 plat creux et gardez-les au chaud.', 54),
(38, 'ÉTAPE 5', 'Remettez le jus sur le feu. Malaxez avec 1 fourchette 1 cuillerée à café de farine avec le même volume de beurre ou de margarine. Incorporez le tout au jus de la cuisson des moules sur le feu. Laissez bouillir un instant. Salez poivrez.', 54),
(39, 'ÉTAPE 6', 'Versez sur les moules. Saupoudrez de persil haché et servez.\r\n\r\n', 54),
(40, 'ÉTAPE 1', 'Préparer une première pâte avec la semoule, le beurre, le sel, un verre d\'eau et 4 cuillerées a café d\'eau de fleur d\'oranger.\r\n', 55),
(41, 'ÉTAPE 2', 'Mélanger le tout et rouler la pâte de façon a obtenir un long boudin.', 55),
(42, 'ÉTAPE 3', 'Préparer une seconde pâte avec la pâte de dattes, la cannelle et la dernière cuillerée d\'eau de fleur d\'oranger, passer la au micro-ondes quelques secondes pour qu\'elle soit plus malléable. Mélanger et constituer un second boudin.', 55),
(43, 'ÉTAPE 4', 'Creuser une tranchée dans la première pâte et y insérer la seconde puis rouler afin de fermer de façon homogène. Couper le boudin obtenu en losanges.', 55),
(44, 'ÉTAPE 5', 'Cuisson : laisser cuire au four 5 min à 250°C puis 15 min à 150°C.', 55),
(45, 'ÉTAPE 6', 'Ils ressortent toujours blancs alors je les passes quelques secondes dans un bain de friture.', 55),
(46, 'ÉTAPE 7', 'Juste après la cuisson faire chauffer 1 min un bol de miel au micro-ondes et tremper chaque losanges dedans sur les 2 faces puis les installer sur une grille pour égoutter le surplus de miel.', 55),
(47, 'ÉTAPE 8', 'Laisser refroidir dans une assiette en les séparant bien puis REGALEZ-VOUS !', 55),
(48, '1. La pâte:', ' Dans un grand saladier, mélanger la farine, la vanille, la levure et sucre.\n- Rajouter les oeufs puis le beurre fondu.\n- Ramasser la pâte avec l’eau de fleur d’oranger, former une boule, la couvrir et la laisser reposer au moins 1/2 heure avant de l’util', 56),
(49, '2. La Farce:', ' Mélanger tous les amandes avec le sucre et la cannelle, mouiller avec l\'eau de fleur d\'oranger jusqu\'à former une boule.\r\n- Rajouter une petite noix de beurre pour obtenir plus de moelleux', 56),
(50, '3. Façonnage:', ' Etaler la pâte en couche assez fine, à l’aide d’un emporte-pièce circulaire ou à défaut d’un verre, découper des cercles.\r\n- Déposer un peu de farce à la base\r\n- Puis rouler en donnant la forme d’un croissant\r\n- Faire de même jusqu’à épuisement de la pât', 56),
(51, 'Etape 1', 'Faire bouillir un bol d\'eau le verser sur un citron coupé en rondelles laisser infuser jusqu’à refroidissement.', 57),
(52, 'Etape 2', 'Dans une carafe ou une bouteille mettre le jus de 3 citrons, le sucre, la fleur d oranger et le lait. Bien mélanger.', 57),
(53, 'Etape 3', 'Ajouter le citron infusé qui aura refroidit. Gouter et ajouter du sucre selon le gout de chacun.', 57),
(54, 'Etape 4', 'Placer au frais jusqu’à moment du ftour.', 57),
(60, 'etape 3', 'Filtrez le tout si vous préférez ne garder que le jus clair. Réservez au frais.', 58),
(58, 'etape 1', 'Pressez le citron et l\'orange.\r\n', 58),
(59, 'etape 2', 'Coupez les extrémités de l\'ananas, retirez l\'écorce et découpez la chair en morceaux. Mixez-les avec le gingembre râpé, l\'édulcorant et le jus d\'orange et de citron. Ajoutez de l\'eau selon vos goûts.', 58),
(61, 'etape 1', 'Couper les oranges en deux', 59),
(62, '2', 'Presser les moitiés d\'orange', 59),
(63, '3', 'Verser dans un grand verre', 59),
(64, '1', 'Epluchez les kiwis et passez-les sous l\'eau pour enlever les éventuels restes de peau.', 60),
(65, '2', 'Coupez les fruits en gros cubes.', 60),
(66, '3', 'Insérez-les dans la goulotte de votre extracteur de jus et actionnez l\'appareil. Récupérez le jus vert qui s\'en écoule. En prenant soin de fermer le capuchon au préalable, versez l\'eau tout en continuant de faire tourner la vis. Cela vous permettra de net', 60),
(67, '1', 'Lavez les tomates sous l\'eau. Vous pouvez choisir une tomate cœur de bœuf ou des tomates ovales, ou même une grosse poignée de tomates cerises. Goûtez et appréciez les différentes saveurs, plus ou moins sucrées.', 61),
(68, '2', 'Coupez les tomates en quartiers et insérez-les dans la goulotte de votre extracteur de jus. Actionnez l\'appareil et récupérez le jus frais. Consommez-le sans attendre.', 61),
(69, 'ASTUCES', 'La tomate est un véritable concentré d\'anti-oxydants (notamment le bêta-carotène et le lycopène). Ceux-ci permettent de lutter contre les effets liés au vieillissement de nos cellules.', 61),
(70, '1', 'Griller la semoule à petit feu en arabe « ta\'hmiss» tout en remuant à l’aide d’une cuillère en bois, jusqu’à lui donner une jolie teinte bien dorée à peu près 20 min.', 62),
(71, '2.', 'Faire fondre le beurre et le miel dans une casserole à feu doux, ajouter l\'eau de fleur d\'oranger (facultatif).\r\n', 62),
(72, '3.', 'Verser la semoule sur le liquide en pluie tout en remuant.', 62),
(73, '4.', 'Laisser sur feu doux quelques minutes tout remuant.', 62),
(74, '5.', 'Verser dans de petites assiettes, décorer avec de la cannelle, amandes.', 62),
(75, '1', 'Faire revenir la viande dans de l\'huile. Ajouter les oignons faire revenir quelques minutes.', 63),
(76, '2', 'Ajouter les tomates mixées, le concentre de tomate ainsi que les epices et les légumes (carottes et cèleri).\r\nJe laisse revenir le tout afin que la sauce s’imprègne d’épices.\r\nAjouter 1,5 L d\'eau ainsi que les pois-chiche couvrir et laisser cuire.\r\nQuand ', 63);

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
  `seuil` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `style`
--

INSERT INTO `style` (`id`, `theme`, `primaryColor`, `secondaryColor`, `fontFamilly`, `rounded`, `seuil`) VALUES
(1, '', '[value-3]', '[value-4]', '[value-5]', 0, 0.7);

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
  `type` enum('recette','news') COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `swiperID` (`swiperID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `swiperslide`
--

INSERT INTO `swiperslide` (`id`, `image`, `title`, `description`, `href`, `swiperID`, `type`) VALUES
(1, 'swiperBg1.jpg', ' Get your recipe', 'the swiper description This is the swiper description This is the swiper description This is the swiper description ', '/login', 1, 'recette'),
(2, 'swiperBg2.jpg', 'Get yours ', 'This is the swiper This is the swiper description This is the swiper description ', '/login', 1, 'news'),
(3, 'swiperBg3.jpg', 'new recipe now!', 'This is the swiper description This is the swiper description This is the  ', '/login', 1, 'recette'),
(0, 'slider.jpg', 'check the news', 'this is a description for this new slide', '/', 1, 'news');

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `role`, `firstName`, `lastName`, `dateOfBirth`, `sex`, `status`, `password`, `email`, `photo`) VALUES
(1, 'admin', 'ouael', 'Sahbi', '0000-00-00', '', 'rejected', 'admin', 'admin', '1610117636733.jpg'),
(2, 'utilisateur', 'Nedjem eddine', 'Sahbi', '0000-00-00', '', 'valid', '123', 'ouael@gmail.com', 'Asset 1.png'),
(3, 'utilisateur', 'laarbi', 'Mourad', '2023-01-13', 'male', 'valid', 'xs', 'mourad@gmail.com', 'av2xtohC_400x400.jpg'),
(4, 'utilisateur', 'zouambia', 'sohaib', '2023-01-13', 'male', 'valid', 'xsxs', 'sohaib@xs', NULL),
(5, 'utilisateur', 'lougani', 'raouf', '2023-01-12', 'male', 'valid', 'xsxs', 'xsxs@xsx', NULL),
(6, 'utilisateur', 'xsxs', 'xxsxs', '2023-01-19', 'male', 'valid', 'xsxs', 'xsx@xsxs', NULL),
(7, 'utilisateur', 'xsxs', 'xsxs', '2023-02-04', 'male', 'pending', 'xsxs', 'xsxs@xsxs', NULL),
(8, 'utilisateur', 'xs', 'xsxs', '2023-01-13', 'male', 'valid', 'xsxs', 'xs@xsxs', NULL),
(9, 'utilisateur', 'Sahbi', 'Ouael nedjme eddine', '2023-01-19', 'male', 'valid', 'dzdz', 'jo_sahbi@esi.dz', NULL),
(10, 'utilisateur', 'sahbi', 'Ouael', '2023-01-12', 'male', 'pending', '123456789', 'Ouael@gmail.com', NULL),
(11, NULL, NULL, NULL, NULL, NULL, 'pending', 'xs', 'xs', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
