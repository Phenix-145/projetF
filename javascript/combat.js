// js/combat.js
document.addEventListener('DOMContentLoaded', function () {

    var attaquerBtn = document.getElementById("attaquer-btn");
    var parerBtn = document.getElementById("parer-btn");


    var gestionTableau = (function () {
        // Variables privées
        var tableauCree = false;
        var tableauDeuxDimensions = null;

        // Fonction privée pour créer le tableau en deux dimensions
        function creerTableauDeuxDimensions() {
            if (!tableauCree) {
                Partie.initialiserValeurs();
                // Récupération des valeurs du personnage depuis les attributs de données HTML
                var valeursPersonnage = Partie.getValeursPersonnage(); //erreur non définie 
                var vieactuellePersonnage = valeursPersonnage.vieactuelle;
                var attaquePersonnage = valeursPersonnage.attaque;
                var dexteritePersonnage = valeursPersonnage.dexterite;
                var vitessePersonnage = valeursPersonnage.vitesse;
                var defensePersonnage = valeursPersonnage.defense;

                // Récupération des valeurs de l'ennemi depuis les attributs de données HTML
                var vieEnnemi = parseInt(document.getElementById("ennemy-vie").textContent);
                var attaqueEnnemi = parseInt(document.getElementById("ennemy-attaque").textContent);
                var dexEnnemi = parseInt(document.getElementById("ennemy-dexterite").textContent);
                var defenseEnnemi = parseInt(document.getElementById("ennemy-attaque").textContent);
                var vitesseEnnemi = parseInt(document.getElementById("ennemy-vitesse").textContent);

                // Création d'un tableau en deux dimensions
                tableauDeuxDimensions = [
                    // Première ligne pour le personnage
                    [vieactuellePersonnage, attaquePersonnage, dexteritePersonnage, vitessePersonnage, defensePersonnage],

                    // Deuxième ligne pour l'ennemi
                    [vieEnnemi, attaqueEnnemi, dexEnnemi, vitesseEnnemi, defenseEnnemi]
                ];

                // Rendre le tableau immuable
                Object.freeze(tableauDeuxDimensions);

                // Mettre à jour la variable pour indiquer que le tableau a été créé
                tableauCree = true;
            } else {
                console.log("Le tableau a déjà été créé.");
            }
        }


        //determine lorde de passage dans le tour 0 = Joueur et 1 = ennemie
        function determinerOrdreAttaque() {
            if (tableauDeuxDimensions[0][3] > tableauDeuxDimensions[1][3]) {
                return [0, 1];
            } else if (tableauDeuxDimensions[0][3] < tableauDeuxDimensions[1][3]) {
                return [1, 0];
            } else {
                return Math.random() < 0.5 ? [0, 1] : [1, 0];
            }
        }


        function attaque(entiteactive, entitecibleParade) {
            if (entiteactive == 0) {
                entitecible = 1;
            } else {
                entitecible = 0;
            }

            // Vérifier si la parade fait un "crit"
            var AttqueCritique = Math.random() < (tableauDeuxDimensions[entiteactive][2] / 100);
            if (!AttqueCritique) {
                attaqueentiteactive = tableauDeuxDimensions[entiteactive][1];
            } else {
                attaqueentiteactive = tableauDeuxDimensions[entiteactive][1] * 2;
                console.log("Coup Critique dégat doublée");
            }

            var perfectpari = false;
            //gestion de la parade
            if (entitecibleParade == true) {
                // Vérifier si la parade fait un "crit"
                var paradeCritReussi = Math.random() < (tableauDeuxDimensions[entitecible][2] / 100);
                if (!paradeCritReussi) {
                    Defentitecible = tableauDeuxDimensions[entitecible][4] * 2;
                } else {
                    console.log("Parade parfaite ! Aucun dégât n'est appliqué.");
                    perfectpari = true;
                }
            } else {
                Defentitecible = tableauDeuxDimensions[entitecible][4];
            }

            if (perfectpari == false) {
                dammage = Math.max(attaqueentiteactive - Defentitecible, 0);
                if(dammage == 0){
                    console.log("la défence sup Aucun dégât n'est subit");
                }
                tableauDeuxDimensions[entitecible][0] = Math.max(tableauDeuxDimensions[entitecible][0] - dammage, 0);
                if(entitecible == 0){ 
                    Partie.mettreAJourValeurs(tableauDeuxDimensions[entitecible][0] );
                    document.getElementById("perso-vie-actuelle").innerHTML=tableauDeuxDimensions[entitecible][0];
                }else{
                    document.getElementById("ennemy-vie").innerHTML= tableauDeuxDimensions[entitecible][0];
                }
            }
            
        }


        // Appel automatique de la fonction pour créer le tableau lors du chargement du fichier
        creerTableauDeuxDimensions();

        // Retourner les fonctions publiques
        return {
            determinerOrdreAttaque: determinerOrdreAttaque,
            attaque: attaque
        };
    })();



    //gestion du cicle
    function gestionCicle(paradeJoueur) {
        // rajout comportement ennemi //
        var paradeEnnemi = false; //test

        const entiteordre = gestionTableau.determinerOrdreAttaque();
        let entiteordreAvecParade;
        if (entiteordre[0] == 0) {
            entiteordreAvecParade = [entiteordre, [paradeJoueur, paradeEnnemi]];
        } else {
            entiteordreAvecParade = [entiteordre, [paradeEnnemi, paradeJoueur]];
        }
        for (let i = 0; i < entiteordre.length; i++) {
            if (entiteordreAvecParade[1][i] == false) {
                if (entiteordre[i] == 0) {
                    actioncible = 1;
                } else {
                    actioncible = 0;
                }
                gestionTableau.attaque(entiteordreAvecParade[0][i], entiteordreAvecParade[1][actioncible]);
            }
        }

        paradeEnnemi = false;
        paradeJoueur = false;
    }

    // Gestionnaire d'événement pour le bouton "Attaquer"
    attaquerBtn.addEventListener("click", function () {
        paradeJoueur = false;
        gestionCicle(paradeJoueur)
    });

    // Gestionnaire d'événement Parer
    parerBtn.addEventListener("click", function () {
        paradeJoueur = true;
        gestionCicle(paradeJoueur)
    });
});
