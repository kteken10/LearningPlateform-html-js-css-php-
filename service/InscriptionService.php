<?php

require_once 'InscriptionDAO.php';

class InscriptionService {
    private $inscriptionDAO; // Objet du DAO Inscription

    // Constructeur
    public function __construct() {
        $this->inscriptionDAO = new InscriptionDAO();
    }

    // Méthode pour inscrire un utilisateur à un cours
    public function inscrireUtilisateur($idUtilisateur, $idCours) {
        // Vérifier si l'utilisateur est déjà inscrit au cours
        if ($this->inscriptionDAO->estInscrit($idUtilisateur, $idCours)) {
            return false; // L'utilisateur est déjà inscrit
        }

        // Inscrire l'utilisateur au cours
        return $this->inscriptionDAO->inscrireUtilisateur($idUtilisateur, $idCours);
    }

    // Méthode pour désinscrire un utilisateur d'un cours
    public function desinscrireUtilisateur($idUtilisateur, $idCours) {
        // Vérifier si l'utilisateur est inscrit au cours
        if (!$this->inscriptionDAO->estInscrit($idUtilisateur, $idCours)) {
            return false; // L'utilisateur n'est pas inscrit au cours
        }

        // Désinscrire l'utilisateur du cours
        return $this->inscriptionDAO->desinscrireUtilisateur($idUtilisateur, $idCours);
    }
}
