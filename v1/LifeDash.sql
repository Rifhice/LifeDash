-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 15 Mai 2017 à 23:00
-- Version du serveur :  5.5.54-0+deb8u1
-- Version de PHP :  5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `LifeDash`
--

-- --------------------------------------------------------

--
-- Structure de la table `Affiliation`
--

CREATE TABLE IF NOT EXISTS `Affiliation` (
  `IdSeance` int(11) NOT NULL,
  `IdExercice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Affiliation`
--

INSERT INTO `Affiliation` (`IdSeance`, `IdExercice`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Charge`
--

CREATE TABLE IF NOT EXISTS `Charge` (
  `IdExercice` int(11) NOT NULL,
`Id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Charge`
--

INSERT INTO `Charge` (`IdExercice`, `Id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Exercice`
--

CREATE TABLE IF NOT EXISTS `Exercice` (
`IdExercice` int(11) NOT NULL,
  `Titre` varchar(128) NOT NULL,
  `Description` varchar(512) NOT NULL,
  `img` varchar(512) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Exercice`
--

INSERT INTO `Exercice` (`IdExercice`, `Titre`, `Description`, `img`) VALUES
(1, 'Développé couché', 'efozrgfierog', 'developer.png'),
(2, 'Course a pied', 'zehfiopehgherg', 'course.png');

-- --------------------------------------------------------

--
-- Structure de la table `PerformanceCharge`
--

CREATE TABLE IF NOT EXISTS `PerformanceCharge` (
`IdPerf` int(11) NOT NULL,
  `IdC` int(11) NOT NULL,
  `Serie` int(11) NOT NULL,
  `Repetition` int(11) NOT NULL,
  `Charge` int(11) NOT NULL,
  `Jour` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `PerformanceCharge`
--

INSERT INTO `PerformanceCharge` (`IdPerf`, `IdC`, `Serie`, `Repetition`, `Charge`, `Jour`) VALUES
(1, 1, 4, 12, 50, '2017-05-16');

-- --------------------------------------------------------

--
-- Structure de la table `PerformanceTemp`
--

CREATE TABLE IF NOT EXISTS `PerformanceTemp` (
`IdPerf` int(11) NOT NULL,
  `IdT` int(11) NOT NULL,
  `Temp` time NOT NULL,
  `Jour` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `PerformanceTemp`
--

INSERT INTO `PerformanceTemp` (`IdPerf`, `IdT`, `Temp`, `Jour`) VALUES
(1, 1, '06:00:00', '2017-05-16');

-- --------------------------------------------------------

--
-- Structure de la table `Seance`
--

CREATE TABLE IF NOT EXISTS `Seance` (
`IdSeance` int(11) NOT NULL,
  `Titre` varchar(128) NOT NULL,
  `Objectif` varchar(512) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Seance`
--

INSERT INTO `Seance` (`IdSeance`, `Titre`, `Objectif`) VALUES
(1, 'Seance pectoraux', 'Seances avec pour but de faire travailler les pectoraux');

-- --------------------------------------------------------

--
-- Structure de la table `Temps`
--

CREATE TABLE IF NOT EXISTS `Temps` (
  `IdExercice` int(11) NOT NULL,
`Id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Temps`
--

INSERT INTO `Temps` (`IdExercice`, `Id`) VALUES
(2, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Affiliation`
--
ALTER TABLE `Affiliation`
 ADD KEY `IdSeance` (`IdSeance`), ADD KEY `IdExercice` (`IdExercice`);

--
-- Index pour la table `Charge`
--
ALTER TABLE `Charge`
 ADD PRIMARY KEY (`Id`), ADD KEY `IdExercice` (`IdExercice`);

--
-- Index pour la table `Exercice`
--
ALTER TABLE `Exercice`
 ADD PRIMARY KEY (`IdExercice`), ADD KEY `Id` (`IdExercice`), ADD KEY `Id_2` (`IdExercice`), ADD KEY `IdExercice` (`IdExercice`);

--
-- Index pour la table `PerformanceCharge`
--
ALTER TABLE `PerformanceCharge`
 ADD PRIMARY KEY (`IdPerf`), ADD KEY `IdC` (`IdC`), ADD KEY `IdC_2` (`IdC`);

--
-- Index pour la table `PerformanceTemp`
--
ALTER TABLE `PerformanceTemp`
 ADD PRIMARY KEY (`IdPerf`), ADD KEY `IdT` (`IdT`);

--
-- Index pour la table `Seance`
--
ALTER TABLE `Seance`
 ADD PRIMARY KEY (`IdSeance`);

--
-- Index pour la table `Temps`
--
ALTER TABLE `Temps`
 ADD PRIMARY KEY (`Id`), ADD UNIQUE KEY `idExo` (`IdExercice`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Charge`
--
ALTER TABLE `Charge`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `Exercice`
--
ALTER TABLE `Exercice`
MODIFY `IdExercice` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `PerformanceCharge`
--
ALTER TABLE `PerformanceCharge`
MODIFY `IdPerf` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `PerformanceTemp`
--
ALTER TABLE `PerformanceTemp`
MODIFY `IdPerf` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `Seance`
--
ALTER TABLE `Seance`
MODIFY `IdSeance` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `Temps`
--
ALTER TABLE `Temps`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Affiliation`
--
ALTER TABLE `Affiliation`
ADD CONSTRAINT `Affiliation_ibfk_2` FOREIGN KEY (`IdExercice`) REFERENCES `Exercice` (`IdExercice`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Affiliation_ibfk_1` FOREIGN KEY (`IdSeance`) REFERENCES `Seance` (`IdSeance`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Charge`
--
ALTER TABLE `Charge`
ADD CONSTRAINT `Charge_ibfk_1` FOREIGN KEY (`IdExercice`) REFERENCES `Exercice` (`IdExercice`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `PerformanceCharge`
--
ALTER TABLE `PerformanceCharge`
ADD CONSTRAINT `PerformanceCharge_ibfk_1` FOREIGN KEY (`IdC`) REFERENCES `Charge` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `PerformanceTemp`
--
ALTER TABLE `PerformanceTemp`
ADD CONSTRAINT `PerformanceTemp_ibfk_1` FOREIGN KEY (`IdT`) REFERENCES `Temps` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Temps`
--
ALTER TABLE `Temps`
ADD CONSTRAINT `Temps_ibfk_1` FOREIGN KEY (`IdExercice`) REFERENCES `Exercice` (`IdExercice`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
