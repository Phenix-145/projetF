<?php
require_once "bdd/Bdd.php";
$bdd = new Bdd();

$donneepartie = $bdd->donnéepartieActive($_SESSION["NClient"]);
?>