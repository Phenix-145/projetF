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

require('view/curentgame.php');

require('view/BottomV.php'); ?>