$(document).ready(function() {
    // Fonction pour enregistrer un utilisateur
    function enregistrerUtilisateur(nom, email, motDePasse, typeUtilisateur, photoProfil) {
      $.ajax({
        url: 'controller/UtilisateurController.php', // URL du script PHP pour enregistrer l'utilisateur
        type: 'POST',
        data: {
          nom: nom,
          email: email,
          motDePasse: motDePasse,
          typeUtilisateur: typeUtilisateur,
          photoProfil: photoProfil
        },
        success: function(response) {
          // Traitement de la réponse du serveur
          console.log(response);
          // Faire d'autres actions si nécessaire
        },
        error: function(xhr, status, error) {
          // Gestion des erreurs lors de la requête AJAX
          console.error(error);
        }
      });
    }
  
    // Événement de soumission du formulaire d'inscription
    $('#inscriptionForm').submit(function(e) {
      e.preventDefault(); // Empêcher le rechargement de la page
  
      // Récupérer les valeurs des champs du formulaire
      var nom = $('#name').val();
      var email = $('#email').val();
      var motDePasse = $('#password').val();
      var typeUtilisateur = $('#userType').val();
      var photoProfil = $('#profilePic').val();
  
      // Appeler la fonction pour enregistrer l'utilisateur
      enregistrerUtilisateur(nom, email, motDePasse, typeUtilisateur, photoProfil);
    });




  });
  