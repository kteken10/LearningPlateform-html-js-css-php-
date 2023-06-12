<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/CourseProject/dao/FormateurDAO.php';

class FormateurService {
    private $formateurDAO;
    
    public function __construct() {
        $this->formateurDAO = new FormateurDAO();
    }
    
    // Méthode pour créer un nouveau formateur
    public function createFormateur($formateur) {
        // Vérifier si l'email n'est pas déjà utilisé
        $existingFormateur = $this->formateurDAO->getFormateurByEmail($formateur['email']);
        if ($existingFormateur !== null) {
            return null; // L'email est déjà utilisé
        }
        
        // Appeler la méthode du DAO pour créer le formateur
        $formateurId = $this->formateurDAO->createFormateur($formateur);
        
        return $formateurId;
    }

    // Autres méthodes spécifiques au service "Formateur"
    // ...
}

?>
