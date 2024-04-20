<?php
session_start();
// Fonction pour mettre à jour les vies

function update_vies($vieJoueur, $vieEnnemi) {
    // Vérification si une des valeurs est null
    if ($vieJoueur !== null && $vieEnnemi !== null) {
        require_once "../bdd/Bdd.php";
        $bdd = new Bdd();
        $donneepartie = $bdd->donnéepartieActive($_SESSION["NClient"]); //rajouté car la variable est inconnu sur ce fichier 
        $bdd->update_vie($donneepartie['ID_partie'], $vieJoueur, $vieEnnemi);
        return true; // Mise à jour réussie
    } else {
        return false; // Erreur : valeurs manquantes
    }
}
?>
