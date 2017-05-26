-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 26 Mai 2017 à 19:04
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
-- Structure de la table `AffiliationPerformanceSeance`
--

CREATE TABLE IF NOT EXISTS `AffiliationPerformanceSeance` (
  `IdPerformance` int(11) NOT NULL,
  `IdSeance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `AffiliationPerformanceSeance`
--

INSERT INTO `AffiliationPerformanceSeance` (`IdPerformance`, `IdSeance`) VALUES
(50, 1),
(51, 2),
(52, 2),
(53, 2),
(54, 73);

-- --------------------------------------------------------

--
-- Structure de la table `AffiliationSeanceExercice`
--

CREATE TABLE IF NOT EXISTS `AffiliationSeanceExercice` (
  `IdSeance` int(11) NOT NULL,
  `IdExercice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `AffiliationSeanceExercice`
--

INSERT INTO `AffiliationSeanceExercice` (`IdSeance`, `IdExercice`) VALUES
(2, 2),
(2, 2),
(2, 34),
(2, 2),
(2, 33),
(1, 32),
(73, 55);

-- --------------------------------------------------------

--
-- Structure de la table `Exercice`
--

CREATE TABLE IF NOT EXISTS `Exercice` (
`IdExercice` int(11) NOT NULL,
  `Titre` varchar(128) NOT NULL,
  `Description` varchar(512) NOT NULL,
  `Type` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Exercice`
--

INSERT INTO `Exercice` (`IdExercice`, `Titre`, `Description`, `Type`) VALUES
(2, 'Course a pied', 'Great', 2),
(32, 'Pompes', 'Flexion des brass', 1),
(33, 'Sprint', 'Court très vite', 2),
(34, 'Burpees', 'Polyarticulaire', 1),
(55, 'Dips', 'Travaille les triceps', 1);

-- --------------------------------------------------------

--
-- Structure de la table `NoteJour`
--

CREATE TABLE IF NOT EXISTS `NoteJour` (
  `Jour` date NOT NULL,
  `Note` int(11) NOT NULL,
  `Commentaires` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `NoteJour`
--

INSERT INTO `NoteJour` (`Jour`, `Note`, `Commentaires`) VALUES
('2017-05-24', 6, 'Ca peut aller'),
('2017-05-25', 4, 'Meh'),
('2017-05-26', 8, 'Projet web fini');

-- --------------------------------------------------------

--
-- Structure de la table `Performance`
--

CREATE TABLE IF NOT EXISTS `Performance` (
`IdPerformance` int(11) NOT NULL,
  `IdExercice` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Performance`
--

INSERT INTO `Performance` (`IdPerformance`, `IdExercice`) VALUES
(53, 2),
(50, 32),
(52, 33),
(51, 34),
(54, 55);

-- --------------------------------------------------------

--
-- Structure de la table `PerformanceCharge`
--

CREATE TABLE IF NOT EXISTS `PerformanceCharge` (
`IdPerformanceCharge` int(11) NOT NULL,
  `IdPerformance` int(11) NOT NULL,
  `Series` int(11) NOT NULL,
  `Repetition` int(11) NOT NULL,
  `Charge` int(11) NOT NULL,
  `Jour` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `PerformanceCharge`
--

INSERT INTO `PerformanceCharge` (`IdPerformanceCharge`, `IdPerformance`, `Series`, `Repetition`, `Charge`, `Jour`) VALUES
(25, 50, 4, 12, 20, '2017-05-26'),
(26, 51, 4, 12, 0, '2017-05-26'),
(27, 54, 4, 12, 0, '2017-05-26');

-- --------------------------------------------------------

--
-- Structure de la table `PerformanceTemps`
--

CREATE TABLE IF NOT EXISTS `PerformanceTemps` (
`IdPerformanceTemps` int(11) NOT NULL,
  `IdPerformance` int(11) NOT NULL,
  `Temps` int(11) NOT NULL,
  `Jour` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `PerformanceTemps`
--

INSERT INTO `PerformanceTemps` (`IdPerformanceTemps`, `IdPerformance`, `Temps`, `Jour`) VALUES
(16, 52, 120, '2017-05-26'),
(17, 53, 900, '2017-05-26');

-- --------------------------------------------------------

--
-- Structure de la table `Seance`
--

CREATE TABLE IF NOT EXISTS `Seance` (
`IdSeance` int(11) NOT NULL,
  `Titre` varchar(128) NOT NULL,
  `Objectif` varchar(512) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Seance`
--

INSERT INTO `Seance` (`IdSeance`, `Titre`, `Objectif`) VALUES
(1, 'Seance pectoraux', 'On travaille les pectoraux'),
(2, 'Seance jambes', 'Travailler les jambes'),
(73, 'Seance triceps', 'Travail des triceps');

-- --------------------------------------------------------

--
-- Structure de la table `TypeExercice`
--

CREATE TABLE IF NOT EXISTS `TypeExercice` (
`IdType` int(11) NOT NULL,
  `type` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `TypeExercice`
--

INSERT INTO `TypeExercice` (`IdType`, `type`) VALUES
(1, 'charge'),
(2, 'temps');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `AffiliationPerformanceSeance`
--
ALTER TABLE `AffiliationPerformanceSeance`
 ADD KEY `IdPerformance` (`IdPerformance`), ADD KEY `IdSeance` (`IdSeance`);

--
-- Index pour la table `AffiliationSeanceExercice`
--
ALTER TABLE `AffiliationSeanceExercice`
 ADD KEY `IdSeance` (`IdSeance`), ADD KEY `IdExercice` (`IdExercice`);

--
-- Index pour la table `Exercice`
--
ALTER TABLE `Exercice`
 ADD PRIMARY KEY (`IdExercice`), ADD KEY `Id` (`IdExercice`), ADD KEY `Id_2` (`IdExercice`), ADD KEY `IdExercice` (`IdExercice`), ADD KEY `Type` (`Type`);

--
-- Index pour la table `NoteJour`
--
ALTER TABLE `NoteJour`
 ADD PRIMARY KEY (`Jour`);

--
-- Index pour la table `Performance`
--
ALTER TABLE `Performance`
 ADD PRIMARY KEY (`IdPerformance`), ADD KEY `IdExercice` (`IdExercice`);

--
-- Index pour la table `PerformanceCharge`
--
ALTER TABLE `PerformanceCharge`
 ADD PRIMARY KEY (`IdPerformanceCharge`), ADD KEY `IdPerformance` (`IdPerformance`);

--
-- Index pour la table `PerformanceTemps`
--
ALTER TABLE `PerformanceTemps`
 ADD PRIMARY KEY (`IdPerformanceTemps`), ADD KEY `IdPerformance` (`IdPerformance`);

--
-- Index pour la table `Seance`
--
ALTER TABLE `Seance`
 ADD PRIMARY KEY (`IdSeance`);

--
-- Index pour la table `TypeExercice`
--
ALTER TABLE `TypeExercice`
 ADD PRIMARY KEY (`IdType`), ADD KEY `IdType` (`IdType`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Exercice`
--
ALTER TABLE `Exercice`
MODIFY `IdExercice` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT pour la table `Performance`
--
ALTER TABLE `Performance`
MODIFY `IdPerformance` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT pour la table `PerformanceCharge`
--
ALTER TABLE `PerformanceCharge`
MODIFY `IdPerformanceCharge` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT pour la table `PerformanceTemps`
--
ALTER TABLE `PerformanceTemps`
MODIFY `IdPerformanceTemps` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `Seance`
--
ALTER TABLE `Seance`
MODIFY `IdSeance` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT pour la table `TypeExercice`
--
ALTER TABLE `TypeExercice`
MODIFY `IdType` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `AffiliationPerformanceSeance`
--
ALTER TABLE `AffiliationPerformanceSeance`
ADD CONSTRAINT `AffiliationPerformanceSeance_ibfk_1` FOREIGN KEY (`IdPerformance`) REFERENCES `Performance` (`IdPerformance`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `AffiliationPerformanceSeance_ibfk_2` FOREIGN KEY (`IdSeance`) REFERENCES `Seance` (`IdSeance`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `AffiliationSeanceExercice`
--
ALTER TABLE `AffiliationSeanceExercice`
ADD CONSTRAINT `AffiliationSeanceExercice_ibfk_1` FOREIGN KEY (`IdSeance`) REFERENCES `Seance` (`IdSeance`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `AffiliationSeanceExercice_ibfk_2` FOREIGN KEY (`IdExercice`) REFERENCES `Exercice` (`IdExercice`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Exercice`
--
ALTER TABLE `Exercice`
ADD CONSTRAINT `Exercice_ibfk_1` FOREIGN KEY (`Type`) REFERENCES `TypeExercice` (`IdType`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `PerformanceCharge`
--
ALTER TABLE `PerformanceCharge`
ADD CONSTRAINT `PerformanceCharge_ibfk_1` FOREIGN KEY (`IdPerformance`) REFERENCES `Performance` (`IdPerformance`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `PerformanceTemps`
--
ALTER TABLE `PerformanceTemps`
ADD CONSTRAINT `PerformanceTemps_ibfk_1` FOREIGN KEY (`IdPerformance`) REFERENCES `Performance` (`IdPerformance`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
