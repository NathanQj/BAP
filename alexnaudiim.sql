-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 03 Novembre 2014 à 19:05
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `alexnaudiim`
--
CREATE DATABASE IF NOT EXISTS `alexnaudiim` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `alexnaudiim`;

-- --------------------------------------------------------

--
-- Structure de la table `cgu`
--

CREATE TABLE IF NOT EXISTS `cgu` (
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cgu`
--

INSERT INTO `cgu` (`content`) VALUES
('Arthon ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
('Arthon ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
('Arthon ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'casual_user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `sexe` char(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture` int(11) NOT NULL,
  `lycee` varchar(255) NOT NULL,
  `classe` varchar(100) NOT NULL,
  `xp` int(11) NOT NULL,
  `age` int(2) NOT NULL,
  `user_role` int(11) NOT NULL DEFAULT '1',
  `user_registered` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `sexe`, `email`, `picture`, `lycee`, `classe`, `xp`, `age`, `user_role`, `user_registered`) VALUES
(1, 'Custorial', 'mdpcustorial', 'Custorial', 'Admin', 'g', 'custorial-admin@gmail.com', 0, 'Lycï¿½e Professionnel de Chantilly', 'PremiÃ¨re S', 10000, 18, 2, '0000-00-00'),
(5, 'Lili', 'brefcettefille', 'Alice', 'David', 'f', 'cettefille@gmail.com', 0, 'LycÃ©e le Corbusier', 'Terminale ES', 0, 16, 1, '0000-00-00'),
(8, 'WebChief', 'custorial', 'Alex', 'Naud', 'g', 'alex@gmail.com', 0, 'Lycée le Corbusier', 'Terminale', 0, 70, 1, '2014-10-29'),
(9, 'Linarghrgdyugbfufjur', 'hipster', 'Lina', 'Pantalon', 'g', 'lina@gmail.com', 0, 'LycÃ©e FranÃ§ois Villon', 'Terminale S', 0, 18, 1, '2014-10-29'),
(10, 'Monsieur.', 'monsieur', 'Thomas', 'Lefebure', 'g', 'thomlfbr@gmail.com', 0, 'LycÃ©e FranÃ§ois Villon', 'Terminale S', 0, 19, 1, '2014-11-01'),
(11, 'Damoi', 'demoiselle', 'Edwin', 'Bumenn', 'g', 'edbumh@gmail.com', 0, 'LycÃ©e FranÃ§ois Villon', 'Terminale S', 0, 19, 1, '2014-11-01'),
(12, 'BadMiscruit', 'badmiscuit', 'Trung', 'Nguyen', 'g', 'trung@gmail.com', 0, 'LycÃ©e FranÃ§ois Villon', 'Terminale S', 0, 18, 1, '2014-11-01');

-- --------------------------------------------------------

--
-- Structure de la table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(19) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `video` varchar(150) NOT NULL,
  `auteur` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `shares` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
