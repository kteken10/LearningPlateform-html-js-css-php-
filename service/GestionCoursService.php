<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/CourseProject/dao/GestionCoursDAO.php';

class GestionCoursService {
    private $gestionCoursDAO; // Objet d'accès aux données (DAO)

    // Constructeur
    public function __construct() {
        $this->gestionCoursDAO = new GestionCoursDAO();
    }

    // Méthode pour ajouter un cours
    public function ajouterCours($cours) {
        // Ajoutez ici toute logique supplémentaire avant d'appeler la méthode du DAO
        return $this->gestionCoursDAO->ajouterCours($cours);
    }

    // Méthode pour supprimer un cours
    public function supprimerCours($idCours) {
        // Ajoutez ici toute logique supplémentaire avant d'appeler la méthode du DAO
        return $this->gestionCoursDAO->supprimerCours($idCours);
    }

    // Méthode pour modifier un cours
    public function modifierCours($cours) {
        // Ajoutez ici toute logique supplémentaire avant d'appeler la méthode du DAO
        return $this->gestionCoursDAO->modifierCours($cours);
    }

    // Méthode pour récupérer tous les cours
    public function getAllCours() {
        // Ajoutez ici toute logique supplémentaire avant d'appeler la méthode du DAO
        return $this->gestionCoursDAO->getAllCours();
    }

    // Méthode pour récupérer un cours par son identifiant
    public function getCoursById($idCours) {
        // Ajoutez ici toute logique supplémentaire avant d'appeler la méthode du DAO
        return $this->gestionCoursDAO->getCoursById($idCours);
    }
}

?>
