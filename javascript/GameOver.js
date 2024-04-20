(function () {
    // Variable de contrôle pour s'assurer que la requête de fin de partie ne soit effectuée qu'une fois
    var requeteFinPartieEffectuee = false;

    // Fonction pour envoyer la requête de fin de partie
    function envoyerRequeteFinPartie(vieJoueur, vieEnnemi) {
        // Vérifier si la requête a déjà été effectuée
        if (requeteFinPartieEffectuee) {
            console.log('La requête de fin de partie a déjà été effectuée.');
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

                // Marquer la requête comme effectuée
                requeteFinPartieEffectuee = true;
            }
        };

        // Envoyer la requête avec les données de vie du joueur et de l'ennemi
        xhr.send('vieJoueur=' + vieJoueur + '&vieEnnemi=' + vieEnnemi);
    }

    // Exposer la fonction envoyerRequeteFinPartie pour qu'elle soit accessible à l'extérieur
    window.envoyerRequeteFinPartie = envoyerRequeteFinPartie;
})();

function finDePartie(vieJoueur, vieEnnemi) {
// appele envoyerRequeteFinPartie
    envoyerRequeteFinPartie(vieJoueur, vieEnnemi);
    // test 
    console.log('La partie est terminée. Vie du joueur : ' + vieJoueur + ', Vie de l\'ennemi : ' + vieEnnemi);

    // Créer un élément div pour afficher le message
    var messageDiv = document.createElement('div');
    messageDiv.innerHTML = 'Fin de la partie';
    messageDiv.classList.add('message-finpartie');

    // Créer un bouton "Continuer"
    var boutonContinuer = document.createElement('button');
    boutonContinuer.innerHTML = 'nouvelle partie';
    boutonContinuer.classList.add('bouton-continuer');

    // Ajouter un gestionnaire d'événements au bouton "Continuer"
    boutonContinuer.addEventListener('click', function () {
        
    // Redirection vers la page choix_classe.php
    window.location.href = 'index.php';    
        
    });

    // Ajouter le bouton à l'élément div
    messageDiv.appendChild(boutonContinuer);

    // Ajouter l'élément div au corps de la page
    document.body.appendChild(messageDiv);
}

