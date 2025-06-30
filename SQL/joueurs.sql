-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 25 mars 2024 à 11:12
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `plots_lumineux`
--

-- --------------------------------------------------------

--
-- Structure de la table `joueurs`
--

DROP TABLE IF EXISTS `joueurs`;
CREATE TABLE IF NOT EXISTS `joueurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `identifiant` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `joueurs`
--

INSERT INTO `joueurs` (`id`, `password`, `email`, `identifiant`) VALUES
(7, '$2y$10$oY.3mLDTzMpIQRWpIL7nVOFYtu5K3mIwceUMPx1d3KbTsJiQgCWCi', 'test@test', 'test'),
(6, '$2y$10$66V7G2XIZ4Sv3tThEf6NJuCl3yyTVv395/sL4Tdw3Pm.1kxM6z20K', 'bobibo@gmail.com', 'bobibo11'),
(8, '$2y$10$lIJ0yZyyvSBtwrwdfBCYh.IJ2tY1UKEbdE3Grv4nocFMfJ5db3SKS', '2525@gmail.com', '2525'),
(9, 'j', 'j', 'j'),
(10, 'd', 'd', 'd'),
(11, 'd', 'd', 'd'),
(12, 'm', 'm', 'm'),
(13, 'm', 'm', 'm'),
(14, '1', '1', '1'),
(15, 'd', 'd', 'd'),
(16, 'd', 'd', 'd'),
(17, 's', 's', 's'),
(18, 's', 's', 's'),
(19, 'm', 'm', 'm'),
(20, 'm', 'm', 'm'),
(21, 'd', 'd', 'd'),
(22, '1', '1', '1'),
(23, 'i', 'i', 'i'),
(24, 'f', 'f', 'f'),
(25, 'a', 'a', 'a');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
