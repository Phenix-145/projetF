<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!empty($_POST['password'] && !empty($_POST['speudo']))) {
    $login = preg_replace("/[^\w\s-]/", '', $_POST['speudo']);


    require_once "../bdd/bdd.php";
    $bdd = new Bdd();
    $sel = $bdd->getsel($login);
    $sel = $sel['salt'];
    if (!empty($sel)) {
        $pwd = $_POST['password'];
        $mdpsalé  = $sel . $pwd;
        $mdphash =  hash("sha512", $mdpsalé);
        $log = $bdd->getConnexion($login, $mdphash);
        if (!empty($log)) {
            $speudo = $log[0]['speudo'];
            $log = $log[0]['NumClient'];
        }
    }
}

if (!empty($log)) {

    session_start([]);

    $_SESSION["login"] = $log;
    $_SESSION["speudo"] = $speudo;

    header("Location: ../index.php");
} else {
    $_GET['error'] = "Erreur , le login et/ou le mot de passe ne correspondent pas.";
    header("Refresh: 0; ../Login.php?error=" . urlencode(htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8')));
    exit;
}
