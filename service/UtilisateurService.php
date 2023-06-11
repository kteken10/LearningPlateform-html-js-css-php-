<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/CourseProject/dao/UtilisateurDAO.php';

class UtilisateurService {
    private $utilisateurDAO; // Objet DAO pour l'entité Utilisateur
    
    // Constructeur
    public function __construct() {
        $this->utilisateurDAO = new UtilisateurDAO();
    }
    
    // Méthode pour créer un nouvel utilisateur
    public function createUser($utilisateur) {
        // Appeler la méthode du DAO pour créer l'utilisateur dans la base de données
        $userId = $this->utilisateurDAO->createUser($utilisateur);
    
        // Utilisez l'ID de l'utilisateur pour effectuer d'autres opérations si nécessaire
    
        return $userId;
    }
    
    // Méthode pour récupérer un utilisateur par son identifiant
    public function getUserById($id) {
        // Appeler la méthode du DAO pour récupérer l'utilisateur par son identifiant
        return $this->utilisateurDAO->getUserById($id);
    }
    
    // Méthode pour récupérer tous les utilisateurs
    public function getAllUsers() {
        // Appeler la méthode du DAO pour récupérer tous les utilisateurs
        return $this->utilisateurDAO->getAllUsers();
    }
    
    // Méthode pour mettre à jour les informations d'un utilisateur
    public function updateUser($utilisateur) {
        // Effectuer des vérifications et des traitements supplémentaires si nécessaire
        
        // Appeler la méthode du DAO pour mettre à jour l'utilisateur dans la base de données
        return $this->utilisateurDAO->updateUser($utilisateur);
    }
    
    // Méthode pour supprimer un utilisateur
    public function deleteUser($id) {
        // Appeler la méthode du DAO pour supprimer l'utilisateur de la base de données
        return $this->utilisateurDAO->deleteUser($id);
    }
    
    // Autres méthodes spécifiques à l'entité "Utilisateur"
    // ...
}
