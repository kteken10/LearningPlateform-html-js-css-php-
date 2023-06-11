$(document).ready(function() {
    // Fonction pour enregistrer un utilisateur
    function enregistrerUtilisateur(nom, email, mot_de_passe, type_utilisateur, photo_profil) {
      $.ajax({
        url: 'controller/UtilisateurController.php', // URL du script PHP pour enregistrer l'utilisateur
        dataType: 'json',
        type: 'POST',
        data: {
          nom: nom,
          email: email,
          mot_de_passe: mot_de_passe,
          type_utilisateur: type_utilisateur,
          photo_profil: photo_profil
        },
        success: function(response) {
          // Traitement de la réponse du serveur
          console.log(response.message);
          if (response.success) {
            // Afficher une alerte de succès avec SweetAlert
            Swal.fire({
              icon: 'success',
              title: 'Enregistrement Reuissit',
              text: 'Bienvenue '
            });
          } else {
            
            // Afficher une alerte d'erreur avec SweetAlert
            Swal.fire({
              icon: 'error',
              title: 'Erreur',
              text: response.message
            });
          }
          
          // Faire d'autres actions si nécessaire
        },
        error: function(xhr, status, error) {
          // Gestion des erreurs lors de la requête AJAX
          console.error(error);
          
          // Afficher une alerte d'erreur avec SweetAlert
          Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'Une erreur s\'est produite lors de la requête AJAX.'
          });
        }
      });
    }
    
  
    // Événement de soumission du formulaire d'inscription
    $('#inscriptionForm').submit(function(e) {
      e.preventDefault(); // Empêcher le rechargement de la page
  
      // Récupérer les valeurs des champs du formulaire
      var nom = $('#name').val();
      var email = $('#email').val();
      var mot_de_passe = $('#password').val();
      var type_utilisateur = $('#type_utilisateur').val();
      var photo_profil = $('#photo_profil').val();
      localStorage.setItem('user_name', nom);
  
      // Appeler la fonction pour enregistrer l'utilisateur
      enregistrerUtilisateur(nom, email,mot_de_passe, type_utilisateur, photo_profil);
    });




  });
  