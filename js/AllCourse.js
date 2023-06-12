$(document).ready(function() {
    // Fonction pour récupérer la liste des cours depuis le serveur
    function getCourses() {
      $.ajax({
        url: 'controller/GestionCoursController.php',
        type: 'GET',
        dataType: 'json',
        success: function(courses) {
          // Traiter la réponse du serveur
          var nombre_cours = courses.length;
          if (courses.success) {
            // Les cours ont été récupérés avec succès
            Swal.fire({
              icon: 'success',
              title: 'Liste des cours récupérée avec succès',
              text: 'Total de cours trouvé : ' + nombre_cours,
            });
  
            console.log(courses.data); // Afficher les données des cours récupérés
  
            // Afficher les cours dans le tableau
            displayCourseList(courses.data);
          } else {
            // Une erreur s'est produite lors de la récupération des cours
            Swal.fire({
              icon: 'error',
              title: 'Erreur lors de la récupération des cours',
              text: courses.message,
            });
  
            console.log('Erreur lors de la récupération des cours');
            console.log(courses.message); // Afficher le message d'erreur
          }
        },
        error: function(xhr, status, error) {
          // Gérer les erreurs de la requête Ajax
          console.log('Erreur de la requête Ajax');
          console.log(xhr.responseText); // Afficher la réponse du serveur en cas d'erreur
        },
      });
    }
  
    // Fonction pour afficher la liste des cours dans le tableau
    function displayCourseList(coursesList) {
      var coursContainer = $('#cours-container');
      coursContainer.empty(); // Vider le contenu du conteneur
  
      // Parcourir la liste des cours et ajouter chaque cours dans le conteneur
      for (var i = 0; i < coursesList.length; i++) {
        var course = coursesList[i];
        console.log(course)
  
        // Générer le code HTML pour chaque cours
        var courseCard =
          '<div class="col-lg-4">' +
          '<div class="card">' +
          '<img src="' +
          course.image +
          '" class="card-img-top" alt="Image du cours">' +
          '<div class="card-body">' +
          '<h5 class="card-title">' +
          course.titre +
          '</h5>' +
          '<p class="card-text">' +
          course.description +
          '</p>' +
          '<div class="embed-responsive embed-responsive-16by9">' +
          '<iframe class="embed-responsive-item" src="' +
          course.video +
          '" allowfullscreen></iframe>' +
          '</div>' +
          '<a href="#" class="btn btn-primary">Visionner</a>' +
          '</div>' +
          '</div>' +
          '</div>';
  
        // Ajouter le cours au conteneur
        coursContainer.append(courseCard);
      }
    }
  
    // Appeler la fonction pour récupérer la liste des cours lors du chargement de la page
    getCourses();
  });
  