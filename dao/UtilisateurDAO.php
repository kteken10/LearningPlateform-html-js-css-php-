<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/CourseProject/connexion.php';

class UtilisateurDAO {
    private $conn; // Objet de connexion à la base de données
    
    // Constructeur
    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }
    
   // Méthode pour créer un nouvel utilisateur dans la base de données
   public function createUser($utilisateur) {
    $sql = "INSERT INTO Utilisateur (nom, email, mot_de_passe, type_utilisateur, photo_profil, date_inscription) 
            VALUES (:nom, :email, :mot_de_passe, :type_utilisateur, :photo_profil, :date_inscription)";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':nom', $utilisateur['nom']);
    $stmt->bindValue(':email', $utilisateur['email']);
    $stmt->bindValue(':mot_de_passe', $utilisateur['mot_de_passe']);
    $stmt->bindValue(':type_utilisateur', $utilisateur['type_utilisateur']);
    $stmt->bindValue(':photo_profil', $utilisateur['photo_profil']);
    $stmt->bindValue(':date_inscription', date('Y-m-d H:i:s')); // Utilise la date actuelle du serveur

    if ($stmt->execute()) {
        // Retourne l'ID de l'utilisateur créé
        return $this->conn->lastInsertId();
    } else {
        return null;
    }
}
   
    // Méthode pour récupérer un utilisateur par son email
    public function getUtilisateurByEmail($email,$password) {
        $sql = "SELECT * FROM Utilisateur WHERE email = :email AND mot_de_passe = :mot_de_passe";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':mot_de_passe', $password);
        $stmt->execute();
        
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return ($utilisateur !== false) ? $utilisateur : null;
    }


    
    // Méthode pour récupérer un utilisateur par son identifiant
    public function getUserById($id) {
        $sql = "SELECT * FROM Utilisateur WHERE id_utilisateur = :id";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Méthode pour récupérer tous les utilisateurs
    public function getAllUsers() {
        $sql = "SELECT * FROM Utilisateur";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Méthode pour mettre à jour les informations d'un utilisateur
    public function updateUser($utilisateur) {
        $sql = "UPDATE Utilisateur SET nom = :nom, email = :email, mot_de_passe = :mot_de_passe, type_utilisateur = :type_utilisateur, photo_profil = :photo_profil, date_inscription = :date_inscription
                WHERE id_utilisateur = :id";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':nom', $utilisateur['nom']);
        $stmt->bindValue(':email', $utilisateur['email']);
        $stmt->bindValue(':mot_de_passe', $utilisateur['mot_de_passe']);
        $stmt->bindValue(':type_utilisateur', $utilisateur['type_utilisateur']);
        $stmt->bindValue(':photo_profil', $utilisateur['photo_profil']);
        $stmt->bindValue(':date_inscription', $utilisateur['date_inscription']);
        $stmt->bindValue(':id', $utilisateur['id_utilisateur']);
        
        return $stmt->execute();
    }
    
    // Méthode pour supprimer un utilisateur
    public function deleteUser($id) {
        $sql = "DELETE FROM Utilisateur WHERE id_utilisateur = :id";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        
        return $stmt->execute();
    }
    
    // Autres méthodes spécifiques à l'entité "Utilisateur"
    // ...
}
