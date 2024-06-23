<?php
// Inclure le fichier contenant la fonction pour changer le biome et récupérer un nouvel événement
require_once "gestion_palier.php";

// Appeler la fonction pour changer le biome et récupérer un nouvel événement
$result = changer_palier();

if ($result) {
    echo 'Changement de palier réussi.';
} else {
    echo 'Erreur : impossible de changer de palier.';
}
?>

