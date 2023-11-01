<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if ( !empty($_POST['password'] && !empty($_POST['speudo']) && !empty($_POST['Rpassword'])) )
    {
        $login = $_POST['speudo'];
        require_once "../bdd/bdd.php";
        $bdd = new Bdd();
        $test = $bdd->gettestlogin($login);
        if (!empty($test)){
            $_GET['error'] = "speudo déjà utiliser";
            header("Refresh: 0; ../Login.php?error=". htmlspecialchars($_GET['error']));
            exit;
        }


        $pwd = $_POST['password'];
        $rpwd = $_POST['Rpassword'];

        if( $pwd == $rpwd){
            $salt = bin2hex(random_bytes(32));
            $password_salt = $salt . $pwd;
        
        $mdp =  hash("sha512", $password_salt);

        require_once "../bdd/bdd.php";
        $bdd = new Bdd();
        $log = $bdd->newUser($login,$mdp,$salt);
        if (!empty($log)){
            $speudo =$log[0]['speudo'];
            $log = $log[0]['NumClient'];
            }
        }
    }

    if (!empty($log)) {
      
    session_start([]);

    $_SESSION["login"] = $log;
    $_SESSION["speudo"] = $speudo;

        header("Location: ../index.php");
        echo "Vous êtes connecté !";
    } else {
        $_GET['error'] = "Erreur , donnée incorrecte.";
        header("Refresh: 0; ../Login.php?error=". htmlspecialchars($_GET['error']));
        exit;
    }
?>