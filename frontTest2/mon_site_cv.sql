-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 26 mars 2019 à 15:35
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mon_site_cv`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_experience`
--

CREATE TABLE `t_experience` (
  `id_t_experience` int(11) NOT NULL,
  `intitule` varchar(255) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `description` text NOT NULL,
  `lieu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_experience`
--

INSERT INTO `t_experience` (`id_t_experience`, `intitule`, `date_debut`, `date_fin`, `description`, `lieu`) VALUES
(1, 'ASSISTANTE - FLEURISTE', '2019-01-03', '0000-00-00', 'Accueil et renseignements clients, confection de bouquets, encaissement, entretien point de vente et matériel', 'MONCEAU FLEURS POISSY');

-- --------------------------------------------------------

--
-- Structure de la table `t_formation`
--

CREATE TABLE `t_formation` (
  `id_t_formation` int(11) NOT NULL,
  `intitule` varchar(255) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date DEFAULT NULL,
  `description` text NOT NULL,
  `lieu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_formation`
--

INSERT INTO `t_formation` (`id_t_formation`, `intitule`, `date_debut`, `date_fin`, `description`, `lieu`) VALUES
(1, 'Intégration - Développement Web', '2018-09-24', '2019-07-23', 'Certification RNCP techniques d\'intégration et développement web ', 'LEPOLES - WEBFORCE3 POISSY');

-- --------------------------------------------------------

--
-- Structure de la table `t_loisir`
--

CREATE TABLE `t_loisir` (
  `id_t_loisir` int(11) NOT NULL,
  `activite` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_realisation`
--

CREATE TABLE `t_realisation` (
  `id_t_realisation` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `categorie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_realisation`
--

INSERT INTO `t_realisation` (`id_t_realisation`, `photo`, `categorie`) VALUES
(6, 'http://localhost/support_poissy/frontTest2/web/5c98a15c8a7f9-5c936fefcf6c0-monpremiersite.jpg', ''),
(7, 'http://localhost/support_poissy/frontTest2/web/5c99fbdfab479-5c9372c377cf0-Screenshot_2019-01-29 Document.jpg', ''),
(8, 'http://localhost/support_poissy/frontTest2/web/5c9a05f681408-5c9372c377cf0-Screenshot_2019-01-29 Document.jpg', ''),
(9, 'http://localhost/support_poissy/mon-site-cv2/view/5c9a064e9a5b1-5c9372c377cf0-Screenshot_2019-01-29 Document.jpg', '');

-- --------------------------------------------------------

--
-- Structure de la table `t_skill`
--

CREATE TABLE `t_skill` (
  `id_t_skill` int(11) NOT NULL,
  `competence` varchar(255) NOT NULL,
  `niveau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_skill`
--

INSERT INTO `t_skill` (`id_t_skill`, `competence`, `niveau`) VALUES
(3, 'HTML', 60),
(4, 'CSS', 60),
(5, 'Javascript', 30);

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

CREATE TABLE `t_user` (
  `id_t_user` int(11) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telephone` int(10) UNSIGNED ZEROFILL NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `age` int(3) NOT NULL,
  `date_naissance` date NOT NULL,
  `ville` varchar(255) NOT NULL,
  `pays` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_user`
--

INSERT INTO `t_user` (`id_t_user`, `prenom`, `nom`, `email`, `password`, `telephone`, `pseudo`, `avatar`, `age`, `date_naissance`, `ville`, `pays`) VALUES
(1, 'Magali', 'Piszczyglowa', 'magali.piszczyglowa@lepoles.com', 'lachouette', 0600000000, 'Black', 'Blackowl', 35, '1984-05-01', 'Poissy', 'France');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_experience`
--
ALTER TABLE `t_experience`
  ADD PRIMARY KEY (`id_t_experience`);

--
-- Index pour la table `t_formation`
--
ALTER TABLE `t_formation`
  ADD PRIMARY KEY (`id_t_formation`);

--
-- Index pour la table `t_loisir`
--
ALTER TABLE `t_loisir`
  ADD PRIMARY KEY (`id_t_loisir`);

--
-- Index pour la table `t_realisation`
--
ALTER TABLE `t_realisation`
  ADD PRIMARY KEY (`id_t_realisation`);

--
-- Index pour la table `t_skill`
--
ALTER TABLE `t_skill`
  ADD PRIMARY KEY (`id_t_skill`);

--
-- Index pour la table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id_t_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_experience`
--
ALTER TABLE `t_experience`
  MODIFY `id_t_experience` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `t_formation`
--
ALTER TABLE `t_formation`
  MODIFY `id_t_formation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `t_loisir`
--
ALTER TABLE `t_loisir`
  MODIFY `id_t_loisir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_realisation`
--
ALTER TABLE `t_realisation`
  MODIFY `id_t_realisation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `t_skill`
--
ALTER TABLE `t_skill`
  MODIFY `id_t_skill` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id_t_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
