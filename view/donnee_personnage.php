<?php
echo '<div id="vie-info">';
echo 'Vie : <span id="vie-actuelle">' . $donneepartie['perso_vie_actuelle'] . '</span> / <span id="vie-max">' . $donneepartie['perso_vie_max'] . '</span>';
echo '</div>';?>
<div id="info">Personnage</div>
<?php
echo '<div id="infos-perso" style="display:none;">';
echo 'Informations du personnage :<br>';
echo 'CLasse : ' . $dataclass['nameC'] . '<img id="image_class" src="image/class/' . $dataclass["img_class"]. '.png"> <br>';
echo 'Niveau : ' . $donneepartie['perso_lvl'] . '<br>';
echo 'Expérience : ' . $donneepartie['exp'] . '<br>';
echo 'Attaque : ' . $donneepartie['perso_attaque'] . '<br>';
echo 'Dexterite : ' . $donneepartie['exp'] . '<br>';
echo 'Vitesse : ' . $donneepartie['perso_vitesse'] . '<br>';
echo 'Defence : ' . $donneepartie['perso_def'] . '<br>';
echo '</div>';
?>