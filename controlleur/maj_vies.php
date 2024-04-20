<?php
// Inclure le fichier contenant la fonction pour mettre à jour les vies
require_once "update_vies.php";

// Récupérer les données de vie du joueur et de l'ennemi
$vieJoueur = isset($_POST['vieJoueur']) ? $_POST['vieJoueur'] : null;
$vieEnnemi = isset($_POST['vieEnnemi']) ? $_POST['vieEnnemi'] : null;

// Appeler la fonction pour mettre à jour les vies
if (update_vies($vieJoueur, $vieEnnemi)) {
    echo 'Mise à jour des vies réussie.';
} else {
    echo 'Erreur : valeurs manquantes.';
}
?>