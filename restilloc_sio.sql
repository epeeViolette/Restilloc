-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 11 juin 2023 à 11:04
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `restilloc_sio`
--

-- --------------------------------------------------------

--
-- Structure de la table `avoirrendezvous`
--

DROP TABLE IF EXISTS `avoirrendezvous`;
CREATE TABLE IF NOT EXISTS `avoirrendezvous` (
  `id_exp` int(11) NOT NULL,
  `id_gar` int(11) NOT NULL,
  `id_cli` int(11) NOT NULL,
  `immatriculation` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dateRDV` datetime DEFAULT NULL,
  PRIMARY KEY (`id_exp`,`id_gar`,`id_cli`,`immatriculation`),
  KEY `avoirRendezVous_Garages0_FK` (`id_gar`),
  KEY `avoirRendezVous_Clients1_FK` (`id_cli`),
  KEY `avoirRendezVous_Vehicules2_FK` (`immatriculation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `avoirrendezvous`
--

INSERT INTO `avoirrendezvous` (`id_exp`, `id_gar`, `id_cli`, `immatriculation`, `dateRDV`) VALUES
(3, 5, 3, 'JJ-123-ML', '2022-03-31 09:39:00'),
(4, 5, 2, 'RR-258-SS', '2022-04-06 10:57:00'),
(5, 4, 10, 'U23568QXYuu', '2023-04-25 16:17:00'),
(9, 2, 7, 'JJ-123-ML', '2023-05-17 19:27:00'),
(11, 8, 8, 'BA-222-BA', '2023-05-10 14:25:00');

-- --------------------------------------------------------

--
-- Structure de la table `cabinets_expertise`
--

DROP TABLE IF EXISTS `cabinets_expertise`;
CREATE TABLE IF NOT EXISTS `cabinets_expertise` (
  `id_cab` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cab` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse_cab` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cp_cab` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `ville_cab` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `telephone_cab` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax_cab` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_web_cab` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_cab`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `cabinets_expertise`
--

INSERT INTO `cabinets_expertise` (`id_cab`, `nom_cab`, `adresse_cab`, `cp_cab`, `ville_cab`, `telephone_cab`, `fax_cab`, `site_web_cab`) VALUES
(1, 'Dupont et Frères Expertise', '5', '57000', 'Metz', '03 88 12 58 78', NULL, NULL),
(2, 'Nisse et Fils Experts', '12', '54000', 'Nancy', '03 54 78 96 54', NULL, NULL),
(3, 'Axa Expertise', '14', '88000', 'Strasbourg', '03 88 89 85 87', NULL, NULL),
(4, 'BFG Assuraces', '65', '54000', 'Nancy', '03 84 78 96 54', NULL, NULL),
(5, 'Experts et Cie', '45 rue des Ours', '13200', 'Marseille', '03 88 88 88 88', NULL, 'www.experts.com'),
(6, 'DAX - Expertise', '6, avenue de la Paix', '67000', 'Strasbourg', '03 88 88 88 88', NULL, 'www.experts.com'),
(7, 'DINO Experts et Co', '3, Boulevard d\'Alsace', '57000', 'Metz', '4444556688', NULL, '1122336655'),
(9, 'B.R.A.D Experts', '6 rue des Moulins', '67000', 'Strasbourg', '112233445566', NULL, 'brad.experts.com'),
(10, 'Dylan cabinet', '46 Boulevard Clemenceau', '67000', 'Strasbourg', '0636137969', NULL, '');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id_cli` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cli` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom_cli` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse_cli` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cp_cli` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ville_cli` varchar(75) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `telephone_cli` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `portable_cli` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_cli` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_cli`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id_cli`, `nom_cli`, `prenom_cli`, `adresse_cli`, `cp_cli`, `ville_cli`, `telephone_cli`, `portable_cli`, `email_cli`) VALUES
(1, 'PINARD', 'Léo', '14, Rue des cerisiers', '57400', 'Sarrebourg', '03 87 87 98 25', '06 15 47 87 98', 'leo.pinard@hotmail.fr'),
(2, 'WOLF', 'Marie', '16, Rue des Lilas', '88100', 'Saint Di? des Vosges', '03 88 12 58 78', '06 25 48 47 32', 'marie.wolf@hotmail.com'),
(3, 'SOUDANI', 'Driss', '234, dans une rue', '57400', 'BUHL-LORRAINE', '03 88 88 88 88', '06 99 99 99 99', 'driss57000@hotmail.fr'),
(4, 'TROSKI', 'Alain', '2, Boulevard d\'europe', '88100', 'SAINT-DIÃ©-DES-VOSGES', '03 88 88 88 88', '06 99 99 99 99', 'driss57000@hotmail.fr'),
(5, 'BRADOVIC', 'Andy', '7, Boulevard Maroucelle', '57400', 'BUHL-LORRAINE', '1122558877', '1133556688', 'driss57000@hotmail.fr'),
(7, 'MUNCH', 'Sarah', '18, rue des Ã©tincelles', '57000', 'PAGNY-SUR-MOSELLE', '1122554477', '7788996655', 'sarah.munch@gmail.com'),
(8, 'WALTER', 'Karl', '6 rue St Michel', '67700', 'OTTERSWILLER', '0000000000', '1111111111', 'test@gmail.com'),
(9, 'AAAAAA', 'Aaaaaa', 'aaa', '67700', 'SSSSS', '0000000000', '1111111111', 'test@gmail.com'),
(10, 'OIKNINE', 'Dylan', '46 Boulevard Clemenceau', '67000', 'STRASBOURG', '0636137969', '', 'oikninedylan@gmail.fr');

-- --------------------------------------------------------

--
-- Structure de la table `concerner`
--

DROP TABLE IF EXISTS `concerner`;
CREATE TABLE IF NOT EXISTS `concerner` (
  `reference` int(11) NOT NULL,
  `ref_dossier` int(11) NOT NULL,
  `id_pres` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`reference`,`ref_dossier`,`id_pres`),
  KEY `Concerne_pree_piece0_FK` (`ref_dossier`,`id_pres`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `dossiersderestitution`
--

DROP TABLE IF EXISTS `dossiersderestitution`;
CREATE TABLE IF NOT EXISTS `dossiersderestitution` (
  `ref_dossier` int(11) NOT NULL AUTO_INCREMENT COMMENT 'numéro de dossier',
  `dateCreation` date DEFAULT NULL,
  `immatriculation` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ref_dossier`),
  UNIQUE KEY `DossiersDeRestitution_Vehicule_AK` (`immatriculation`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `dossiersderestitution`
--

INSERT INTO `dossiersderestitution` (`ref_dossier`, `dateCreation`, `immatriculation`) VALUES
(1, '2023-05-09', 'JJ-123-ML');

-- --------------------------------------------------------

--
-- Structure de la table `experts`
--

DROP TABLE IF EXISTS `experts`;
CREATE TABLE IF NOT EXISTS `experts` (
  `id_exp` int(11) NOT NULL AUTO_INCREMENT,
  `nom_exp` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom_exp` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `portable_exp` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_exp` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_cab` int(11) NOT NULL,
  `login_exp` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `password_exp` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_exp`),
  KEY `Experts_Cabinets_expertise_FK` (`id_cab`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `experts`
--

INSERT INTO `experts` (`id_exp`, `nom_exp`, `prenom_exp`, `portable_exp`, `email_exp`, `id_cab`, `login_exp`, `password_exp`) VALUES
(2, 'DUPOND', 'Marcel', '06 12 58 69 12', 'marcel.dupond@gmail.com', 1, '', ''),
(3, 'DUCLOS', 'David', '06 87 99 55 33', 'david.duclos@gmail.com', 1, '', ''),
(4, 'MISKALI', 'Antoine', '06 44 77 88 25', 'antoine.miskali@gmail.com', 3, '', ''),
(5, 'FINDER', 'Mike', '06 12 99 69 12', 'mike.finder@gmail.com', 3, '', ''),
(6, 'MORISSON', 'Julie', '06 11 54 87 98', 'julie.morisson@hotmail.fr', 3, '', ''),
(7, 'WELSH', 'Marie', '03 88 88 88 88', 'aaa@bbb.com', 5, '', ''),
(8, 'ASSURTOUT', 'Richard', '03 88 88 88 88', 'driss57000@hotmail.fr', 6, '', ''),
(9, 'ILPEUTRIEN', 'Faire', '1122554433', 'driss57000@hotmail.fr', 7, '', ''),
(10, 'DINADO', 'RÃ©mi', '1144559977', 'dinado@hotmail.fr', 9, 'rdinado', 'XXXXXX'),
(11, 'Oiknine', 'Dylan', '0636137969', 'oikninedylan@gmail.com', 3, 'dylan98', '123456');

-- --------------------------------------------------------

--
-- Structure de la table `garages`
--

DROP TABLE IF EXISTS `garages`;
CREATE TABLE IF NOT EXISTS `garages` (
  `id_gar` int(11) NOT NULL AUTO_INCREMENT,
  `nom_gar` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse_gar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cp_gar` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `ville_gar` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `telephone_gar` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax_gar` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_web_gar` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_gar`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `garages`
--

INSERT INTO `garages` (`id_gar`, `nom_gar`, `adresse_gar`, `cp_gar`, `ville_gar`, `telephone_gar`, `fax_gar`, `site_web_gar`) VALUES
(1, 'LSA Automobile', '9, rue des cordeliers', '57070', 'Metz', '03 87 25 14 48', NULL, NULL),
(2, 'Volvo Car', '12, Avenue des rois', '54010', 'Pont à Mousson', '03 84 18 13 54', NULL, NULL),
(3, 'Renault Concession', '63, Boulevard des Capucines', '67000', 'Strasbourg', '03 88 11 58 25', NULL, NULL),
(4, 'Peugeot Automobile', '8, Grand rue', '57007', 'Metz', '03 87 25 48 98', NULL, NULL),
(5, 'BJA Automobiles', '36, rue des haricots', '57000', 'Metz', '03 88 88 88 88', NULL, 'www.bja.fr'),
(6, 'JBL Auto', '6, avenue de courcelle', '67043', 'Bischheim', '03 88 88 88 88', NULL, 'www.jblauto.com'),
(7, 'Auto de l\'EST', '10 rue Mangin', '67000', 'Strasbourg', '1122554477', NULL, '4455221177'),
(8, 'Dylan Garage', '46 Boulevard Clemenceau', '67000', 'Strasbourg', '0636137969', NULL, '');

-- --------------------------------------------------------

--
-- Structure de la table `marquesvehicules`
--

DROP TABLE IF EXISTS `marquesvehicules`;
CREATE TABLE IF NOT EXISTS `marquesvehicules` (
  `id_marque` int(11) NOT NULL AUTO_INCREMENT,
  `nom_marque` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_marque`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `marquesvehicules`
--

INSERT INTO `marquesvehicules` (`id_marque`, `nom_marque`) VALUES
(1, 'VOLVO'),
(2, 'RENAULT'),
(3, 'PEUGEOT'),
(4, 'AUDI'),
(5, 'FIAT'),
(6, 'OPEL');

-- --------------------------------------------------------

--
-- Structure de la table `modelesvehicules`
--

DROP TABLE IF EXISTS `modelesvehicules`;
CREATE TABLE IF NOT EXISTS `modelesvehicules` (
  `id_modele` int(11) NOT NULL AUTO_INCREMENT,
  `nom_modele` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_marque` int(11) NOT NULL,
  PRIMARY KEY (`id_modele`),
  KEY `Modeles_Marques_FK` (`id_marque`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `modelesvehicules`
--

INSERT INTO `modelesvehicules` (`id_modele`, `nom_modele`, `id_marque`) VALUES
(1, 'XC 40', 1),
(2, 'XC 60', 1),
(3, 'Megane', 2),
(4, 'Koleos', 2),
(5, 'Corsa', 6),
(6, 'TT', 4),
(7, 'A4', 4),
(8, 'Panda', 5),
(9, '307', 3),
(10, '3008', 3);

-- --------------------------------------------------------

--
-- Structure de la table `rapportexpertise`
--

DROP TABLE IF EXISTS `rapportexpertise`;
CREATE TABLE IF NOT EXISTS `rapportexpertise` (
  `id_rapport` int(11) NOT NULL AUTO_INCREMENT,
  `ref_dossier` int(11) NOT NULL,
  `immatriculation` text NOT NULL,
  `rapport_expert` text NOT NULL,
  PRIMARY KEY (`id_rapport`),
  KEY `ref_dossier` (`ref_dossier`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rapportexpertise`
--

INSERT INTO `rapportexpertise` (`id_rapport`, `ref_dossier`, `immatriculation`, `rapport_expert`) VALUES
(59, 1, 'JJ-123-ML', 'bonjour');

-- --------------------------------------------------------

--
-- Structure de la table `vehicules`
--

DROP TABLE IF EXISTS `vehicules`;
CREATE TABLE IF NOT EXISTS `vehicules` (
  `id_vehicule` int(11) NOT NULL AUTO_INCREMENT,
  `immatriculation` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dateMEC` date DEFAULT NULL,
  `motorisation` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `puissance` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `id_cli` int(11) NOT NULL,
  `id_marque` int(11) NOT NULL,
  `id_modele` int(11) NOT NULL,
  PRIMARY KEY (`id_vehicule`),
  UNIQUE KEY `immatriculation` (`immatriculation`),
  KEY `Vehicules_Clients_FK` (`id_cli`),
  KEY `Vehicules_Marques0_FK` (`id_marque`),
  KEY `Vehicules_Modeles1_FK` (`id_modele`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `vehicules`
--

INSERT INTO `vehicules` (`id_vehicule`, `immatriculation`, `dateMEC`, `motorisation`, `puissance`, `id_cli`, `id_marque`, `id_modele`) VALUES
(1, 'BA-222-BA', '2023-04-07', 'Diesel', '', 5, 4, 6),
(4, 'JJ-123-ML', '2022-03-25', 'Diesel', '', 3, 5, 8),
(7, 'MM-555-NN', '2022-03-15', 'Essence', '', 2, 6, 5),
(8, 'RR-258-SS', '2022-04-04', 'Diesel', '', 4, 2, 4),
(9, 'SS-351-DE', '2022-10-12', 'Diesel', '', 8, 4, 6),
(11, 'U23568QXYuu', '2023-03-23', 'Essence', '', 10, 6, 5);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avoirrendezvous`
--
ALTER TABLE `avoirrendezvous`
  ADD CONSTRAINT `avoirRendezVous_Clients1_FK` FOREIGN KEY (`id_cli`) REFERENCES `clients` (`id_cli`),
  ADD CONSTRAINT `avoirRendezVous_Experts_FK` FOREIGN KEY (`id_exp`) REFERENCES `experts` (`id_exp`),
  ADD CONSTRAINT `avoirRendezVous_Garages0_FK` FOREIGN KEY (`id_gar`) REFERENCES `garages` (`id_gar`),
  ADD CONSTRAINT `avoirRendezVous_Vehicules2_FK` FOREIGN KEY (`immatriculation`) REFERENCES `vehicules` (`immatriculation`);

--
-- Contraintes pour la table `concerner`
--
ALTER TABLE `concerner`
  ADD CONSTRAINT `Concerne_Pieces_FK` FOREIGN KEY (`reference`) REFERENCES `pieces` (`reference`),
  ADD CONSTRAINT `Concerne_pree_piece0_FK` FOREIGN KEY (`ref_dossier`,`id_pres`) REFERENCES `pree_piece` (`ref_dossier`, `id_pres`);

--
-- Contraintes pour la table `dossiersderestitution`
--
ALTER TABLE `dossiersderestitution`
  ADD CONSTRAINT `DossiersDeRestitution_Vehicule_FK` FOREIGN KEY (`immatriculation`) REFERENCES `vehicules` (`immatriculation`);

--
-- Contraintes pour la table `experts`
--
ALTER TABLE `experts`
  ADD CONSTRAINT `Experts_Cabinets_expertise_FK` FOREIGN KEY (`id_cab`) REFERENCES `cabinets_expertise` (`id_cab`);

--
-- Contraintes pour la table `modelesvehicules`
--
ALTER TABLE `modelesvehicules`
  ADD CONSTRAINT `Modeles_Marques_FK` FOREIGN KEY (`id_marque`) REFERENCES `marquesvehicules` (`id_marque`);

--
-- Contraintes pour la table `rapportexpertise`
--
ALTER TABLE `rapportexpertise`
  ADD CONSTRAINT `rapportexpertise_ibfk_1` FOREIGN KEY (`ref_dossier`) REFERENCES `dossiersderestitution` (`ref_dossier`);

--
-- Contraintes pour la table `vehicules`
--
ALTER TABLE `vehicules`
  ADD CONSTRAINT `Vehicules_Clients_FK` FOREIGN KEY (`id_cli`) REFERENCES `clients` (`id_cli`),
  ADD CONSTRAINT `Vehicules_Marques0_FK` FOREIGN KEY (`id_marque`) REFERENCES `marquesvehicules` (`id_marque`),
  ADD CONSTRAINT `Vehicules_Modeles1_FK` FOREIGN KEY (`id_modele`) REFERENCES `modelesvehicules` (`id_modele`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
