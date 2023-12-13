// js/combat.js
document.addEventListener('DOMContentLoaded', function() {
    var ennemyInfo = {
        ennemy_name: "mannequin",
        vie: 100,
        attaque: 2,
        dexterite: 1,
        defence: 0,
        vitesse: 1,
        img_ennemy: "mannequin"
    };

    // Remplir les informations de l'ennemi dans la page
    document.getElementById('ennemy-name').textContent = ennemyInfo.ennemy_name;
    document.getElementById('ennemy-vie').textContent = ennemyInfo.vie;
    document.getElementById('ennemy-attaque').textContent = ennemyInfo.attaque;
    document.getElementById('ennemy-dexterite').textContent = ennemyInfo.dexterite;
    document.getElementById('ennemy-defence').textContent = ennemyInfo.defence;
    document.getElementById('ennemy-vitesse').textContent = ennemyInfo.vitesse;
    document.getElementById('ennemy-image').src = 'image/ennemy/' + ennemyInfo.img_ennemy + '.png';
});
