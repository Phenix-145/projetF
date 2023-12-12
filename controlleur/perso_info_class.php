<?php
require_once "bdd/Bdd.php";
$bdd = new Bdd();

$dataclass = $bdd->data_class($donneepartie['ID_partie']);
?>