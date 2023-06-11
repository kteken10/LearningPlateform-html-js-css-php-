-- Création de la base de données LearnVideo
CREATE DATABASE LearnVideo;

-- Utilisation de la base de données LearnVideo
USE LearnVideo;

-- Création de la table Utilisateur
CREATE TABLE Utilisateur (
  id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  mot_de_passe VARCHAR(255) NOT NULL,
  type_utilisateur ENUM('visiteur', 'formateur') NOT NULL,
  photo_profil VARCHAR(255),
  date_inscription DATE
);

-- Création de la table Cours
CREATE TABLE Cours (
  id_cours INT AUTO_INCREMENT PRIMARY KEY,
  image_fond VARCHAR(255) NOT NULL,
  libelle VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  video VARCHAR(255) NOT NULL,
  categorie ENUM('developpement', 'finance', 'art design') NOT NULL,
  id_formateur INT,
  FOREIGN KEY (id_formateur) REFERENCES Formateur(id_formateur)
);

-- Création de la table Formateur
CREATE TABLE Formateur (
  id_formateur INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  mot_de_passe VARCHAR(255) NOT NULL,
  date_inscription DATE
);

-- Création de la table Inscription
CREATE TABLE Inscription (
  id_inscription INT AUTO_INCREMENT PRIMARY KEY,
  id_utilisateur INT,
  date_inscription DATE,
  id_cours INT,
  FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur),
  FOREIGN KEY (id_cours) REFERENCES Cours(id_cours)
);
