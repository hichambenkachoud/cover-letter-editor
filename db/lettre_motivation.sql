-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 31 mars 2019 à 14:16
-- Version du serveur :  10.1.29-MariaDB
-- Version de PHP :  7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lettre_motivation`
--

-- --------------------------------------------------------

--
-- Structure de la table `lettre`
--

CREATE TABLE `lettre` (
  `id_lettre` int(20) NOT NULL,
  `objet_lettre` varchar(150) NOT NULL,
  `ville_lettre` varchar(60) NOT NULL,
  `date_lettre` varchar(80) NOT NULL,
  `paragOuverture` longtext NOT NULL,
  `paragCorps` longtext NOT NULL,
  `paragFermeture` longtext NOT NULL,
  `paragPolitisse` longtext NOT NULL,
  `id_user` int(20) NOT NULL,
  `id_recruteur` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lettre`
--

INSERT INTO `lettre` (`id_lettre`, `objet_lettre`, `ville_lettre`, `date_lettre`, `paragOuverture`, `paragCorps`, `paragFermeture`, `paragPolitisse`, `id_user`, `id_recruteur`) VALUES
(22, 'Demande de stage Développement Web', 'Casablanca', '15 - 12 - 2017', 'Etudiant en 3 année du cycle d’ingénieur, spécialité « Génie Logiciel », à l’Université\r\nMundiapolis de Casablanca, je suis à la recherche d’un stage PFE d’une durée de six mois à \r\ncompter du 01 février 2018. Le but de ce stage en entreprise est de consolider mes\r\nconnaissances et mon savoir-faire tout en me préparant pour mon parcours professionnel.', ' Je suis passionné par les nouvelles technologies et le domaine de l’informatique. L’ambition,\r\nla créativité et la motivation sont ma devise. Mes précédents stages m’ont permis de travailler\r\nen équipe et développer mon sens d’analyse et de conception et me confortent dans l’idée\r\nde faire carrière dans le développement informatique.', ' C’est avec plaisir que je me rendrai disponible pour un entretien afin de vous fournir tout\r\ndétail complémentaire sur mon expérience professionnelle et mes motivations. ', ' Dans cette attente, je vous prie d&#039;agréer, Madame, Monsieur, l&#039;expression de mes\r\nsalutations distinguées.', 44, 31),
(23, '', '', '', '', '', '', '', 45, 32),
(24, '', '', '', '', '', '', '', 46, 33);

-- --------------------------------------------------------

--
-- Structure de la table `recruteur`
--

CREATE TABLE `recruteur` (
  `id_recruteur` int(11) NOT NULL,
  `nom_recruteur` varchar(20) NOT NULL,
  `prenom_recruteur` varchar(20) NOT NULL,
  `civilite_recruteur` varchar(10) NOT NULL,
  `company_recruteur` varchar(20) NOT NULL,
  `addresse_recruteur` varchar(100) NOT NULL,
  `ville_recruteur` varchar(20) NOT NULL,
  `pays_recruteur` varchar(20) NOT NULL,
  `codePostale_recruteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `recruteur`
--

INSERT INTO `recruteur` (`id_recruteur`, `nom_recruteur`, `prenom_recruteur`, `civilite_recruteur`, `company_recruteur`, `addresse_recruteur`, `ville_recruteur`, `pays_recruteur`, `codePostale_recruteur`) VALUES
(31, 'TAN', 'Kévin', 'Mr.', 'Edith Digital', '37 Quai de Grenelle Bâtiment Castor', 'Paris', 'France', 75015),
(32, 'Pouillart', 'Valentin', 'Mr.', 'Edith digital', '177 Avenue Georges Clemenceau', 'Nanterre', 'France', 92600),
(33, '', '', '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nom_user` varchar(20) NOT NULL,
  `prenom_user` varchar(20) NOT NULL,
  `addresse_user` varchar(30) NOT NULL,
  `codePostale_user` int(11) NOT NULL,
  `ville_user` varchar(20) NOT NULL,
  `pays_user` varchar(20) NOT NULL,
  `telephone_user` varchar(20) NOT NULL,
  `email_user` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `nom_user`, `prenom_user`, `addresse_user`, `codePostale_user`, `ville_user`, `pays_user`, `telephone_user`, `email_user`) VALUES
(44, 'BEN KACHOUD', 'HICHAM', 'DR idlahcen oulahcen ennabour', 85200, 'Casablanca', 'Maroc', '+212669612216', 'h.benkachoud@mundiapolis.ma'),
(45, 'kamal', 'Boulafroua', '19 BOULEVARD FELIX FAURE', 93200, 'SAINT DENIS', 'Franca', '0758631003', 'k.boulafroua@gmail.com'),
(46, 'hassan', 'hasma', '', 0, '', '', '', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `lettre`
--
ALTER TABLE `lettre`
  ADD PRIMARY KEY (`id_lettre`);

--
-- Index pour la table `recruteur`
--
ALTER TABLE `recruteur`
  ADD PRIMARY KEY (`id_recruteur`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `lettre`
--
ALTER TABLE `lettre`
  MODIFY `id_lettre` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `recruteur`
--
ALTER TABLE `recruteur`
  MODIFY `id_recruteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
