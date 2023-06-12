<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/CourseProject/connexion.php';

class GestionCoursDAO {
    private $conn; // Objet de connexion à la base de données
    
    // Constructeur
    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }
    
    // Méthode pour ajouter un cours
public function ajouterCours($cours) {
    $sql = "INSERT INTO Cours (image_fond, libelle, description, video, categorie, id_formateur)
            VALUES (:image_fond, :libelle, :description, :video, :categorie, :id_formateur)";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':image_fond', $cours['image_fond']);
    $stmt->bindValue(':libelle', $cours['libelle']);
    $stmt->bindValue(':description', $cours['description']);
    $stmt->bindValue(':video', $cours['video']);
    $stmt->bindValue(':categorie', $cours['categorie']);
    $stmt->bindValue(':id_formateur', $cours['id_formateur']);

    return $stmt->execute();
}

    
    // Méthode pour supprimer un cours
    public function supprimerCours($idCours) {
        $sql = "DELETE FROM Cours WHERE id_cours = :id_cours";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id_cours', $idCours);
        
        return $stmt->execute();
    }
    
    // Méthode pour obtenir la liste des cours
    public function getListeCours() {
        $sql = "SELECT * FROM Cours";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
