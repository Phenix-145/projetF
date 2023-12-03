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

require('view/InfoUserV.php');
if ($donneepartie != null) {
    require('view/curentgame.php');
} else {
    require('view/choix_classe.php');
}


require('view/BottomV.php'); ?>