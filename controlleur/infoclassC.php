<?php
require_once "bdd/Bdd.php";
$bdd = new Bdd();

$donneeclass = $bdd->infoclass();
?>