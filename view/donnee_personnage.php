<?php
echo '<div id="vie-info">';
echo 'Vie : <span id="perso-vie-actuelle">' . $donneepartie['perso_vie_actuelle'] . '</span> / <span id="perso-vie-max">' . $donneepartie['perso_vie_max'] . '</span>';
echo '</div>';
?>
<div id="info">Personnage</div>
<?php
echo '<div id="infos-perso" style="display:none;">';
echo 'Informations du personnage :<br>';
echo 'CLasse : ' . $dataclass['nameC'] . '</span><img id="image_class" src="image/class/' . $dataclass["img_class"] . '.png"> <br>';
echo 'Niveau : <span id="perso-lvl">' . $donneepartie['perso_lvl'] . '</span><br>';
echo 'Expérience : <span id="perso-exp">' . $donneepartie['exp'] . '</span><br>';
echo 'Attaque : <span id="perso-attaque">' . $donneepartie['perso_attaque'] . '</span><br>';
echo 'Dexterite : <span id="perso-dexterite">' . $donneepartie['dexterite'] . '</span><br>';
echo 'Vitesse : <span id="perso-vitesse">' . $donneepartie['perso_vitesse'] . '</span><br>';
echo 'Defence : <span id="perso-def">' . $donneepartie['perso_def'] . '</span><br>';
echo '</div>';
?>
<!-- script pour la section partie ("gére les interation") -->
<script src="javascript/Pesonnagegestion.js"></script>