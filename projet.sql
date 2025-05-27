-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 26 mai 2025 à 12:46
-- Version du serveur : 5.7.24
-- Version de PHP : 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `achievement`
--

CREATE TABLE `achievement` (
  `id_achievement` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` text,
  `icone` varchar(100) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `achievement`
--

INSERT INTO `achievement` (`id_achievement`, `nom`, `description`, `icone`) VALUES
(1, 'Premier pas', 'Gagner votre première partie.', 'first_win.png'),
(2, 'Rapide', 'Terminer un niveau en moins de 20 coups.', 'fast.png'),
(3, 'Perfection', 'Terminer un niveau avec le nombre de coups optimal.', 'perfect.png'),
(4, 'No rage', 'Terminer un niveau sans réinitialiser.', 'norage.png'),
(5, 'Nuit blanche', 'Jouer entre minuit et 4h du matin.', 'night.png');

-- --------------------------------------------------------

--
-- Structure de la table `campagne`
--

CREATE TABLE `campagne` (
  `Id_campagne` int(11) NOT NULL,
  `Id_user` int(11) NOT NULL,
  `Campagne` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `classement`
--

CREATE TABLE `classement` (
  `Id_classement` int(11) NOT NULL,
  `Id_user` int(11) NOT NULL,
  `Classement` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `map`
--

CREATE TABLE `map` (
  `id_map` int(11) NOT NULL,
  `niveau_map` int(11) NOT NULL,
  `code_map` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `map`
--

INSERT INTO `map` (`id_map`, `niveau_map`, `code_map`) VALUES
(1, 1, '[\'rouge\' => [\'x\' => 2, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\r\n    \'jaune\'  => [\'x\' => 3, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\r\n    \'bleu\'   => [\'x\' => 4, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\r\n    \'vert\'   => [\'x\' => 0, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 3]]'),
(2, 1, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\'  => [\'x\' => 0, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'bleu\' => [\'x\' => 0, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'vert\' => [\'x\' => 4, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'orange\' => [\'x\' => 3, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'Cyan\' => [\'x\' => 5, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 2]\r\n        ]'),
(3, 1, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 0, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'bleu\' => [\'x\' => 3, \'y\' => 1, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'vert\' => [\'x\' => 4, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'orange\' => [\'x\' => 1, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'Cyan\' => [\'x\' => 3, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 3]\r\n        ]'),
(4, 1, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 1, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'bleu\' => [\'x\' => 0, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 3],\r\n            \'vert\' => [\'x\' => 0, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'orange\' => [\'x\' => 4, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'Cyan\' => [\'x\' => 4, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2]\r\n        ]'),
(5, 1, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 0, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'bleu\' => [\'x\' => 4, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'vert\' => [\'x\' => 4, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'orange\' => [\'x\' => 3, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 3]\r\n        ]'),
(6, 1, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 0, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'bleu\' => [\'x\' => 2, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'vert\' => [\'x\' => 5, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 3],\r\n            \'orange\' => [\'x\' => 3, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 3]\r\n        ]'),
(7, 1, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 1, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'bleu\' => [\'x\' => 0, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'vert\' => [\'x\' => 0, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'orange\' => [\'x\' => 2, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'magenta\' => [\'x\' => 3, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'cyan\' => [\'x\' => 4, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'gris\' => [\'x\' => 4, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2]\r\n        ]'),
(8, 1, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 0, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'bleu\' => [\'x\' => 0, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'vert\' => [\'x\' => 1, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'orange\' => [\'x\' => 2, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'magenta\' => [\'x\' => 2, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'cyan\' => [\'x\' => 4, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'gris\' => [\'x\' => 4, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 3],\r\n            \'noir\' => [\'x\' => 4, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 2]\r\n        ]'),
(9, 1, '[\n            \'rouge\' => [\'x\' => 2, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\n            \'jaune\' => [\'x\' => 0, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 2],\n            \'bleu\' => [\'x\' => 0, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\n            \'vert\' => [\'x\' => 0, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\n            \'orange\' => [\'x\' => 1, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 2],\n            \'magenta\' => [\'x\' => 1, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 3],\n            \'cyan\' => [\'x\' => 1, \'y\' => 1, \'dir\' => \'V\', \'taille\' => 2],\n            \'gris\' => [\'x\' => 3, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\n            \'noir\' => [\'x\' => 3, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\n            \'dore\' => [\'x\' => 3, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 3]\n        ]'),
(10, 1, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 0, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'bleu\' => [\'x\' => 0, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'vert\' => [\'x\' => 0, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'orange\' => [\'x\' => 2, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'magenta\' => [\'x\' => 4, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'cyan\' => [\'x\' => 4, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 3],\r\n            \'gris\' => [\'x\' => 4, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 2]\r\n        ]'),
(11, 1, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 0, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 3],\r\n            \'bleu\' => [\'x\' => 0, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'vert\' => [\'x\' => 2, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'orange\' => [\'x\' => 3, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'magenta\' => [\'x\' => 4, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'cyan\' => [\'x\' => 4, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'gris\' => [\'x\' => 5, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 3]\r\n        ]'),
(12, 1, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 1, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'bleu\' => [\'x\' => 1, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'vert\' => [\'x\' => 1, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'orange\' => [\'x\' => 3, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'magenta\' => [\'x\' => 3, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'cyan\' => [\'x\' => 4, \'y\' => 1, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'gris\' => [\'x\' => 5, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2]\r\n        ]'),
(13, 1, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 0, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'bleu\' => [\'x\' => 0, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'vert\' => [\'x\' => 0, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'orange\' => [\'x\' => 1, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'magenta\' => [\'x\' => 2, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'cyan\' => [\'x\' => 2, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'gris\' => [\'x\' => 4, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 3]\r\n        ]'),
(14, 1, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 1, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'bleu\' => [\'x\' => 1, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'vert\' => [\'x\' => 1, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'orange\' => [\'x\' => 3, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'magenta\' => [\'x\' => 4, \'y\' => 1, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'cyan\' => [\'x\' => 4, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'gris\' => [\'x\' => 5, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2]\r\n        ]'),
(15, 1, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 0, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'bleu\' => [\'x\' => 0, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'vert\' => [\'x\' => 1, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'orange\' => [\'x\' => 3, \'y\' => 1, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'magenta\' => [\'x\' => 3, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 3],\r\n            \'cyan\' => [\'x\' => 4, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'gris\' => [\'x\' => 4, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 2]\r\n        ]'),
(16, 1, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 0, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'bleu\' => [\'x\' => 0, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'vert\' => [\'x\' => 1, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'orange\' => [\'x\' => 1, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'magenta\' => [\'x\' => 3, \'y\' => 1, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'cyan\' => [\'x\' => 3, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'gris\' => [\'x\' => 4, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2]\r\n        ]'),
(17, 1, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 0, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'bleu\' => [\'x\' => 0, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'vert\' => [\'x\' => 2, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'orange\' => [\'x\' => 2, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'magenta\' => [\'x\' => 3, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 3],\r\n            \'cyan\' => [\'x\' => 4, \'y\' => 1, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'gris\' => [\'x\' => 4, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'argent\' => [\'x\' => 5, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2]\r\n        ]'),
(18, 1, '[\n            \'rouge\' => [\'x\' => 2, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 2],\n            \'jaune\' => [\'x\' => 0, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 3],\n            \'bleu\' => [\'x\' => 0, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 3],\n            \'vert\' => [\'x\' => 1, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 3],\n            \'orange\' => [\'x\' => 1, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 2],\n            \'magenta\' => [\'x\' => 1, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\n            \'cyan\' => [\'x\' => 2, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 3],\n            \'gris\' => [\'x\' => 3, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\n            \'argent\' => [\'x\' => 3, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 2],\n            \'Noir\' => [\'x\' => 4, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 2],\n            \'dore\' => [\'x\' => 5, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 3]\n        ]'),
(19, 1, '[\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\n            \'jaune\' => [\'x\' => 0, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 3],\n            \'bleu\' => [\'x\' => 1, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\n            \'vert\' => [\'x\' => 1, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 2],\n            \'orange\' => [\'x\' => 1, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 3],\n            \'magenta\' => [\'x\' => 3, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\n            \'cyan\' => [\'x\' => 3, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 2],\n            \'gris\' => [\'x\' => 4, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\n            \'argent\' => [\'x\' => 4, \'y\' => 1, \'dir\' => \'V\', \'taille\' => 2],\n            \'Noir\' => [\'x\' => 4, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 2],\n            \'dore\' => [\'x\' => 5, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2]\n        ]'),
(20, 1, '[\n            \'rouge\' => [\'x\' => 2, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\n            \'jaune\' => [\'x\' => 0, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 3],\n            \'bleu\' => [\'x\' => 0, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\n            \'vert\' => [\'x\' => 0, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 3],\n            \'orange\' => [\'x\' => 0, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 2],\n            \'magenta\' => [\'x\' => 1, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\n            \'cyan\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\n            \'gris\' => [\'x\' => 2, \'y\' => 1, \'dir\' => \'V\', \'taille\' => 2],\n            \'argent\' => [\'x\' => 3, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\n            \'Noir\' => [\'x\' => 4, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\n            \'dore\' => [\'x\' => 4, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 2],\n            \'Lavende\' => [\'x\' => 5, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 2]\n        ]'),
(21, 2, '[\n            \'rouge\' => [\'x\' => 2, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 2],\n            \'jaune\' => [\'x\' => 0, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 3],\n            \'bleu\' => [\'x\' => 0, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\n            \'vert\' => [\'x\' => 0, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 2],\n            \'orange\' => [\'x\' => 0, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 3],\n            \'magenta\' => [\'x\' => 1, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\n            \'cyan\' => [\'x\' => 1, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 2],\n            \'gris\' => [\'x\' => 3, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\n            \'argent\' => [\'x\' => 3, \'y\' => 1, \'dir\' => \'V\', \'taille\' => 2],\n            \'Noir\' => [\'x\' => 3, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\n            \'dore\' => [\'x\' => 3, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\n            \'Lavende\' => [\'x\' => 4, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\n            \'Emeraude\' => [\'x\' => 4, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\n            \'saphire\' => [\'x\' => 5, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2]\n        ]'),
(22, 2, '[\n            \'rouge\' => [\'x\' => 2, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\n            \'jaune\' => [\'x\' => 0, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 3],\n            \'bleu\' => [\'x\' => 0, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 3],\n            \'vert\' => [\'x\' => 0, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 3],\n            \'orange\' => [\'x\' => 1, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 3],\n            \'magenta\' => [\'x\' => 3, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\n            \'cyan\' => [\'x\' => 3, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 3],\n            \'gris\' => [\'x\' => 4, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\n            \'argent\' => [\'x\' => 5, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 3]\n        ]'),
(23, 2, '[\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\n            \'jaune\' => [\'x\' => 0, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 2],\n            \'bleu\' => [\'x\' => 0, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\n            \'vert\' => [\'x\' => 1, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\n            \'orange\' => [\'x\' => 1, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 3],\n            \'magenta\' => [\'x\' => 2, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\n            \'cyan\' => [\'x\' => 3, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\n            \'gris\' => [\'x\' => 3, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 2],\n            \'argent\' => [\'x\' => 4, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\n            \'Noir\' => [\'x\' => 4, \'y\' => 1, \'dir\' => \'V\', \'taille\' => 2],\n            \'dore\' => [\'x\' => 4, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 2],\n            \'lavende\' => [\'x\' => 5, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\n            \'Emeraude\' => [\'x\' => 5, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2]\n        ]'),
(24, 2, '[\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\n            \'jaune\' => [\'x\' => 0, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\n            \'bleu\' => [\'x\' => 0, \'y\' => 1, \'dir\' => \'V\', \'taille\' => 2],\n            \'vert\' => [\'x\' => 0, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\n            \'orange\' => [\'x\' => 0, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 2],\n            \'magenta\' => [\'x\' => 1, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 3],\n            \'cyan\' => [\'x\' => 1, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 3],\n            \'gris\' => [\'x\' => 3, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\n            \'argent\' => [\'x\' => 3, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\n            \'Noir\' => [\'x\' => 4, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\n            \'dore\' => [\'x\' => 5, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 2],\n            \'Lavende\' => [\'x\' => 5, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 2]\n        ]'),
(25, 2, '[\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\n            \'jaune\' => [\'x\' => 0, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 3],\n            \'bleu\' => [\'x\' => 0, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 3],\n            \'vert\' => [\'x\' => 1, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\n            \'orange\' => [\'x\' => 1, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 2],\n            \'magenta\' => [\'x\' => 1, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 2],\n            \'cyan\' => [\'x\' => 2, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 3],\n            \'gris\' => [\'x\' => 3, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\n            \'argent\' => [\'x\' => 3, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 2],\n            \'Noir\' => [\'x\' => 3, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 2],\n            \'dore\' => [\'x\' => 4, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 2],\n            \'Lavende\' => [\'x\' => 5, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2]\n        ]'),
(26, 2, '[\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\n            \'jaune\' => [\'x\' => 0, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\n            \'bleu\' => [\'x\' => 0, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 3],\n            \'vert\' => [\'x\' => 0, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 3],\n            \'orange\' => [\'x\' => 1, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 2],\n            \'magenta\' => [\'x\' => 2, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\n            \'cyan\' => [\'x\' => 3, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\n            \'gris\' => [\'x\' => 3, \'y\' => 1, \'dir\' => \'V\', \'taille\' => 3],\n            \'argent\' => [\'x\' => 3, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\n            \'Noir\' => [\'x\' => 4, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 3],\n            \'dore\' => [\'x\' => 5, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 3]\n        ]'),
(27, 2, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 0, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'bleu\' => [\'x\' => 0, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'vert\' => [\'x\' => 1, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'orange\' => [\'x\' => 1, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'magenta\' => [\'x\' => 3, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'cyan\' => [\'x\' => 3, \'y\' => 1, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'gris\' => [\'x\' => 3, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'argent\' => [\'x\' => 4, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'Noir\' => [\'x\' => 5, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 2]\r\n        ]'),
(28, 2, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 0, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'bleu\' => [\'x\' => 0, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'vert\' => [\'x\' => 1, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'orange\' => [\'x\' => 1, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'magenta\' => [\'x\' => 2, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'cyan\' => [\'x\' => 2, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'gris\' => [\'x\' => 3, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'argent\' => [\'x\' => 3, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'Noir\' => [\'x\' => 4, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 3]\r\n        ]'),
(29, 2, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 0, \'y\' => 1, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'bleu\' => [\'x\' => 1, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'vert\' => [\'x\' => 1, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'orange\' => [\'x\' => 1, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'magenta\' => [\'x\' => 1, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'cyan\' => [\'x\' => 3, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 3],\r\n            \'gris\' => [\'x\' => 3, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'argent\' => [\'x\' => 4, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'Noir\' => [\'x\' => 5, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 2]\r\n        ]'),
(30, 2, '[\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\n            \'jaune\' => [\'x\' => 0, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\n            \'bleu\' => [\'x\' => 0, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 2],\n            \'vert\' => [\'x\' => 0, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 2],\n            \'orange\' => [\'x\' => 0, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 2],\n            \'magenta\' => [\'x\' => 1, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 3],\n            \'cyan\' => [\'x\' => 3, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 2],\n            \'gris\' => [\'x\' => 3, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\n            \'argent\' => [\'x\' => 4, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\n            \'Noir\' => [\'x\' => 4, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\n            \'dore\' => [\'x\' => 4, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 2]\n        ]'),
(31, 4, '[            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\'  => [\'x\' => 0, \'y\' => 1, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'bleu\' => [\'x\' => 0, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 3],\r\n            \'vert\' => [\'x\' => 0, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'orange\' => [\'x\' => 1, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 3],\r\n            \'magenta\' => [\'x\' => 2, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'cyan\' => [\'x\' => 2, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'gris\' => [\'x\' =>3, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'argent\' => [\'x\' => 3, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'noir\' => [\'x\' => 4, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'dore\' => [\'x\' => 5, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 2]\r\n]'),
(32, 32, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 0, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'bleu\' => [\'x\' => 0, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 3],\r\n            \'vert\' => [\'x\' => 1, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'orange\' => [\'x\' => 1, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'magenta\' => [\'x\' => 1, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'cyan\' => [\'x\' => 2, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'gris\' => [\'x\' => 3, \'y\' => 1, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'argent\' => [\'x\' => 3, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'noir\' => [\'x\' => 4, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'dore\' => [\'x\' => 5, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'lavende\' => [\'x\' => 5, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 2]\r\n        ]'),
(33, 33, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 0, \'y\' => 1, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'bleu\' => [\'x\' => 0, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'vert\' => [\'x\' => 0, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'orange\' => [\'x\' => 0, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'magenta\' => [\'x\' => 1, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'cyan\' => [\'x\' => 3, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'gris\' => [\'x\' => 3, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 3],\r\n            \'argent\' => [\'x\' => 3, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'noir\' => [\'x\' => 5, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'dore\' => [\'x\' => 5, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2]\r\n        ]'),
(34, 34, '[\n            \'rouge\' => [\'x\' => 2, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\n            \'jaune\' => [\'x\' => 0, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 2],\n            \'bleu\' => [\'x\' => 0, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\n            \'vert\' => [\'x\' => 1, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 3],\n            \'orange\' => [\'x\' => 1, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 3],\n            \'magenta\' => [\'x\' => 1, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 2],\n            \'cyan\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 3],\n            \'gris\' => [\'x\' => 2, \'y\' => 1, \'dir\' => \'V\', \'taille\' => 2],\n            \'argent\' => [\'x\' => 3, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 2],\n            \'noir\' => [\'x\' => 4, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\n            \'dore\' => [\'x\' => 4, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 2],\n            \'lavende\' => [\'x\' => 5, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\n            \'emeraude\' => [\'x\' => 5, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2]\n        ]'),
(35, 35, '[\n            \'rouge\' => [\'x\' => 2, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 2],\n            \'jaune\' => [\'x\' => 0, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 3],\n            \'bleu\' => [\'x\' => 0, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\n            \'vert\' => [\'x\' => 0, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 3],\n            \'orange\' => [\'x\' => 0, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\n            \'magenta\' => [\'x\' => 2, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 2],\n            \'cyan\' => [\'x\' => 2, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 2],\n            \'gris\' => [\'x\' => 3, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\n            \'argent\' => [\'x\' => 3, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\n            \'noir\' => [\'x\' => 4, \'y\' => 1, \'dir\' => \'V\', \'taille\' => 2],\n            \'dore\' => [\'x\' => 4, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 2],\n            \'lavende\' => [\'x\' => 5, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 3]\n        ]'),
(36, 36, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 0, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'bleu\' => [\'x\' => 0, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'vert\' => [\'x\' => 1, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'orange\' => [\'x\' => 2, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'magenta\' => [\'x\' => 3, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'cyan\' => [\'x\' => 3, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'gris\' => [\'x\' => 4, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 3],\r\n            \'argent\' => [\'x\' => 4, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'noir\' => [\'x\' => 5, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'dore\' => [\'x\' => 5, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2]\r\n        ]'),
(37, 37, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 0, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'bleu\' => [\'x\' => 0, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 3],\r\n            \'vert\' => [\'x\' => 1, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'orange\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'magenta\' => [\'x\' => 2, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'cyan\' => [\'x\' => 3, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'gris\' => [\'x\' => 4, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'argent\' => [\'x\' => 4, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'noir\' => [\'x\' => 4, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'dore\' => [\'x\' => 5, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'lavende\' => [\'x\' => 5, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2]\r\n        ]'),
(38, 38, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 0, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'bleu\' => [\'x\' => 0, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'vert\' => [\'x\' => 0, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'orange\' => [\'x\' => 0, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'magenta\' => [\'x\' => 2, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'cyan\' => [\'x\' => 3, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'gris\' => [\'x\' => 3, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'argent\' => [\'x\' => 4, \'y\' => 1, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'noir\' => [\'x\' => 4, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'dore\' => [\'x\' => 5, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'lavende\' => [\'x\' => 5, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2]\r\n        ]'),
(39, 39, '[\r\n            \'rouge\' => [\'x\' => 2, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'jaune\' => [\'x\' => 0, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'bleu\' => [\'x\' => 0, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'vert\' => [\'x\' => 0, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'orange\' => [\'x\' => 1, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 3],\r\n            \'magenta\' => [\'x\' => 1, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'cyan\' => [\'x\' => 2, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'gris\' => [\'x\' => 2, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'argent\' => [\'x\' => 3, \'y\' => 1, \'dir\' => \'V\', \'taille\' => 3],\r\n            \'noir\' => [\'x\' => 3, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'dore\' => [\'x\' => 4, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 2],\r\n            \'lavende\' => [\'x\' => 5, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\r\n            \'emeraude\' => [\'x\' => 5, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2]\r\n        ]'),
(40, 40, '[\n            \'rouge\' => [\'x\' => 2, \'y\' => 2, \'dir\' => \'H\', \'taille\' => 2],\n            \'jaune\' => [\'x\' => 0, \'y\' => 0, \'dir\' => \'V\', \'taille\' => 3],\n            \'bleu\' => [\'x\' => 0, \'y\' => 1, \'dir\' => \'H\', \'taille\' => 2],\n            \'vert\' => [\'x\' => 0, \'y\' => 3, \'dir\' => \'H\', \'taille\' => 2],\n            \'orange\' => [\'x\' => 2, \'y\' => 4, \'dir\' => \'V\', \'taille\' => 3],\n            \'magenta\' => [\'x\' => 2, \'y\' => 5, \'dir\' => \'V\', \'taille\' => 2],\n            \'cyan\' => [\'x\' => 3, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2],\n            \'gris\' => [\'x\' => 3, \'y\' => 2, \'dir\' => \'V\', \'taille\' => 2],\n            \'argent\' => [\'x\' => 4, \'y\' => 3, \'dir\' => \'V\', \'taille\' => 2],\n            \'noir\' => [\'x\' => 4, \'y\' => 4, \'dir\' => \'H\', \'taille\' => 2],\n            \'dore\' => [\'x\' => 5, \'y\' => 0, \'dir\' => \'H\', \'taille\' => 2]\n        ]');

-- --------------------------------------------------------

--
-- Structure de la table `score_perso`
--

CREATE TABLE `score_perso` (
  `Id_score` int(11) NOT NULL,
  `Id_user` int(11) NOT NULL,
  `Nombre_parties` bigint(20) DEFAULT NULL,
  `Nombres_coups` int(11) DEFAULT NULL,
  `Top_coups` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `Id_user` int(11) NOT NULL,
  `Pseudo` varchar(64) NOT NULL,
  `Date_de_naissance` date NOT NULL,
  `Numero_de_tel` varchar(64) NOT NULL,
  `Adresse_mail` varchar(64) NOT NULL,
  `Date_creation_compte` date NOT NULL,
  `Pass_word` varchar(64) NOT NULL,
  `Admin` int(11) DEFAULT NULL,
  `coins` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`Id_user`, `Pseudo`, `Date_de_naissance`, `Numero_de_tel`, `Adresse_mail`, `Date_creation_compte`, `Pass_word`, `Admin`, `coins`) VALUES
(2, 'prout', '2006-11-02', '0632323232', 'pied@junia.com', '2025-05-15', '$2y$10$6YHy/Y6wZiBE7J.qiYw1ZuWy/BtjnOX0WufoKuYh3DfxK.Dr3OFr6', NULL, 0),
(3, 'prout', '2006-11-02', '0632323232', 'caca@junia.com', '2025-05-15', '$2y$10$WL0yvh8nTrkMIO17n72pOuS1YeXWgcffgtwyRjtIilJEznmCgW976', NULL, 88),
(4, 'gogopez', '2006-01-01', '0606060606', 'yhf.iurhu@gmail.com', '2025-05-21', '$2y$10$Y703FcrSvX6yH1hxRZTkGeqI2hwHaKxo/MmFUTWjaAG2ROUlrzZ.a', NULL, 1067900);

-- --------------------------------------------------------

--
-- Structure de la table `user_achievement`
--

CREATE TABLE `user_achievement` (
  `id_user` int(11) NOT NULL,
  `id_achievement` int(11) NOT NULL,
  `date_debloque` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_achievement`
--

INSERT INTO `user_achievement` (`id_user`, `id_achievement`, `date_debloque`) VALUES
(3, 4, '2025-05-19 11:42:55');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `achievement`
--
ALTER TABLE `achievement`
  ADD PRIMARY KEY (`id_achievement`);

--
-- Index pour la table `campagne`
--
ALTER TABLE `campagne`
  ADD PRIMARY KEY (`Id_campagne`),
  ADD KEY `Id_user` (`Id_user`);

--
-- Index pour la table `classement`
--
ALTER TABLE `classement`
  ADD PRIMARY KEY (`Id_classement`),
  ADD KEY `Id_user` (`Id_user`);

--
-- Index pour la table `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`id_map`);

--
-- Index pour la table `score_perso`
--
ALTER TABLE `score_perso`
  ADD PRIMARY KEY (`Id_score`),
  ADD KEY `Id_user` (`Id_user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id_user`);

--
-- Index pour la table `user_achievement`
--
ALTER TABLE `user_achievement`
  ADD PRIMARY KEY (`id_user`,`id_achievement`),
  ADD KEY `id_achievement` (`id_achievement`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `achievement`
--
ALTER TABLE `achievement`
  MODIFY `id_achievement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `campagne`
--
ALTER TABLE `campagne`
  MODIFY `Id_campagne` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `classement`
--
ALTER TABLE `classement`
  MODIFY `Id_classement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `map`
--
ALTER TABLE `map`
  MODIFY `id_map` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `score_perso`
--
ALTER TABLE `score_perso`
  MODIFY `Id_score` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `Id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `campagne`
--
ALTER TABLE `campagne`
  ADD CONSTRAINT `campagne_ibfk_1` FOREIGN KEY (`Id_user`) REFERENCES `user` (`Id_user`);

--
-- Contraintes pour la table `classement`
--
ALTER TABLE `classement`
  ADD CONSTRAINT `classement_ibfk_1` FOREIGN KEY (`Id_user`) REFERENCES `user` (`Id_user`);

--
-- Contraintes pour la table `score_perso`
--
ALTER TABLE `score_perso`
  ADD CONSTRAINT `score_perso_ibfk_1` FOREIGN KEY (`Id_user`) REFERENCES `user` (`Id_user`);

--
-- Contraintes pour la table `user_achievement`
--
ALTER TABLE `user_achievement`
  ADD CONSTRAINT `user_achievement_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`Id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_achievement_ibfk_2` FOREIGN KEY (`id_achievement`) REFERENCES `achievement` (`id_achievement`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
