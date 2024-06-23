(function () {
    // Variable de contrôle pour s'assurer que la requête de mise à jour ne soit effectuée qu'une fois à la fois
    var requeteMiseAJourEffectuee = false;

    // Fonction pour envoyer la requête de mise à jour des vies
    function envoyerRequeteMiseAJour(vieJoueur, vieEnnemi) {
        // Vérifier si une requête est déjà en cours
        if (requeteMiseAJourEffectuee) {
            console.log('Une requête de mise à jour est déjà en cours.');
            return;
        }

        // Créer un objet XMLHttpRequest
        var xhr = new XMLHttpRequest();

        // Configuration de la requête
        xhr.open('POST', 'controlleur/maj_vies.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        // Gérer la réponse de la requête
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // La requête a été traitée avec succès
                console.log(xhr.responseText);

                // Marquer la requête comme terminée
                requeteMiseAJourEffectuee = false;
                location.reload();
            }
        };

        // Marquer la requête comme en cours
        requeteMiseAJourEffectuee = true;

        // Envoyer la requête avec les données de vie du joueur et de l'ennemi
        xhr.send('vieJoueur=' + vieJoueur + '&vieEnnemi=' + vieEnnemi);
    }

    // Exposer la fonction envoyerRequeteMiseAJour pour qu'elle soit accessible à l'extérieur
    window.envoyerRequeteMiseAJour = envoyerRequeteMiseAJour;
})();

// Fonction pour mettre à jour les vies du joueur et de l'ennemi et continuer la partie
function finDepalier(vieJoueur, vieEnnemi) {
    // Appeler envoyerRequeteMiseAJour
    envoyerRequeteMiseAJour(vieJoueur, vieEnnemi);


    // Appeler la fonction pour charger un nouvel événement
    chargerNouvelEvenement();

    // Log pour indiquer que les vies sont mises à jour et que la partie continue
    console.log('Vies mises à jour. Vie du joueur : ' + vieJoueur + ', Vie de l\'ennemi : ' + vieEnnemi);
}



function chargerNouvelEvenement() {
    // Créer un objet XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Configuration de la requête
    xhr.open('GET', 'controlleur/changement_palier.php', true);

    // Envoyer la requête sans écouter la réponse
    xhr.send();
}


