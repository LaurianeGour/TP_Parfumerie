-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 05, 2020 at 05:01 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_parfumerie`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id_article` int(11) NOT NULL,
  `id_fournisseur` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `id_volume` int(11) NOT NULL,
  `date_derniere_maj_prix` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `prix_achat` float NOT NULL,
  `prix_achat_remise` float NOT NULL,
  `prix_vente` float NOT NULL,
  `prix_vente_remise` float NOT NULL,
  PRIMARY KEY (`id_article`),
  KEY `id_fournisseur` (`id_fournisseur`),
  KEY `id_produit` (`id_produit`),
  KEY `id_volume` (`id_volume`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `articles_commandes`
--

DROP TABLE IF EXISTS `articles_commandes`;
CREATE TABLE IF NOT EXISTS `articles_commandes` (
  `id_client` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  `quantite_commandee` int(11) NOT NULL,
  `prix_unitaire` float NOT NULL,
  `remarque` varchar(50) NOT NULL,
  PRIMARY KEY (`id_client`,`id_article`,`id_commande`),
  KEY `id_article` (`id_article`),
  KEY `id_commande` (`id_commande`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_naissance` varchar(50) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `montant_depot` float NOT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int(11) NOT NULL,
  `id_concierge` int(11) NOT NULL,
  `date_heure` varchar(50) NOT NULL,
  `montant_total` float NOT NULL,
  `montant_depot` float NOT NULL,
  `montant_livraison` float NOT NULL,
  `etat_commande` enum('Current being processed','Processed','Sent','Delivered','Canceled') NOT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `id_concierge` (`id_concierge`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `concierge`
--

DROP TABLE IF EXISTS `concierge`;
CREATE TABLE IF NOT EXISTS `concierge` (
  `id_concierge` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_naissance` varchar(50) NOT NULL,
  `adresse_mail` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  PRIMARY KEY (`id_concierge`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conversion_monnaie`
--

DROP TABLE IF EXISTS `conversion_monnaie`;
CREATE TABLE IF NOT EXISTS `conversion_monnaie` (
  `type_monnaie_entree` varchar(3) NOT NULL,
  `type_monnaie_sortie` varchar(3) NOT NULL,
  `taux_conversion_es` float NOT NULL,
  `taux_conversion_se` float NOT NULL,
  PRIMARY KEY (`type_monnaie_sortie`,`type_monnaie_entree`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id_facture` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  `date_heure` varchar(50) NOT NULL,
  `montant_total` int(11) NOT NULL,
  PRIMARY KEY (`id_facture`),
  KEY `id_commande` (`id_commande`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE IF NOT EXISTS `fournisseur` (
  `id_fournisseur` int(11) NOT NULL AUTO_INCREMENT,
  `abreviation` varchar(50) NOT NULL,
  `nom_vendeur` varchar(50) NOT NULL,
  PRIMARY KEY (`id_fournisseur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `liste_marque`
--

DROP TABLE IF EXISTS `liste_marque`;
CREATE TABLE IF NOT EXISTS `liste_marque` (
  `id_marque` int(11) NOT NULL,
  `abreviation` varchar(50) NOT NULL,
  `nom_marque` varchar(50) NOT NULL,
  PRIMARY KEY (`id_marque`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parfum_volume`
--

DROP TABLE IF EXISTS `parfum_volume`;
CREATE TABLE IF NOT EXISTS `parfum_volume` (
  `id_volume` int(11) NOT NULL,
  `contenance` int(11) NOT NULL,
  `unitee` varchar(50) NOT NULL,
  PRIMARY KEY (`id_volume`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(11) NOT NULL,
  `id_type_produit` int(11) NOT NULL,
  `id_marque` int(11) NOT NULL,
  `nom_article` varchar(50) NOT NULL,
  `ingredients` varchar(50) NOT NULL,
  `photo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `id_type_produit` (`id_type_produit`),
  KEY `id_marque` (`id_marque`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `type_produit`
--

DROP TABLE IF EXISTS `type_produit`;
CREATE TABLE IF NOT EXISTS `type_produit` (
  `id_type_produit` int(11) NOT NULL,
  `abreviation` varchar(50) NOT NULL,
  `type_produit` varchar(50) NOT NULL,
  PRIMARY KEY (`id_type_produit`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
