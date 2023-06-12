<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/CourseProject/service/FormateurService.php';

class FormateurController {
    private $formateurService;
    
    public function __construct() {
        $this->formateurService = new FormateurService();
    }
    
    public function createFormateur($data) {
        // Appel de la méthode createFormateur du service avec les données du formateur
        $formateurId = $this->formateurService->createFormateur($data);
        
        if ($formateurId !== null) {
            $response = [
                'success' => true,
                'message' => 'Formateur créé avec succès',
                'data' => $formateurId
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Erreur lors de la création du formateur'
            ];
        }
        
        echo json_encode($response);
    }
    
    // Autres méthodes de contrôleur pour les opérations CRUD du formateur
    // ...
}

// Vérification de la méthode de la requête HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Création d'une instance de FormateurController
$formateurController = new FormateurController();

// Traitement des différentes méthodes de requête
switch ($method) {
    case 'POST':
        // Récupération des données JSON de la requête
        $data = $_POST;
        
        // Appel de la méthode createFormateur avec les données du formateur
        $formateurController->createFormateur($data);
        break;
    
    // Ajoutez d'autres cas de méthode pour les autres opérations CRUD du formateur
    
    default:
        // Méthode non prise en charge
        $response = [
            'success' => false,
            'message' => 'Méthode non prise en charge'
        ];
        
        // Affichage de l'erreur pour débogage
        error_log('Unsupported method: ' . $method);
        echo json_encode($response);
        break;
}

?>
