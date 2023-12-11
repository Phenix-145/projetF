<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION['speudo'])) {
        $speudo = $_SESSION['speudo'];
    } else {
        header("Location: Login.php");
        die();
    }
}
require('view/HeaderV.php');

require('controlleur/InfoUserC.php');
if ($donneepartie != null) {
    require('view/curentgame.php'); //rentre quand donneepartie contie des données de la partie crée ou encour
} else {
    require('view/choix_classe.php'); //selection d'une class est création de la partie
}


require('view/BottomV.php'); ?>