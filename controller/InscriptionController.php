<?php

require_once 'InscriptionService.php';

class InscriptionController {
    private $inscriptionService; // Objet du service Inscription

    // Constructeur
    public function __construct() {
        $this->inscriptionService = new InscriptionService();
    }

    // Action pour inscrire un utilisateur à un cours
    public function inscrireUtilisateurAuCours($idUtilisateur, $idCours) {
        // Appeler la méthode du service pour inscrire l'utilisateur au cours
        $inscriptionSuccess = $this->inscriptionService->inscrireUtilisateur($idUtilisateur, $idCours);

        if ($inscriptionSuccess) {
            // L'inscription s'est déroulée avec succès
            echo "L'utilisateur a été inscrit au cours.";
        } else {
            // L'utilisateur est déjà inscrit au cours
            echo "L'utilisateur est déjà inscrit au cours.";
        }
    }

    // Action pour désinscrire un utilisateur d'un cours
    public function desinscrireUtilisateurDuCours($idUtilisateur, $idCours) {
        // Appeler la méthode du service pour désinscrire l'utilisateur du cours
        $desinscriptionSuccess = $this->inscriptionService->desinscrireUtilisateur($idUtilisateur, $idCours);

        if ($desinscriptionSuccess) {
            // La désinscription s'est déroulée avec succès
            echo "L'utilisateur a été désinscrit du cours.";
        } else {
            // L'utilisateur n'était pas inscrit au cours
            echo "L'utilisateur n'était pas inscrit au cours.";
        }
    }
}
