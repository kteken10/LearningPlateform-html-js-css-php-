<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/CourseProject/service/UtilisateurService.php';

class UtilisateurController {
    private $utilisateurService;

    public function __construct() {
        $this->utilisateurService = new UtilisateurService();
    }

    public function createUtilisateur($utilisateur) {
        $utilisateur = $this->utilisateurService->createUser($utilisateur);

        if ($utilisateur !== null) {
            $response = [
                'success' => true,
                'message' => 'Utilisateur créé avec succès',
                'data' => $utilisateur
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Erreur lors de la création de l\'utilisateur'
            ];
        }

        echo json_encode($response);
    }

    public function updateUtilisateur($id, $utilisateur) {
        $success = $this->utilisateurService->updateUtilisateur($id, $utilisateur);

        if ($success) {
            $response = [
                'success' => true,
                'message' => 'Utilisateur mis à jour avec succès'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Utilisateur non trouvé'
            ];
        }

        echo json_encode($response);
    }

    public function deleteUtilisateur($id) {
        $success = $this->utilisateurService->deleteUtilisateur($id);

        if ($success) {
            $response = [
                'success' => true,
                'message' => 'Utilisateur supprimé avec succès'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Utilisateur non trouvé'
            ];
        }

        echo json_encode($response);
    }

    public function verifyUtilisateur($email, $password) {
        $utilisateur = $this->utilisateurService->getUtilisateurByEmail($email,$password);

        if ($utilisateur !== null) {
            $response = [
                'success' => true,
                'message' => 'Utilisateur vérifié avec succès',
                'data' => $utilisateur
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Email ou mot de passe incorrect'
            ];
        }

        echo json_encode($response);
    }

    public function getUtilisateurById($id) {
        $utilisateur = $this->utilisateurService->getUtilisateurById($id);

        if ($utilisateur !== null) {
            $response = [
                'success' => true,
                'data' => $utilisateur
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Utilisateur non trouvé'
            ];
        }

        echo json_encode($response);
    }

    public function getAllUtilisateurs() {
        $utilisateurs = $this->utilisateurService->getAllUtilisateurs();

        $response = [
            'success' => true,
            'data' => $utilisateurs
        ];

        echo json_encode($response);
    }
}

// Vérification de la méthode de la requête HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Création d'une instance de UtilisateurController
$utilisateurController = new UtilisateurController();

// Traitement des différentes méthodes de requête
switch ($method) {
    case 'GET':
        // Récupération de l'ID de l'utilisateur depuis la requête
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Appel de la méthode getUtilisateurById avec l'ID de l'utilisateur
            $utilisateurController->getUtilisateurById($id);
        } else if (isset($_GET['email']) && isset($_GET['password'])) {
            // Appel de la méthode verifyUtilisateur avec l'email et le mot de passe
            $email = $_GET['email'];
            $password = $_GET['password'];
            $utilisateurController->verifyUtilisateur($email, $password);
        } else {
            // Paramètre manquant dans la requête
            $response = [
                'success' => false,
                'message' => 'Paramètre manquant dans la requête'
            ];
            echo json_encode($response);
        }
        break;

    case 'POST':
        // Récupération des données JSON de la requête
        $data = $_POST;

        // Appel de la méthode createUtilisateur avec les données de l'utilisateur
        $utilisateurController->createUtilisateur($data);
        break;

    case 'PUT':
        // Récupération des données JSON de la requête
        $data = json_decode(file_get_contents('php://input'), true);

        // Récupération de l'ID de l'utilisateur à mettre à jour
        $id = $data['id'];

        // Appel de la méthode updateUtilisateur avec l'ID de l'utilisateur et les données de mise à jour
        $utilisateurController->updateUtilisateur($id, $data);
        break;

    case 'DELETE':
        // Récupération de l'ID de l'utilisateur à supprimer
        $id = $_GET['id'];

        // Appel de la méthode deleteUtilisateur avec l'ID de l'utilisateur
        $utilisateurController->deleteUtilisateur($id);
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
