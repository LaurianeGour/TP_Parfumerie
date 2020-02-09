-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 09 fév. 2020 à 18:44
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bd_parfumerie`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id_article` int(11) NOT NULL,
  `id_fournisseur` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `id_volume` int(11) NOT NULL,
  `date_derniere_maj_prix` varchar(50) NOT NULL,
  `url` varchar(150) NOT NULL,
  `prix_achat` float NOT NULL,
  `prix_achat_remise` float NOT NULL,
  `prix_vente` float NOT NULL,
  `prix_vente_remise` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_article`, `id_fournisseur`, `id_produit`, `id_volume`, `date_derniere_maj_prix`, `url`, `prix_achat`, `prix_achat_remise`, `prix_vente`, `prix_vente_remise`) VALUES
(1, 1, 1, 2, 'Il y a 1 jour', 'https://www.nocibe.fr/lancome-la-vie-est-belle-eau-de-parfum-vaporisateur-30-ml-s178461?gclid=EAIaIQobChMI5o7fjM-85wIVxYTVCh3RFAchEAQYASABEgLzqfD_BwE', 56, 54, 57.5, 43.12),
(3, 3, 1, 2, '20 H', 'https://www.sephora.fr/p/la-vie-est-belle---eau-de-parfum-P1067011.html', 56, 54, 58, 58),
(4, 3, 2, 12, 'Aujourd\'hui', 'https://www.sephora.fr/p/mascara-hypnose-P3330013.html', 32, 24, 40, 35),
(5, 3, 2, 13, 'Aujourd\'hui', 'https://www.sephora.fr/p/lancome-hypnose---mascara-mini-438787.html', 14, 14, 21, 21),
(6, 3, 2, 12, 'Il y a 2 jours', 'https://www.nocibe.fr/lancome-hypnose-mascara-01-noir-hypnotic-s224755', 31.9, 31.9, 39, 39),
(7, 3, 2, 12, 'Il y a 1 jour', 'https://www.marionnaud.fr/maquillage/yeux/mascara/hypnose-hypnose-volume-a-porter-mascara-lancome/p/100679217', 33.99, 25.49, 43, 30),
(8, 3, 3, 14, 'Aujourd\'hui', 'https://www.sephora.fr/p/n°5---eau-de-parfum-P96315.html', 69, 51.75, 80, 67),
(9, 3, 3, 15, 'Aujourd\'hui', 'https://www.sephora.fr/p/n°5---eau-de-parfum-P96315.html', 97, 72.75, 115, 95),
(10, 1, 3, 14, 'Il y a un jour', 'https://www.nocibe.fr/chanel-chanel-n-5-eau-de-parfum-vaporisateur-vaporisateur-35-ml-s205531', 68.9, 51.67, 75, 67);

-- --------------------------------------------------------

--
-- Structure de la table `articles_commandes`
--

CREATE TABLE `articles_commandes` (
  `id_client` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  `quantite_commandee` int(11) NOT NULL,
  `prix_total` float NOT NULL,
  `remarque` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles_commandes`
--

INSERT INTO `articles_commandes` (`id_client`, `id_article`, `id_commande`, `quantite_commandee`, `prix_total`, `remarque`) VALUES
(8, 1, 2, 1, 43.12, ''),
(8, 5, 2, 2, 42, ''),
(8, 10, 1, 2, 134, '');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_naissance` varchar(50) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `montant_depot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom`, `prenom`, `date_naissance`, `adresse`, `montant_depot`) VALUES
(2, 'DRIDI', 'Ghada', '02/15/1995', 'Cité universitaire de Vaurouzé 72000', 152.03),
(7, 'GOURAUD', 'Lauriane', '27/10/1998', '39 Boulevard ... 72000 Le Mans', 63.12),
(8, 'PETIT', 'Florian', '14/08/1982', 'Rue des oliviers 72000', 0.01),
(9, 'DUPONT', 'Elena', '03/07/0991', 'Boulevard des fleurs 72100', 0),
(10, 'DUPOND', 'Pascal', '16/10/1983', '29 rue Alan Turing 72350', 0);

-- --------------------------------------------------------

--
-- Structure de la table `client_actif`
--

CREATE TABLE `client_actif` (
  `id_client_actif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(11) NOT NULL,
  `id_concierge` int(11) NOT NULL,
  `date_heure` varchar(50) NOT NULL,
  `montant_total` float NOT NULL,
  `montant_depot` float NOT NULL,
  `montant_livraison` float NOT NULL,
  `etat_commande` enum('Current being processed','Processed','Sent','Delivered','Canceled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_concierge`, `date_heure`, `montant_total`, `montant_depot`, `montant_livraison`, `etat_commande`) VALUES
(1, 1, '09/02/2020 - 15h12', 134, 0, 0, 'Current being processed'),
(2, 1, '23/10/2019 - 18h32', 84.12, 5.12, 15.63, 'Delivered');

-- --------------------------------------------------------

--
-- Structure de la table `concierge`
--

CREATE TABLE `concierge` (
  `id_concierge` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_naissance` varchar(50) NOT NULL,
  `adresse_mail` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `concierge`
--

INSERT INTO `concierge` (`id_concierge`, `nom`, `prenom`, `date_naissance`, `adresse_mail`, `mdp`) VALUES
(1, 'MARTIN', 'Paul', '27/03/1976', 'Paul@Martin.com', 'MotDePasse');

-- --------------------------------------------------------

--
-- Structure de la table `conversion_monnaie`
--

CREATE TABLE `conversion_monnaie` (
  `type_monnaie_entree` varchar(3) NOT NULL,
  `type_monnaie_sortie` varchar(3) NOT NULL,
  `taux_conversion_es` float NOT NULL,
  `taux_conversion_se` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `conversion_monnaie`
--

INSERT INTO `conversion_monnaie` (`type_monnaie_entree`, `type_monnaie_sortie`, `taux_conversion_es`, `taux_conversion_se`) VALUES
('EUR', 'GBP', 0.849105, 1.17771),
('EUR', 'USD', 1.09446, 0.913695);

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `id_facture` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  `date_heure` varchar(50) NOT NULL,
  `montant_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id_fournisseur` int(11) NOT NULL,
  `abreviation` varchar(50) NOT NULL,
  `nom_vendeur` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id_fournisseur`, `abreviation`, `nom_vendeur`) VALUES
(1, 'NCB', 'Nocibé'),
(2, 'AMZ', 'Amazon'),
(3, 'SPH', 'Sephora'),
(4, 'OGP', 'Origine-parfum'),
(5, 'MAR', 'Marionnaud');

-- --------------------------------------------------------

--
-- Structure de la table `liste_marque`
--

CREATE TABLE `liste_marque` (
  `id_marque` int(11) NOT NULL,
  `abreviation` varchar(50) NOT NULL,
  `nom_marque` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `liste_marque`
--

INSERT INTO `liste_marque` (`id_marque`, `abreviation`, `nom_marque`) VALUES
(2, 'LAN', 'Lancôme'),
(3, 'CHA', 'Chanel'),
(4, 'CER', 'CERRUTI'),
(5, 'CAR', 'Cartier'),
(6, 'BOU', 'Bourjois');

-- --------------------------------------------------------

--
-- Structure de la table `parfum_volume`
--

CREATE TABLE `parfum_volume` (
  `id_volume` int(11) NOT NULL,
  `contenance` int(11) NOT NULL,
  `unitee` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `parfum_volume`
--

INSERT INTO `parfum_volume` (`id_volume`, `contenance`, `unitee`) VALUES
(1, 25, 'ml'),
(2, 30, 'ml'),
(3, 50, 'ml'),
(4, 75, 'ml'),
(5, 100, 'ml'),
(6, 10, 'g'),
(7, 25, 'g'),
(8, 50, 'g'),
(9, 25, 'g'),
(10, 100, 'g'),
(11, 150, 'g'),
(12, 6, 'ml'),
(13, 2, 'ml'),
(14, 35, 'ml'),
(15, 60, 'ml');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(11) NOT NULL,
  `id_type_produit` int(11) NOT NULL,
  `id_marque` int(11) NOT NULL,
  `nom_article` varchar(50) NOT NULL,
  `ingredients` varchar(255) NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `id_type_produit`, `id_marque`, `nom_article`, `ingredients`, `photo`) VALUES
(1, 3, 1, 'La vie est belle', 'Aqua, Vanilla', 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQdXFLKnFYgkCSeVnaSgo7f1vCe8uNLsJeq9RlaGmL3o54R96JP'),
(2, 10, 2, 'Hypnose', 'AQUA / WATER / EAU- PARAFFIN- CERA ALBA / BEESWAX / CIRE DABEILLE- STEARIC ACID- COPERNICIA CERIFERA CERA / CARNAUBA WAX / CIRE DE CARNAUBA- ACACIA SENEGAL / ACACIA SENEGAL GUM- PALMITIC ACID-... ', 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTgcv1azhnG5E0DxTw81uY8uyV4vEHEne-nYvSDeXCM2JnwT-73'),
(3, 4, 3, 'N°5', 'ALCOHOL | AQUA (WATER) | PARFUM (FRAGRANCE) | BENZYL ALCOHOL | BENZYL BENZOATE | BENZYL CINNAMATE | BENZYL SALICYLATE | CINNAMYL ALCOHOL | CITRAL | CITRONELLOL | COUMARIN | EUGENOL | FARNESOL | ...', 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/85/CHANEL_No5_parfum.jpg/320px-CHANEL_No5_parfum.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `type_produit`
--

CREATE TABLE `type_produit` (
  `id_type_produit` int(11) NOT NULL,
  `abreviation` varchar(50) NOT NULL,
  `type_produit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_produit`
--

INSERT INTO `type_produit` (`id_type_produit`, `abreviation`, `type_produit`) VALUES
(3, 'PRF', 'Parfum'),
(4, 'ETO', 'Eau de toilette'),
(5, 'COS', 'Cosmétique'),
(6, 'BLU', 'Blush'),
(7, 'GLO', 'Gloss'),
(8, 'LIN', 'Eyeliner'),
(9, 'LIP', 'LipStick'),
(10, 'MAS', 'Mascara'),
(11, 'PAL', 'Palette'),
(12, 'EPA', 'Eau de parfum');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_article`);

--
-- Index pour la table `articles_commandes`
--
ALTER TABLE `articles_commandes`
  ADD PRIMARY KEY (`id_client`,`id_article`,`id_commande`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `client_actif`
--
ALTER TABLE `client_actif`
  ADD PRIMARY KEY (`id_client_actif`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`);

--
-- Index pour la table `concierge`
--
ALTER TABLE `concierge`
  ADD PRIMARY KEY (`id_concierge`);

--
-- Index pour la table `conversion_monnaie`
--
ALTER TABLE `conversion_monnaie`
  ADD PRIMARY KEY (`type_monnaie_sortie`,`type_monnaie_entree`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id_facture`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id_fournisseur`);

--
-- Index pour la table `liste_marque`
--
ALTER TABLE `liste_marque`
  ADD PRIMARY KEY (`id_marque`);

--
-- Index pour la table `parfum_volume`
--
ALTER TABLE `parfum_volume`
  ADD PRIMARY KEY (`id_volume`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`);

--
-- Index pour la table `type_produit`
--
ALTER TABLE `type_produit`
  ADD PRIMARY KEY (`id_type_produit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `concierge`
--
ALTER TABLE `concierge`
  MODIFY `id_concierge` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id_facture` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id_fournisseur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `liste_marque`
--
ALTER TABLE `liste_marque`
  MODIFY `id_marque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `parfum_volume`
--
ALTER TABLE `parfum_volume`
  MODIFY `id_volume` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `type_produit`
--
ALTER TABLE `type_produit`
  MODIFY `id_type_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
