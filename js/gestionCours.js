$(document).ready(function() {
    // Gestionnaire d'événement pour le formulaire d'ajout de cours
    $("#ajoutCoursForm").submit(function(event) {
      event.preventDefault();
      
      // Récupérer les valeurs des champs du formulaire
      var imageFond = $("#image_fond").val();
      var libelle = $("#libelle").val();
      var description = $("#description").val();
      var video = $("#video").val();
      var categorie = $("#categorie").val();
      var id_formateur=parseInt(localStorage.getItem("id_formateur"));
  
      // Effectuer ici votre traitement Ajax pour ajouter le cours
      // Utiliser les valeurs récupérées des champs du formulaire
      
      // Exemple de code Ajax
      $.ajax({
        url: "controller/GestionCoursController.php",
        type: "POST",
        data: {
          image_fond: imageFond,
          libelle: libelle,
          description: description,
          video: video,
          categorie: categorie,
          id_formateur:id_formateur
        },
        dataType: "json",
        success: function(response) {
          // Traiter la réponse du serveur
          if (response.success) {
            // Le cours a été ajouté avec succès
            Swal.fire({
              icon: 'success',
              title: 'Cours ajouté avec succès',
              text: response.data, // Utilisez les données du cours ajouté ici
            });
          } else {
            // Une erreur s'est produite lors de l'ajout du cours
            Swal.fire({
              icon: 'error',
              title: 'Erreur lors de l\'ajout du cours',
              text: response.message, // Utilisez le message d'erreur ici
            });
          }
        }
        ,
        error: function(xhr, status, error) {
          // Gérer les erreurs de la requête Ajax
          console.log("Erreur de la requête Ajax");
          console.log(xhr.responseText); // Afficher la réponse du serveur en cas d'erreur
        }
      });
    });
  
    // Fonction pour récupérer la liste des cours depuis le serveur
    function getCoursList() {
      // Effectuer ici votre traitement Ajax pour récupérer la liste des cours
  
      // Exemple de code Ajax
      $.ajax({
        url: "controller/GestionCoursController.php",
        type: "GET",
        dataType: "json",
        success: function(response) {
          // Traiter la réponse du serveur
          var nombre_cours = response.data.length;
          if (response.success) {
            // Les cours ont été récupérés avec succès
            Swal.fire({
              icon: 'success',
              title: 'Liste des cours récupérée avec succès',
              text: 'Total de cour trouvé :'+nombre_cours, // Utilisez les données des cours récupérés ici
            });
        
            console.log(response.data); // Afficher les données des cours récupérés
        
            // Afficher les cours dans le tableau
            displayCoursList(response.data);
          } else {
            // Une erreur s'est produite lors de la récupération des cours
            Swal.fire({
              icon: 'error',
              title: 'Erreur lors de la récupération des cours',
              text: response.message, // Utilisez le message d'erreur ici
            });
        
            console.log("Erreur lors de la récupération des cours");
            console.log(response.message); // Afficher le message d'erreur
          }
        }
        ,
        error: function(xhr, status, error) {
          // Gérer les erreurs de la requête Ajax
          console.log("Erreur de la requête Ajax");
          console.log(xhr.responseText); // Afficher la réponse du serveur en cas d'erreur
        }
      });
    }
  
    // Fonction pour afficher la liste des cours dans le tableau
    function displayCoursList(coursList) {
      var tbody = $("#listeCours tbody");
      tbody.empty(); // Vider le contenu du tableau
  
      // Parcourir la liste des cours et ajouter chaque cours dans le tableau
      for (var i = 0; i < coursList.length; i++) {
        var cours = coursList[i];
        
        var tr = $("<tr></tr>");
        tr.append("<td>" + cours.libelle + "</td>");
        tr.append("<td>" + cours.description + "</td>");
        tr.append("<td><button class='btn btn-danger' data-id='" + cours.id_cours + "'>Supprimer</button></td>");
  
        tbody.append(tr);
      }
    }
  
    // Gestionnaire d'événement pour le bouton de suppression d'un cours
    $(document).on("click", "#listeCours .btn-danger", function() {
      var coursId = $(this).data("id");
      
      // Effectuer ici votre traitement Ajax pour supprimer le cours avec l'ID spécifié
      
      // Exemple de code Ajax
      $.ajax({
        url: "controller/GestionCoursController.php",
        type: "POST",
        data: {
          action: "delete",
          coursId: coursId
        },
        dataType: "json",
        success: function(response) {
          // Traiter la réponse du serveur
          if (response.success) {
            // Le cours a été supprimé avec succès
            console.log("Cours supprimé avec succès");
            console.log(response.data); // Afficher les données du cours supprimé
  
            // Mettre à jour la liste des cours après la suppression
            getCoursList();
          } else {
            // Une erreur s'est produite lors de la suppression du cours
            console.log("Erreur lors de la suppression du cours");
            console.log(response.message); // Afficher le message d'erreur
          }
        },
        error: function(xhr, status, error) {
          // Gérer les erreurs de la requête Ajax
          console.log("Erreur de la requête Ajax");
          console.log(xhr.responseText); // Afficher la réponse du serveur en cas d'erreur
        }
      });
    });
  
    // Appeler la fonction pour récupérer la liste des cours lors du chargement de la page
    getCoursList();
  });
  