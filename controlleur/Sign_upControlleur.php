<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if ( !empty($_POST['password'] && !empty($_POST['speudo']) && !empty($_POST['Rpassword'])) )
    {
        $login = preg_replace("/[^\w\s-]/", '',$_POST['speudo']);
        require_once "../bdd/bdd.php";
        $bdd = new Bdd();
        $test = $bdd->gettestlogin($login);
        if (!empty($test)){
            $_GET['error'] = "speudo déjà utiliser";
            header("Refresh: 0; ../Login.php?error=". urlencode(htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8')));
            exit;
        }


        $pwd = preg_replace("/[^\w\s-]/", '',$_POST['password']);
        $rpwd = preg_replace("/[^\w\s-]/", '',$_POST['Rpassword']);

        if( $pwd == $rpwd){
            $salt = bin2hex(random_bytes(32));
            $password_salt = $salt . $pwd;
        
        $mdp =  hash("sha512", $password_salt);

        require_once "../bdd/bdd.php";
        $bdd = new Bdd();
        $testNew = $bdd->newUser($login,$mdp,$salt);
        }
    }

    if (!empty($testNew) && $testNew == true) {
      
    session_start([]);
    $log = $bdd->getConnexion($login, $mdphash);
    if (!empty($log)) {
        $_SESSION["speudo"] = $log[0]['speudo'];
        $_SESSION["login"]  = $log[0]['NumClient'];
    }else {
        $_GET['error'] = "une erreur ces produit veuillez vous login.";
        header("Refresh: 0; ../Login.php?error=". urlencode(htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8')));
        exit;
    }


        header("Location: ../index.php");
    } else {
        $_GET['error'] = "Erreur , donnée incorrecte.";
        header("Refresh: 0; ../Login.php?error=". urlencode(htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8')));
        exit;
    }
