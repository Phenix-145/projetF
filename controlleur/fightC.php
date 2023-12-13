<?php
require_once "bdd/Bdd.php";
$bdd = new Bdd();

$combat = $bdd->recup_combat($donneepartie['ID_partie']);
if ($combat == null) {
    $combat = $bdd->New_combat($donneepartie['ID_partie']);
}


?>