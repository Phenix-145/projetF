<?php
session_start();


if ( isset( $_GET["classe"])){
    $classeSelect = $_GET["classe"];

    require_once "../bdd/bdd.php";
    $bdd = new Bdd();
    
    $dataclass = $bdd->testclass($classeSelect);
    if ($dataclass != null) {
        $numclient =  $_SESSION["NClient"];
        $donneepartie = $bdd->GenerationPartie($dataclass, $numclient);
        
        exit();
    }else{
        header("Location: ../index.php");
        exit();
    }

}
?>