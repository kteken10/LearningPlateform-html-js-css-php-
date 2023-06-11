<?php

// Informations de connexion à la base de données
$host = 'localhost';
$db_name = 'LearnVideo';
$username = 'root';
$password = '';

try {
    // Création de l'objet de connexion à la base de données
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);

    // Définition des options de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Gestion des erreurs de connexion à la base de données
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
}
