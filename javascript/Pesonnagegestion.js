

var Partie = (function () {
    var valeursPersonnage = null;

    function initialiserValeurs() {
        if (!valeursPersonnage) {
            valeursPersonnage = {
                vieactuelle: parseInt(document.getElementById("perso-vie-actuelle").textContent),
                viemax: parseInt(document.getElementById("perso-vie-max").textContent),
                attaque: parseInt(document.getElementById("perso-attaque").textContent),
                dexterite: parseInt(document.getElementById("perso-dexterite").textContent),
                vitesse: parseInt(document.getElementById("perso-vitesse").textContent),
                defense: parseInt(document.getElementById("perso-def").textContent),
                lvl: parseInt(document.getElementById("perso-lvl").textContent),
                exp: parseInt(document.getElementById("perso-exp").textContent)
            };
        }
    }

    function getValeursPersonnage() {
        return valeursPersonnage;
    }

    function mettreAJourValeurs(nouvellesValeurs) {
        valeursPersonnage = nouvellesValeurs;
    }

    return {
        initialiserValeurs: initialiserValeurs,
        getValeursPersonnage: getValeursPersonnage,
        mettreAJourValeurs: mettreAJourValeurs
    };
})();