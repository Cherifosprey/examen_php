-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 05 juil. 2025 à 15:08
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `atelier_couture_db`
--
CREATE DATABASE IF NOT EXISTS `atelier_couture_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `atelier_couture_db`;

-- --------------------------------------------------------

--
-- Structure de la table `approvisionnements`
--

DROP TABLE IF EXISTS `approvisionnements`;
CREATE TABLE IF NOT EXISTS `approvisionnements` (
  `approvisionnement_id` int NOT NULL AUTO_INCREMENT,
  `article_confection_id` int NOT NULL,
  `fournisseur_id` int NOT NULL,
  `utilisateur_id` int NOT NULL,
  `date_approvisionnement` datetime DEFAULT CURRENT_TIMESTAMP,
  `quantite_achetee` int NOT NULL,
  `prix_unitaire_achat` decimal(10,2) NOT NULL,
  `montant_total` decimal(10,2) NOT NULL,
  `observation` text COLLATE utf8mb4_unicode_ci,
  `statut` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'reçu',
  PRIMARY KEY (`approvisionnement_id`),
  KEY `article_confection_id` (`article_confection_id`),
  KEY `fournisseur_id` (`fournisseur_id`),
  KEY `utilisateur_id` (`utilisateur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `approvisionnements`
--

INSERT INTO `approvisionnements` (`approvisionnement_id`, `article_confection_id`, `fournisseur_id`, `utilisateur_id`, `date_approvisionnement`, `quantite_achetee`, `prix_unitaire_achat`, `montant_total`, `observation`, `statut`) VALUES
(1, 3, 2, 1, '2025-06-17 09:29:41', 10, 1300.00, 0.00, NULL, 'reçu');

-- --------------------------------------------------------

--
-- Structure de la table `articles_confection`
--

DROP TABLE IF EXISTS `articles_confection`;
CREATE TABLE IF NOT EXISTS `articles_confection` (
  `article_confection_id` int NOT NULL AUTO_INCREMENT,
  `categorie_id` int NOT NULL,
  `fournisseur_id` int NOT NULL,
  `nom_article` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_unitaire_achat` decimal(10,2) NOT NULL,
  `unite_mesure` int NOT NULL DEFAULT '0',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  `archive` tinyint(1) DEFAULT '0',
  `statut` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'actif',
  `quantite_stock` int NOT NULL,
  PRIMARY KEY (`article_confection_id`),
  KEY `categorie_id` (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `articles_confection`
--

INSERT INTO `articles_confection` (`article_confection_id`, `categorie_id`, `fournisseur_id`, `nom_article`, `prix_unitaire_achat`, `unite_mesure`, `description`, `date_creation`, `archive`, `statut`, `quantite_stock`) VALUES
(3, 6, 2, 'robe', 1199.99, 0, 'robe', '2025-06-17 09:25:31', 0, 'actif', 1230);

-- --------------------------------------------------------

--
-- Structure de la table `articles_vente`
--

DROP TABLE IF EXISTS `articles_vente`;
CREATE TABLE IF NOT EXISTS `articles_vente` (
  `article_vente_id` int NOT NULL AUTO_INCREMENT,
  `categorie_id` int NOT NULL,
  `nom_produit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_vente` decimal(10,2) NOT NULL,
  `quantite_stock` int NOT NULL DEFAULT '0',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  `archive` tinyint(1) DEFAULT '0',
  `statut` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'disponible',
  PRIMARY KEY (`article_vente_id`),
  KEY `categorie_id` (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `articles_vente`
--

INSERT INTO `articles_vente` (`article_vente_id`, `categorie_id`, `nom_produit`, `prix_vente`, `quantite_stock`, `description`, `date_creation`, `archive`, `statut`) VALUES
(1, 6, 'robe', 123.00, 1211, 'fds', '2025-06-17 10:13:16', 0, 'disponible');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categorie_id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `statut` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'actif',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`categorie_id`),
  UNIQUE KEY `nom_categorie` (`libelle`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`categorie_id`, `libelle`, `statut`, `description`) VALUES
(1, 'Tissus', 'actif', '0'),
(2, 'Boutons', 'actif', '0'),
(3, 'Aiguilles', 'actif', '0'),
(4, 'Fils', 'actif', '0'),
(5, 'Costumes', 'actif', '0'),
(6, 'Robes', 'actif', '0'),
(7, 'Costumes Africains', 'actif', '0'),
(8, 'Pantalon', 'actif', '0');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone_portable` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observations` text COLLATE utf8mb4_unicode_ci,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  `archive` tinyint(1) DEFAULT '0',
  `statut` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'actif',
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`client_id`, `nom`, `prenom`, `telephone_portable`, `email`, `adresse`, `photo`, `observations`, `date_creation`, `archive`, `statut`) VALUES
(1, '1', 'cherif', '771920246', 'cherifmoutbaw@gmail.com', 'dcxz', NULL, NULL, '2025-06-17 10:21:59', 0, 'actif');

-- --------------------------------------------------------

--
-- Structure de la table `composition_article_vente`
--

DROP TABLE IF EXISTS `composition_article_vente`;
CREATE TABLE IF NOT EXISTS `composition_article_vente` (
  `composition_id` int NOT NULL AUTO_INCREMENT,
  `article_vente_id` int NOT NULL,
  `article_confection_id` int NOT NULL,
  `quantite_requise` decimal(10,2) NOT NULL,
  `unite_mesure_requise` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`composition_id`),
  UNIQUE KEY `article_vente_id` (`article_vente_id`,`article_confection_id`),
  KEY `article_confection_id` (`article_confection_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

DROP TABLE IF EXISTS `fournisseurs`;
CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `fournisseur_id` int NOT NULL AUTO_INCREMENT,
  `nom_entreprise` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_personne` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  `archive` tinyint(1) DEFAULT '0',
  `statut` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'actif',
  PRIMARY KEY (`fournisseur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`fournisseur_id`, `nom_entreprise`, `email`, `contact_personne`, `telephone`, `adresse`, `photo`, `date_creation`, `archive`, `statut`) VALUES
(2, 'cherif 1', 'cherifmoutbaw@gmail.com', 'cherif 1', '771920246', 'hgfds', NULL, '2025-06-17 09:10:17', 0, 'actif');

-- --------------------------------------------------------

--
-- Structure de la table `productions`
--

DROP TABLE IF EXISTS `productions`;
CREATE TABLE IF NOT EXISTS `productions` (
  `production_id` int NOT NULL AUTO_INCREMENT,
  `article_vente_id` int NOT NULL,
  `utilisateur_id` int NOT NULL,
  `date_production` datetime DEFAULT CURRENT_TIMESTAMP,
  `quantite_produite` int NOT NULL,
  `observation` text COLLATE utf8mb4_unicode_ci,
  `statut` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en_cours',
  PRIMARY KEY (`production_id`),
  KEY `article_vente_id` (`article_vente_id`),
  KEY `utilisateur_id` (`utilisateur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `productions`
--

INSERT INTO `productions` (`production_id`, `article_vente_id`, `utilisateur_id`, `date_production`, `quantite_produite`, `observation`, `statut`) VALUES
(1, 1, 1, '2025-06-17 11:37:41', 1200, NULL, 'en_cours');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `utilisateur_id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mot_de_passe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone_portable` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salaire` decimal(10,2) DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('Gestionnaire','Responsable Stock','Responsable Production','Vendeur') COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  `archive` tinyint(1) DEFAULT '0',
  `statut` enum('actif','archivé') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'actif',
  PRIMARY KEY (`utilisateur_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`utilisateur_id`, `nom`, `prenom`, `email`, `mot_de_passe`, `telephone_portable`, `adresse`, `salaire`, `photo`, `role`, `date_creation`, `archive`, `statut`) VALUES
(1, 'Admin', 'Principal', 'admin@atelier.com', '$2y$10$AaNTggGiPwPlrvvhmmO9o.wY9UBRFcJqzfCJfnOVBdpHz2VQy.Cwi', '0000000000', NULL, NULL, NULL, 'Gestionnaire', '2025-06-14 04:02:39', 0, 'actif'),
(2, 'Cherif', 'Moutalib', 'cherifmoutvlib@gmail.com', '$2y$10$AaNTggGiPwPlrvvhmmO9o.wY9UBRFcJqzfCJfnOVBdpHz2VQy.Cwi', '12345679', 'Sacre coeur', 99999999.99, NULL, 'Vendeur', '2025-06-16 09:39:13', 0, 'actif');

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

DROP TABLE IF EXISTS `ventes`;
CREATE TABLE IF NOT EXISTS `ventes` (
  `vente_id` int NOT NULL AUTO_INCREMENT,
  `article_vente_id` int DEFAULT NULL,
  `client_id` int NOT NULL,
  `utilisateur_id` int NOT NULL,
  `date_vente` datetime DEFAULT CURRENT_TIMESTAMP,
  `quantite` int NOT NULL,
  `prix_unitaire_vente` decimal(10,2) NOT NULL,
  `total_vente` decimal(10,2) NOT NULL,
  `observation` text COLLATE utf8mb4_unicode_ci,
  `details_produits_vendus` json DEFAULT NULL,
  `statut` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en_cours',
  `mode_paiement` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`vente_id`),
  KEY `article_vente_id` (`article_vente_id`),
  KEY `client_id` (`client_id`),
  KEY `utilisateur_id` (`utilisateur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ventes`
--

INSERT INTO `ventes` (`vente_id`, `article_vente_id`, `client_id`, `utilisateur_id`, `date_vente`, `quantite`, `prix_unitaire_vente`, `total_vente`, `observation`, `details_produits_vendus`, `statut`, `mode_paiement`) VALUES
(2, NULL, 1, 1, '2025-06-17 11:46:41', 0, 0.00, 123.00, NULL, '[{\"nom_produit\": \"robe\", \"quantite_vendue\": 1, \"article_vente_id\": 1, \"prix_unitaire_vente\": \"123.00\"}]', 'paye', 'especes');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `approvisionnements`
--
ALTER TABLE `approvisionnements`
  ADD CONSTRAINT `approvisionnements_ibfk_1` FOREIGN KEY (`article_confection_id`) REFERENCES `articles_confection` (`article_confection_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `approvisionnements_ibfk_2` FOREIGN KEY (`fournisseur_id`) REFERENCES `fournisseurs` (`fournisseur_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `approvisionnements_ibfk_3` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`utilisateur_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `articles_confection`
--
ALTER TABLE `articles_confection`
  ADD CONSTRAINT `articles_confection_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`categorie_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `articles_vente`
--
ALTER TABLE `articles_vente`
  ADD CONSTRAINT `articles_vente_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`categorie_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `productions`
--
ALTER TABLE `productions`
  ADD CONSTRAINT `productions_ibfk_1` FOREIGN KEY (`article_vente_id`) REFERENCES `articles_vente` (`article_vente_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `productions_ibfk_2` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`utilisateur_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD CONSTRAINT `ventes_ibfk_1` FOREIGN KEY (`article_vente_id`) REFERENCES `articles_vente` (`article_vente_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `ventes_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `ventes_ibfk_3` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`utilisateur_id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
