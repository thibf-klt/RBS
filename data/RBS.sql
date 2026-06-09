-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 09 juin 2026 à 09:43
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `RBS`
--

-- --------------------------------------------------------

--
-- Structure de la table `EXERCISE`
--

CREATE TABLE `EXERCISE` (
  `idEx` int(11) NOT NULL,
  `idClient` int(11) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(100) DEFAULT '',
  `date_` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `INSERTING`
--

CREATE TABLE `INSERTING` (
  `idEx` int(11) NOT NULL,
  `idMed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `MEDIA`
--

CREATE TABLE `MEDIA` (
  `idMed` int(11) NOT NULL,
  `idExercise` int(11) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(50) DEFAULT '',
  `date_` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `PDF`
--

CREATE TABLE `PDF` (
  `idPdf` int(11) NOT NULL,
  `idExercise` int(11) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(500) DEFAULT '',
  `date_` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `POST`
--

CREATE TABLE `POST` (
  `idPost` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(2000) NOT NULL,
  `date_` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `PROTOCOL`
--

CREATE TABLE `PROTOCOL` (
  `idPr` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(100) NOT NULL,
  `date_` date NOT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `TESTIMONY`
--

CREATE TABLE `TESTIMONY` (
  `idTest` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(500) NOT NULL,
  `date_` date NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `USER_`
--

CREATE TABLE `USER_` (
  `idUser` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `phoneNumber` varchar(15) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `USES`
--

CREATE TABLE `USES` (
  `idEx` int(11) NOT NULL,
  `idPdf` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `UTILIZE`
--

CREATE TABLE `UTILIZE` (
  `idUser` int(11) NOT NULL,
  `idEx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Index pour la table `EXERCISE`
--
ALTER TABLE `EXERCISE`
  ADD PRIMARY KEY (`idEx`),
  ADD KEY `EXERCISE_ibfk_1` (`idClient`);

--
-- Index pour la table `INSERTING`
--
ALTER TABLE `INSERTING`
  ADD PRIMARY KEY (`idEx`,`idMed`),
  ADD KEY `idMed` (`idMed`);

--
-- Index pour la table `MEDIA`
--
ALTER TABLE `MEDIA`
  ADD PRIMARY KEY (`idMed`),
  ADD KEY `MEDIA_ibfk_1` (`idExercise`);

--
-- Index pour la table `PDF`
--
ALTER TABLE `PDF`
  ADD PRIMARY KEY (`idPdf`),
  ADD KEY `PDF_ibfk_1` (`idExercise`);

--
-- Index pour la table `POST`
--
ALTER TABLE `POST`
  ADD PRIMARY KEY (`idPost`);

--
-- Index pour la table `PROTOCOL`
--
ALTER TABLE `PROTOCOL`
  ADD PRIMARY KEY (`idPr`),
  ADD KEY `PROTOCOL_ibfk_1` (`idUser`);

--
-- Index pour la table `TESTIMONY`
--
ALTER TABLE `TESTIMONY`
  ADD PRIMARY KEY (`idTest`),
  ADD UNIQUE KEY `idUser` (`idUser`);

--
-- Index pour la table `USER_`
--
ALTER TABLE `USER_`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `USES`
--
ALTER TABLE `USES`
  ADD PRIMARY KEY (`idEx`,`idPdf`),
  ADD KEY `idPdf` (`idPdf`);

--
-- Index pour la table `UTILIZE`
--
ALTER TABLE `UTILIZE`
  ADD PRIMARY KEY (`idUser`,`idEx`),
  ADD KEY `idEx` (`idEx`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `EXERCISE`
--
ALTER TABLE `EXERCISE`
  MODIFY `idEx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `MEDIA`
--
ALTER TABLE `MEDIA`
  MODIFY `idMed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `PDF`
--
ALTER TABLE `PDF`
  MODIFY `idPdf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `POST`
--
ALTER TABLE `POST`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `PROTOCOL`
--
ALTER TABLE `PROTOCOL`
  MODIFY `idPr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `TESTIMONY`
--
ALTER TABLE `TESTIMONY`
  MODIFY `idTest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `USER_`
--
ALTER TABLE `USER_`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `EXERCISE`
--
ALTER TABLE `EXERCISE`
  ADD CONSTRAINT `EXERCISE_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `USER_` (`idUser`) ON DELETE SET NULL;

--
-- Contraintes pour la table `INSERTING`
--
ALTER TABLE `INSERTING`
  ADD CONSTRAINT `INSERTING_ibfk_1` FOREIGN KEY (`idEx`) REFERENCES `EXERCISE` (`idEx`),
  ADD CONSTRAINT `INSERTING_ibfk_2` FOREIGN KEY (`idMed`) REFERENCES `MEDIA` (`idMed`);

--
-- Contraintes pour la table `MEDIA`
--
ALTER TABLE `MEDIA`
  ADD CONSTRAINT `MEDIA_ibfk_1` FOREIGN KEY (`idExercise`) REFERENCES `EXERCISE` (`idEx`) ON DELETE SET NULL;

--
-- Contraintes pour la table `PDF`
--
ALTER TABLE `PDF`
  ADD CONSTRAINT `PDF_ibfk_1` FOREIGN KEY (`idExercise`) REFERENCES `EXERCISE` (`idEx`) ON DELETE SET NULL;

--
-- Contraintes pour la table `PROTOCOL`
--
ALTER TABLE `PROTOCOL`
  ADD CONSTRAINT `PROTOCOL_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `USER_` (`idUser`) ON DELETE SET NULL;

--
-- Contraintes pour la table `TESTIMONY`
--
ALTER TABLE `TESTIMONY`
  ADD CONSTRAINT `TESTIMONY_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `USER_` (`idUser`);

--
-- Contraintes pour la table `USES`
--
ALTER TABLE `USES`
  ADD CONSTRAINT `USES_ibfk_1` FOREIGN KEY (`idEx`) REFERENCES `EXERCISE` (`idEx`),
  ADD CONSTRAINT `USES_ibfk_2` FOREIGN KEY (`idPdf`) REFERENCES `PDF` (`idPdf`);

--
-- Contraintes pour la table `UTILIZE`
--
ALTER TABLE `UTILIZE`
  ADD CONSTRAINT `UTILIZE_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `USER_` (`idUser`),
  ADD CONSTRAINT `UTILIZE_ibfk_2` FOREIGN KEY (`idEx`) REFERENCES `EXERCISE` (`idEx`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
