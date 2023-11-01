<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if ( !empty($_POST['password'] && !empty($_POST['speudo'])) )
    {
        $login = $_POST['speudo'];
        $mdp =  hash("sha512", $_POST['password']);

        require_once "../bdd/bdd.php";
        $bdd = new Bdd();
        $log = $bdd->getConnexion($login,$mdp);
        if (!empty($log)){
            $speudo =$log[0]['speudo'];
            $log = $log[0]['NumClient'];
            
        }
    }

    if (!empty($log)) {
      
    session_start([]);

    $_SESSION["login"] = $log;
    $_SESSION["speudo"] = $speudo;

        header("Location: ../index.php");
        echo "Vous êtes connecté !";
    } else {
        $_GET['error'] = "Erreur , le login et/ou le mot de passe ne correspondent pas.";
        echo "Erreur,  Vous allez etre redirigé";
        header("Refresh: 2; ../Login.php?error=". htmlspecialchars($_GET['error']));
        exit;
    }
?>