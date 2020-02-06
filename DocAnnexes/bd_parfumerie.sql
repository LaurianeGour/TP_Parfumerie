-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 06, 2020 at 09:41 AM
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
  `id_article` integer NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_fournisseur` integer NOT NULL REFERENCES `fournisseur`(`id_fournisseur`),
  `id_produit` integer NOT NULL REFERENCES `produit`(`id_produit`),
  `id_volume` integer NOT NULL REFERENCES `volume`(`id_volume`),
  `date_derniere_maj_prix` varchar(50) NOT NULL,
  `url` varchar(150) NOT NULL,
  `prix_achat` float NOT NULL,
  `prix_achat_remise` float NOT NULL,
  `prix_vente` float NOT NULL,
  `prix_vente_remise` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id_article`, `id_fournisseur`, `id_produit`, `id_volume`, `date_derniere_maj_prix`, `url`, `prix_achat`, `prix_achat_remise`, `prix_vente`, `prix_vente_remise`) VALUES
(1, 1, 1, 2, '1 Day ago', 'https://www.nocibe.fr/lancome-la-vie-est-belle-eau-de-parfum-vaporisateur-30-ml-s178461?gclid=EAIaIQobChMI5o7fjM-85wIVxYTVCh3RFAchEAQYASABEgLzqfD_BwE', 56, 54, 57.5, 43.12),
(3, 3, 1, 2, '20 H', 'https://www.sephora.fr/p/la-vie-est-belle---eau-de-parfum-P1067011.html', 56, 54, 58, 58);

-- --------------------------------------------------------

--
-- Table structure for table `articles_commandes`
--

DROP TABLE IF EXISTS `articles_commandes`;
CREATE TABLE IF NOT EXISTS `articles_commandes` (
  `id_client` int(11) NOT NULL REFERENCES client( id_client ),
  `id_article` int(11) NOT NULL REFERENCES article( id_article),
  `id_commande` int(11) NOT NULL REFERENCES commande( id_commande),
  `quantite_commandee` int(11) NOT NULL,
  `prix_unitaire` float NOT NULL,
  `remarque` varchar(150) NOT NULL,
  PRIMARY KEY (`id_client`,`id_article`,`id_commande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `client` (`id_client`, `nom`, `prenom`, `date_naissance`, `adresse`, `montant_depot`) VALUES
(2, 'DRIDI', 'Ghada', '01/01/1995', 'Vourouzé', 15);


-- --------------------------------------------------------

--
-- Structure de la table `client_actif`
--

CREATE TABLE `client_actif` (
  `id_client_actif` int(11) NOT NULL REFERENCES client( id_client ),
  PRIMARY KEY(id_client_actif)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------


--
-- Table structure for table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int(11) NOT NULL AUTO_INCREMENT,
  `id_concierge` int(11) NOT NULL REFERENCES concierge( id_concierge),
  `date_heure` varchar(50) NOT NULL,
  `montant_total` float NOT NULL,
  `montant_depot` float NOT NULL,
  `montant_livraison` float NOT NULL,
  `etat_commande` enum('Current being processed','Processed','Sent','Delivered','Canceled') NOT NULL,
  PRIMARY KEY (`id_commande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `concierge`
--

DROP TABLE IF EXISTS `concierge`;
CREATE TABLE IF NOT EXISTS `concierge` (
  `id_concierge` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_naissance` varchar(50) NOT NULL,
  `adresse_mail` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  PRIMARY KEY (`id_concierge`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id_facture` int(11) NOT NULL AUTO_INCREMENT,
  `id_commande` int(11) NOT NULL REFERENCES commande( id_commande),
  `date_heure` varchar(50) NOT NULL,
  `montant_total` int(11) NOT NULL,
  PRIMARY KEY (`id_facture`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fournisseur`
--

INSERT INTO `fournisseur` (`id_fournisseur`, `abreviation`, `nom_vendeur`) VALUES
(1, 'Ncb', 'Nocibé'),
(2, 'Amz', 'Amazon'),
(3, 'Sph', 'Sephora');

-- --------------------------------------------------------

--
-- Table structure for table `liste_marque`
--

DROP TABLE IF EXISTS `liste_marque`;
CREATE TABLE IF NOT EXISTS `liste_marque` (
  `id_marque` int(11) NOT NULL AUTO_INCREMENT,
  `abreviation` varchar(50) NOT NULL,
  `nom_marque` varchar(50) NOT NULL,
  PRIMARY KEY (`id_marque`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `liste_marque`
--

INSERT INTO `liste_marque` (`id_marque`, `abreviation`, `nom_marque`) VALUES
(1, 'Lancôme', 'LANCOME');

-- --------------------------------------------------------

--
-- Table structure for table `parfum_volume`
--

DROP TABLE IF EXISTS `parfum_volume`;
CREATE TABLE IF NOT EXISTS `parfum_volume` (
  `id_volume` int(11) NOT NULL AUTO_INCREMENT,
  `contenance` int(11) NOT NULL,
  `unitee` varchar(50) NOT NULL,
  PRIMARY KEY (`id_volume`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parfum_volume`
--

INSERT INTO `parfum_volume` (`id_volume`, `contenance`, `unitee`) VALUES
(1, 25, 'ml'),
(2, 30, 'ml'),
(3, 50, 'ml'),
(4, 75, 'ml'),
(5, 100, 'ml');

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `id_type_produit` int(11) NOT NULL  REFERENCES type_produit( id_type_produit ),
  `id_marque` int(11) NOT NULL REFERENCES marque( id_marque ),
  `nom_article` varchar(50) NOT NULL,
  `ingredients` varchar(50) NOT NULL,
  `photo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`id_produit`, `id_type_produit`, `id_marque`, `nom_article`, `ingredients`, `photo`) VALUES
(1, 1, 1, 'La vie est belle', 'Aqua, Vanilla', 'img/la_vie_est_belle.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `type_produit`
--

DROP TABLE IF EXISTS `type_produit`;
CREATE TABLE IF NOT EXISTS `type_produit` (
  `id_type_produit` int(11) NOT NULL AUTO_INCREMENT,
  `abreviation` varchar(50) NOT NULL,
  `type_produit` varchar(50) NOT NULL,
  PRIMARY KEY (`id_type_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_produit`
--

INSERT INTO `type_produit` (`id_type_produit`, `abreviation`, `type_produit`) VALUES
(3, 'Prf', 'Perfume');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
