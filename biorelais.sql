-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Jeu 19 Novembre 2020 à 11:29
-- Version du serveur :  10.1.26-MariaDB-0+deb9u1
-- Version de PHP :  7.0.19-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ylaurain_bioRelai`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `CODECATEG` int(32) NOT NULL,
  `LIBELLECATEG` char(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`CODECATEG`, `LIBELLECATEG`) VALUES
(1, 'fruits'),
(2, 'legume');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `CODE_ADH` int(32) NOT NULL,
  `NOM_ADH` char(32) DEFAULT NULL,
  `PRENOM_ADH` char(32) DEFAULT NULL,
  `MDP` char(32) DEFAULT NULL,
  `MAIL` char(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`CODE_ADH`, `NOM_ADH`, `PRENOM_ADH`, `MDP`, `MAIL`) VALUES
(1, 'laurain2', 'yoan2', '2a21480eaf8c19ac02ced424a980bca8', 'yoan.laurain0@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `NUM_COM` int(32) NOT NULL,
  `NUM_SEMAINE` int(32) NOT NULL,
  `CODE_ADH` int(32) NOT NULL,
  `DATE_` date DEFAULT NULL,
  `ETAT` char(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`NUM_COM`, `NUM_SEMAINE`, `CODE_ADH`, `DATE_`, `ETAT`) VALUES
(1, 1, 1, '2020-10-06', 'validé'),
(114, 47, 1, '2020-11-19', 'validé'),
(118, 47, 1, '2020-11-19', 'En attente');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `num_commande` int(11) NOT NULL,
  `code_adh` int(11) NOT NULL,
  `montant` double NOT NULL,
  `id_Pro` int(11) NOT NULL,
  `Qtte` int(11) NOT NULL,
  `Producteur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `panier`
--

INSERT INTO `panier` (`num_commande`, `code_adh`, `montant`, `id_Pro`, `Qtte`, `Producteur`) VALUES
(1, 1, 130, 2, 9, 1),
(4, 1, 10, 2, 9, 1),
(5, 1, 2, 15, 9, 1),
(5, 1, 2, 1, 9, 1),
(114, 1, 1000, 1, 1, 2),
(114, 1, 72, 3, 2, 1),
(114, 1, 54, 12, 1, 2),
(118, 1, 6, 12, 1, 2),
(118, 1, 1000, 1, 1, 2),
(118, 1, 10, 3, 2, 1),
(118, 1, 6, 10, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `producteur`
--

CREATE TABLE `producteur` (
  `CODE_ADH` int(32) NOT NULL,
  `ADRESSE` char(32) DEFAULT NULL,
  `COMMUNE` char(32) DEFAULT NULL,
  `CODEPOSTAL` int(32) DEFAULT NULL,
  `DESCRIPTIF` char(32) DEFAULT NULL,
  `NOM_ADH` char(32) DEFAULT NULL,
  `PRENOM_ADH` char(32) DEFAULT NULL,
  `LOGIN` char(32) DEFAULT NULL,
  `MDP` char(32) DEFAULT NULL,
  `MAIL` char(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `producteur`
--

INSERT INTO `producteur` (`CODE_ADH`, `ADRESSE`, `COMMUNE`, `CODEPOSTAL`, `DESCRIPTIF`, `NOM_ADH`, `PRENOM_ADH`, `LOGIN`, `MDP`, `MAIL`) VALUES
(1, '9 cours de la marne', 'bordeaux', 33800, 'Producteur de fruits et légumes', 'Delacroix', 'Axel', 'Axel', '2ee0425cdf84ccd53c97b68da1374138', 'Axel.delacroix@gmail.com'),
(2, '18 rue des palombes', 'la reole', 33190, 'Producteur de fruits bio', 'Laorte', 'jean-paul', 'J-Paul', 'ddb094133ef2c536ea81086e09c0cd2b', 'jean.paul@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `ID_PRO` int(32) NOT NULL,
  `CODECATEG` int(32) NOT NULL,
  `LIBELLE_PRO` char(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`ID_PRO`, `CODECATEG`, `LIBELLE_PRO`) VALUES
(1, 1, 'pomme'),
(2, 1, 'orange'),
(3, 1, 'cerise'),
(4, 1, 'kiwi'),
(5, 1, 'pamplemousse'),
(6, 1, 'raisins'),
(7, 1, 'abricot'),
(8, 1, 'poires'),
(9, 1, 'bananes'),
(10, 1, 'framboises'),
(11, 2, 'aubergine'),
(12, 2, 'navet'),
(13, 2, 'choux'),
(14, 2, 'oignon'),
(15, 2, 'courgette'),
(16, 2, 'salade'),
(17, 2, 'patate'),
(18, 2, 'haricot'),
(19, 2, 'mais');

-- --------------------------------------------------------

--
-- Structure de la table `proposer`
--

CREATE TABLE `proposer` (
  `NUM_SEMAINE` int(32) NOT NULL,
  `ID_PRO` int(32) NOT NULL,
  `QTTE` int(32) DEFAULT NULL,
  `PRIX` int(32) NOT NULL,
  `UNITE` varchar(32) DEFAULT NULL,
  `CODE_ADH` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `proposer`
--

INSERT INTO `proposer` (`NUM_SEMAINE`, `ID_PRO`, `QTTE`, `PRIX`, `UNITE`, `CODE_ADH`) VALUES
(1, 2, 46, 2, 'KG', 1),
(47, 1, 15, 500, 'KG', 2),
(47, 10, 50, 2, 'KG', 1),
(47, 12, 2, 3, 'KG', 2),
(47, 6, 5, 1, 'KG', 2),
(47, 3, 16, 2, 'KG', 1),
(47, 4, 60, 5, 'KG', 2),
(47, 5, 100, 1, 'KG', 1),
(47, 7, 42, 3, 'KG', 1),
(47, 8, 34, 4, 'KG', 1),
(47, 9, 81, 6, 'KG', 1),
(47, 2, 22, 1, 'KG', 1),
(47, 11, 24, 7, 'KG', 2),
(47, 13, 35, 8, 'KG', 1),
(47, 14, 99, 2, 'KG', 1),
(47, 15, 64, 3, 'KG', 2),
(47, 16, 95, 2, 'KG', 1),
(47, 17, 21, 1, 'KG', 2),
(47, 18, 60, 5, 'KG', 1),
(47, 19, 71, 3, 'KG', 2);

-- --------------------------------------------------------

--
-- Structure de la table `semaine`
--

CREATE TABLE `semaine` (
  `NUM_SEMAINE` int(32) NOT NULL,
  `DATEDEBUTPROD` date DEFAULT NULL,
  `DATEFINPROD` date DEFAULT NULL,
  `DATEFINCLI` date DEFAULT NULL,
  `DATEVENTE` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `semaine`
--

INSERT INTO `semaine` (`NUM_SEMAINE`, `DATEDEBUTPROD`, `DATEFINPROD`, `DATEFINCLI`, `DATEVENTE`) VALUES
(1, '2020-10-01', '2020-10-04', '2020-10-07', NULL),
(2, '2020-10-08', '2020-10-11', '2020-10-14', NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`CODECATEG`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`CODE_ADH`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`NUM_COM`),
  ADD KEY `I_FK_COMMANDE_CLIENT` (`CODE_ADH`),
  ADD KEY `I_FK_COMMANDE_SEMAINE` (`NUM_SEMAINE`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`num_commande`,`code_adh`,`id_Pro`,`Producteur`);

--
-- Index pour la table `producteur`
--
ALTER TABLE `producteur`
  ADD PRIMARY KEY (`CODE_ADH`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`ID_PRO`) USING BTREE,
  ADD KEY `I_FK_PRODUIT_CATEGORIE` (`CODECATEG`);

--
-- Index pour la table `proposer`
--
ALTER TABLE `proposer`
  ADD PRIMARY KEY (`NUM_SEMAINE`,`ID_PRO`,`CODE_ADH`),
  ADD KEY `I_FK_PROPOSER_PRODUIT` (`ID_PRO`,`NUM_SEMAINE`,`CODE_ADH`) USING BTREE,
  ADD KEY `fkey` (`CODE_ADH`);

--
-- Index pour la table `semaine`
--
ALTER TABLE `semaine`
  ADD PRIMARY KEY (`NUM_SEMAINE`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `CODECATEG` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `CODE_ADH` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `NUM_COM` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT pour la table `producteur`
--
ALTER TABLE `producteur`
  MODIFY `CODE_ADH` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `ID_PRO` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `semaine`
--
ALTER TABLE `semaine`
  MODIFY `NUM_SEMAINE` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
