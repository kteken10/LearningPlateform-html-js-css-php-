<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/CourseProject/connexion.php';

class FormateurDAO {
    private $conn; // Objet de connexion à la base de données
    
    // Constructeur
    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }
    
    // Méthode pour créer un nouveau formateur dans la base de données
    public function createFormateur($formateur) {
        $sql = "INSERT INTO Formateur (nom, email, mot_de_passe, date_inscription) 
                VALUES (:nom, :email, :mot_de_passe, :date_inscription)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':nom', $formateur['nom']);
        $stmt->bindValue(':email', $formateur['email']);
        $stmt->bindValue(':mot_de_passe', $formateur['mot_de_passe']);
        $stmt->bindValue(':date_inscription', date('Y-m-d')); // Utilise la date actuelle du serveur

        if ($stmt->execute()) {
            // Retourne l'ID du formateur créé
            return $this->conn->lastInsertId();
        } else {
            return null;
        }
    }
    
    // Méthode pour récupérer un formateur par son email
    public function getFormateurByEmail($email) {
        $sql = "SELECT * FROM Formateur WHERE email = :email";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        
        $formateur = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return ($formateur !== false) ? $formateur : null;
    }

    // Autres méthodes spécifiques à l'entité "Formateur"
    // ...
}

?>
