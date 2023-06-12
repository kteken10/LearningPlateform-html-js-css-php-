<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/CourseProject/service/GestionCoursService.php';

class GestionCoursController {
    private $gestionCoursService;

    public function __construct() {
        $this->gestionCoursService = new GestionCoursService();
    }

    public function createCours($cours) {
        $cours = $this->gestionCoursService->ajouterCours($cours);

        if ($cours !== null) {
            $response = [
                'success' => true,
                'message' => 'Cours ajouté avec succès',
                'data' => $cours
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Erreur lors de l\'ajout du cours'
            ];
        }

        echo json_encode($response);
    }

    public function updateCours($idCours, $cours) {
        $success = $this->gestionCoursService->modifierCours($idCours, $cours);

        if ($success) {
            $response = [
                'success' => true,
                'message' => 'Cours mis à jour avec succès'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Cours non trouvé'
            ];
        }

        echo json_encode($response);
    }

    public function deleteCours($idCours) {
        $success = $this->gestionCoursService->supprimerCours($idCours);

        if ($success) {
            $response = [
                'success' => true,
                'message' => 'Cours supprimé avec succès'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Cours non trouvé'
            ];
        }

        echo json_encode($response);
    }

    public function getCoursById($idCours) {
        $cours = $this->gestionCoursService->getCoursById($idCours);

        if ($cours !== null) {
            $response = [
                'success' => true,
                'data' => $cours
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Cours non trouvé'
            ];
        }

        echo json_encode($response);
    }

    public function getAllCours() {
        $cours = $this->gestionCoursService->getAllCours();

        $response = [
            'success' => true,
            'data' => $cours
        ];

        echo json_encode($response);
    }
}

// Vérification de la méthode de la requête HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Création d'une instance de GestionCoursController
$gestionCoursController = new GestionCoursController();

// Traitement des différentes méthodes de requête
switch ($method) {
    case 'GET':
        // Vérification de l'action dans la requête GET
        if (isset($_GET['action']) && $_GET['action'] === 'delete') {
            // Récupération de l'ID du cours à supprimer depuis la requête GET
            if (isset($_GET['id_cours'])) {
                $idCours = $_GET['id_cours'];
    
                // Appel de la méthode deleteCours avec l'ID du cours
                $gestionCoursController->deleteCours($idCours);
            } else {
                // ID du cours non fourni dans la requête
                $response = [
                    'success' => false,
                    'message' => 'ID du cours manquant dans la requête'
                ];
                echo json_encode($response);
            }
        } else {
            // Aucune action de suppression demandée, récupération des cours
            // Récupération de l'ID du cours depuis la requête
            if (isset($_GET['id_cours'])) {
                $idCours = $_GET['id_cours'];
    
                // Appel de la méthode getCoursById avec l'ID du cours
                $gestionCoursController->getCoursById($idCours);
            } else {
                // Appel de la méthode getAllCours pour récupérer tous les cours
                $gestionCoursController->getAllCours();
            }
        }
        break;
    

    case 'POST':
        // Récupération des données JSON de la requête
        $data = $_POST;

        // Appel de la méthode createCours avec les données du cours
        $gestionCoursController->createCours($data);
        break;

    case 'PUT':
        // Récupération des données JSON de la requête
        $data = json_decode(file_get_contents('php://input'), true);

        // Récupération de l'ID du cours à mettre à jour
        $idCours = $data['idCours'];

        // Appel de la méthode updateCours avec l'ID du cours et les données de mise à jour
        $gestionCoursController->updateCours($idCours, $data);
        break;

        

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
