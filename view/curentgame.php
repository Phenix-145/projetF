
<?php 

    require("controlleur/perso_info_class.php");

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

<div id="mySidenav" class="sidenav">
    <button class="openbtn" onclick="openinventaireC()" id="Carte">Carte</button>
    <button class="openbtn" onclick="openinventaireI()" id="Item">Item</button>
</div>
<div id="inventairecarte" class="sidepanel">
    <a href="javascript:void(0)" class="closebtn" onclick="closeinventaireC()">×</a>
    <div class="centre">
        <table class="Menuconsomable">
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
<div id="inventaireitem" class="sidepanel">
    <a href="javascript:void(0)" class="closebtn" onclick="closeinventaireI()">×</a>
    <div class="centre">
        <table class="Menuconsomable">
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>





    <script src="javascript/partie.js"></script>