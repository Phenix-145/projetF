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
                var defenseEnnemi = parseInt(document.getElementById("ennemy-defence").textContent);
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


        //determine l'orde de passage dans le tour 0 = Joueur et 1 = ennemie en fonction la la vitesse 
        function determinerOrdreAttaque() {
            if (tableauDeuxDimensions[0][3] > tableauDeuxDimensions[1][3]) {
                return [0, 1];
            } else if (tableauDeuxDimensions[0][3] < tableauDeuxDimensions[1][3]) {
                return [1, 0];
            } else {
                return Math.random() < 0.5 ? [0, 1] : [1, 0];
            }
        }


        function attaque(entiteActive, entiteCibleParade) {
            var entiteCible = entiteActive === 0 ? 1 : 0;
        
            // Calculer l'attaque
            var attaqueCritique = Math.random() < (tableauDeuxDimensions[entiteActive][2] / 100);
            var attaqueEntiteActive = tableauDeuxDimensions[entiteActive][1];
            if (attaqueCritique) {
                attaqueEntiteActive *= 2;
                console.log("Coup Critique! Dégâts doublés.");
            }
        
            // Gestion de la parade
            var perfectPari = false;
            var defEntiteCible = tableauDeuxDimensions[entiteCible][4];
            if (entiteCibleParade) {
                var paradeCritReussi = Math.random() < (tableauDeuxDimensions[entiteCible][2] / 100);
                if (paradeCritReussi) {
                    console.log("Parade parfaite! Aucun dégât.");
                    perfectPari = true;
                } else {
                    defEntiteCible *= 2;
                }
            }
        
            // Appliquer les dégâts si pas de parade parfaite
            if (!perfectPari) {
                // Calculer le pourcentage de réduction de dégâts en fonction de la défense
                var reductionDegats = defEntiteCible / (defEntiteCible + 100);
        
                var damage = parseInt(Math.max(attaqueEntiteActive * (1 - reductionDegats), 0));
        
                if (damage === 0) {
                    console.log("La défense a tout bloqué. Aucun dégât.");
                }
                tableauDeuxDimensions[entiteCible][0] = Math.max(tableauDeuxDimensions[entiteCible][0] - damage, 0);
        
                // Mise à jour de l'interface utilisateur et vérification de la vie
                miseAJourVieUI(entiteCible);
        
                // Vérifier si le joueur ou l'ennemi est mort
                verifierMort(entiteCible);
            }
        }
        
        
        function miseAJourVieUI(entiteCible) {
            if (entiteCible === 0) {
                Partie.mettreAJourValeurs(tableauDeuxDimensions[entiteCible][0]);
                document.getElementById("perso-vie-actuelle").innerHTML = tableauDeuxDimensions[entiteCible][0];
            } else {
                document.getElementById("ennemy-vie").innerHTML = tableauDeuxDimensions[entiteCible][0];
            }
        }
        
        function verifierMort(entiteCible) {
            var vieJoueur = tableauDeuxDimensions[0][0];
            var vieEnnemi = tableauDeuxDimensions[1][0];
        
            if (entiteCible === 0 && vieJoueur <= 0) {
                //charge le scipt pour le game over
                chargerScript('javascript/GameOver.js', function () {
                    if (typeof finDePartie === 'function') {
                        finDePartie(vieJoueur, vieEnnemi);
                    }
                });
            } else if (entiteCible === 1 && vieEnnemi <= 0) {
                //charge le script pour passer au palier supérieur 
                chargerScript('javascript/paliersup.js', function () {
                    if (typeof finDepalier === 'function') {
                        finDepalier(vieJoueur, vieEnnemi);
                    }
                });
            }
        }

        function chargerScript(src, callback) {
            var scriptElement = document.createElement('script');
            scriptElement.src = src;
            document.head.appendChild(scriptElement);
        
            scriptElement.onload = callback;
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
