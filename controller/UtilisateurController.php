<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/service/UtilisateurService.php';

class UtilisateurController {
    private $utilisateurService; // Objet Service pour l'entité Utilisateur
    
    // Constructeur
    public function __construct() {
        $this->utilisateurService = new UtilisateurService();
    }
    
    // Méthode pour gérer la création d'un nouvel utilisateur
    public function createUser() {
        // Vérifier que les données nécessaires ont été envoyées en POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['mot_de_passe'])) {
            $utilisateur = [
                'nom' => $_POST['nom'],
                'email' => $_POST['email'],
                'mot_de_passe' => $_POST['mot_de_passe'],
                'type_utilisateur' => $_POST['type_utilisateur'], // Ajouter d'autres données si nécessaire
                'photo_profil' => $_FILES['photo_profil']['name'], // Récupérer le nom du fichier de la photo de profil
                'date_inscription' => date('Y-m-d') // Date d'inscription actuelle
            ];
            
            // Enregistrer le fichier de la photo de profil dans le dossier souhaité
            $targetDir = 'uploads/';
            $targetFile = $targetDir . basename($_FILES['photo_profil']['name']);
            move_uploaded_file($_FILES['photo_profil']['tmp_name'], $targetFile);
            
            // Appeler la méthode du service pour créer l'utilisateur
            $userId = $this->utilisateurService->createUser($utilisateur);
            
            if ($userId !== null) {
                // L'utilisateur a été créé avec succès
                // Rediriger ou afficher un message de succès
                header('Location: success.php');
                exit();
            } else {
                // Il y a eu une erreur lors de la création de l'utilisateur
                // Afficher un message d'erreur
                echo 'Une erreur s\'est produite lors de la création de l\'utilisateur.';
            }
        } else {
            // Les données nécessaires n'ont pas été fournies ou la requête n'est pas de type POST
            // Afficher un message d'erreur ou rediriger vers une page d'erreur
            echo 'Veuillez fournir tous les champs obligatoires.';
        }
    }
    
    // Méthode pour gérer la récupération d'un utilisateur par son identifiant
    public function getUserById($id) {
        // Appeler la méthode du service pour récupérer l'utilisateur par son identifiant
        $utilisateur = $this->utilisateurService->getUserById($id);
        
        // Vérifier si l'utilisateur a été trouvé
        if ($utilisateur !== null) {
            // L'utilisateur a été trouvé, afficher les détails ou effectuer d'autres opérations
            // ...
        } else {
            // L'utilisateur n'a pas été trouvé, afficher un message d'erreur ou rediriger vers une page d'erreur
            echo 'L\'utilisateur demandé n\'existe pas.';
        }
    }
    
    // Méthode pour gérer la récupération de tous les utilisateurs
    public function getAllUsers() {
        // Appeler la méthode du service pour récupérer tous les utilisateurs
        $utilisateurs = $this->utilisateurService->getAllUsers();
        
        // Afficher la liste des utilisateurs ou effectuer d'autres opérations
        // ...
    }
    
    // Méthode pour gérer la mise à jour d'un utilisateur
    public function updateUser($id) {
        // Vérifier que les données nécessaires ont été envoyées en POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nom']) && !empty($_POST['email'])) {
            $utilisateur = [
                'id_utilisateur' => $id,
                'nom' => $_POST['nom'],
                'email' => $_POST['email'],
                'type_utilisateur' => $_POST['type_utilisateur'], // Ajouter d'autres données si nécessaire
                // ... Autres champs à mettre à jour
            ];
            
            // Appeler la méthode du service pour mettre à jour l'utilisateur
            $result = $this->utilisateurService->updateUser($utilisateur);
            
            if ($result) {
                // L'utilisateur a été mis à jour avec succès
                // Rediriger ou afficher un message de succès
                header('Location: success.php');
                exit();
            } else {
                // Il y a eu une erreur lors de la mise à jour de l'utilisateur
                // Afficher un message d'erreur
                echo 'Une erreur s\'est produite lors de la mise à jour de l\'utilisateur.';
            }
        } else {
            // Les données nécessaires n'ont pas été fournies ou la requête n'est pas de type POST
            // Afficher un message d'erreur ou rediriger vers une page d'erreur
            echo 'Veuillez fournir tous les champs obligatoires.';
        }
    }
    
    // Méthode pour gérer la suppression d'un utilisateur
    public function deleteUser($id) {
        // Appeler la méthode du service pour supprimer l'utilisateur
        $result = $this->utilisateurService->deleteUser($id);
        
        if ($result) {
            // L'utilisateur a été supprimé avec succès
            // Rediriger ou afficher un message de succès
            header('Location: success.php');
            exit();
        } else {
            // Il y a eu une erreur lors de la suppression de l'utilisateur
            // Afficher un message d'erreur
            echo 'Une erreur s\'est produite lors de la suppression de l\'utilisateur.';
        }
    }
    
   
}
