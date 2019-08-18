-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : dewolfycpd143.mysql.db
-- Généré le :  Dim 18 août 2019 à 13:17
-- Version du serveur :  5.6.39-log
-- Version de PHP :  7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dewolfycpd143`
--

-- --------------------------------------------------------

--
-- Structure de la table `users_parameters`
--

CREATE TABLE `users_parameters` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cash_banque` float NOT NULL,
  `cash_espece` float NOT NULL,
  `epargne` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users_parameters`
--

INSERT INTO `users_parameters` (`id`, `user_id`, `cash_banque`, `cash_espece`, `epargne`) VALUES
(1, 1, 0, 0, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users_parameters`
--
ALTER TABLE `users_parameters`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users_parameters`
--
ALTER TABLE `users_parameters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
