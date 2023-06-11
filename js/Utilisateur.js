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
              title: 'Utilisateur Enregistré avec succès',
              text: 'Bienvenue '+localStorage.getItem('user_name')
            });
          } else {
            
            // Afficher une alerte d'erreur avec SweetAlert
            Swal.fire({
              icon: 'error',
              title: 'Erreur',
              text: 'OUPS !! Utilisateur Non enregistré '
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

    $('#conForm').submit(function(event) {
      event.preventDefault(); // Empêcher le comportement par défaut du formulaire
      
      var email = $('#conemail').val(); // Récupérer la valeur de l'email
      var password = $('#conpassword').val(); // Récupérer la valeur du mot de passe
      localStorage.setItem('conpassword', password);
      localStorage.setItem('conemail', email);
      
      // Envoyer la requête Ajax
      $.ajax({
        url: 'controller/UtilisateurController.php', // URL du script PHP pour la vérification de l'utilisateur
        dataType: 'json',
        type: 'GET',
        data: {
          email: email,
          password: password
        },
        success: function(response) {
          // Traitement de la réponse du serveur
          
          if (response.success) {
            // L'utilisateur est enregistré dans la base de données
            // Faire les actions nécessaires (par exemple, rediriger l'utilisateur vers une autre page)
            Swal.fire({
              icon: 'success',
              title: 'Succès',
              text: 'Connecté avec succes',
              confirmButtonText: 'OK'
            }).then(function() {
              window.location.href = 'page_success.html';
            });
          } else {
            // L'utilisateur n'est pas enregistré dans la base de données
            // Afficher un message d'erreur
            Swal.fire({
              icon: 'error',
              title: 'Erreur',
              text: 'Utilisateur non Reconnu veuillez vous inscrire',
              confirmButtonText: 'OK'
            });
          }
        },
        error: function(xhr, status, error) {
          // Gestion des erreurs lors de la requête AJAX
          console.error(error);
          
          // Afficher un message d'erreur générique
          Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'Une erreur s\'est produite lors de la requête AJAX.',
            confirmButtonText: 'OK'
          });
        }
      });
    });
    
    


  });
  