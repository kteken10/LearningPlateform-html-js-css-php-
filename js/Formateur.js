$(document).ready(function() {
    // Fonction pour créer un formateur via Ajax
    function createFormateur(formData) {
        $.ajax({
            url: "controller/FormateurController.php", // Remplacez "chemin/vers/FormateurController.php" par le chemin réel vers le fichier PHP
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(response) {
                // Traitement de la réponse JSON reçue du serveur
                if (response.success) {
                  
                    Swal.fire({
                        icon: 'success',
                        title: 'Formateur  '+localStorage.getItem('user_name') +'  créé avec succès',
                        text: 'bonne formation'
                    });
                    localStorage.setItem('user_role', 'formateur');
                    localStorage.setItem('id_formateur',response.data);
                } else {
                   
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur lors de la création du formateur',
                        text: 'Un formateur existe déja avec L\' adresse  mail:  '+localStorage.getItem('conemail') +'  Connecter vous pour dispenser vos cour'
                    });
                }
            },
            error: function(xhr, status, error) {
                // Gérer les erreurs de la requête Ajax
                console.log("Erreur de la requête Ajax");
                console.log(xhr.responseText); // Afficher la réponse du serveur en cas d'erreur
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur de la requête Ajax',
                    text: 'Une erreur s\'est produite lors de la requête Ajax.'
                });
            }
        });
    }

    // Gestionnaire d'événement pour le clic sur le lien du formateur
    $("#formateur-link").click(function(event) {
        event.preventDefault();
        var nom = localStorage.getItem("user_name");
        var mot_de_passe = localStorage.getItem("conpassword");
        var email = localStorage.getItem("conemail");

        // Création de l'objet de données à envoyer dans la requête Ajax
        var formData = {
            nom: nom,
            mot_de_passe: mot_de_passe,
            email: email
        };
        createFormateur(formData);
    });
});
