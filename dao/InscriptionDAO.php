<?php

require_once 'connexion.php';

class InscriptionDAO {
    private $conn; // Objet de connexion à la base de données

    // Constructeur
    public function __construct() {
        $this->conn = Connexion::getInstance()->getConnection();
    }

    // Méthode pour inscrire un utilisateur à un cours
    public function inscrireUtilisateur($idUtilisateur, $idCours) {
        $sql = "INSERT INTO Inscription (id_utilisateur, id_cours) VALUES (:idUtilisateur, :idCours)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':idUtilisateur', $idUtilisateur);
        $stmt->bindValue(':idCours', $idCours);

        return $stmt->execute();
    }

    // Méthode pour désinscrire un utilisateur d'un cours
    public function desinscrireUtilisateur($idUtilisateur, $idCours) {
        $sql = "DELETE FROM Inscription WHERE id_utilisateur = :idUtilisateur AND id_cours = :idCours";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':idUtilisateur', $idUtilisateur);
        $stmt->bindValue(':idCours', $idCours);

        return $stmt->execute();
    }

    // Méthode pour vérifier si un utilisateur est inscrit à un cours
    public function estInscrit($idUtilisateur, $idCours) {
        $sql = "SELECT COUNT(*) FROM Inscription WHERE id_utilisateur = :idUtilisateur AND id_cours = :idCours";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':idUtilisateur', $idUtilisateur);
        $stmt->bindValue(':idCours', $idCours);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }
}
