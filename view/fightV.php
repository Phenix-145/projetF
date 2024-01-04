<?php
require("controlleur/fightC.php");
?>

<div id="combat-interface">
    <div id="ennemy-info">
        <?php echo "<h2> " . $combat['ennemy_name'] . " </h2> " ?>
        <div class="box">
            <img id="ennemy-image" src="image/ennemy/<?php echo $combat['img_ennemy']; ?>.png" alt="Ennemi">
            <div id="ennemy-stats">
                <p>Vie: <span id="ennemy-vie"><?php echo $combat['vie']; ?></span></p>
                <p class="ennemy_infoEX">Attaque: <span id="ennemy-attaque"><?php echo $combat['attaque']; ?></span></p>
                <p class="ennemy_infoEX">Dextérité: <span id="ennemy-dexterite"><?php echo $combat['dexterite']; ?></span></p>
                <p class="ennemy_infoEX">Défense: <span id="ennemy-defence"><?php echo $combat['defence']; ?></span></p>
                <p class="ennemy_infoEX">Vitesse: <span id="ennemy-vitesse"><?php echo $combat['vitesse']; ?></span></p>
            </div>
        </div>
    </div>
        <div id="actions">
            <button id="attaquer-btn">Attaquer</button>
            <button id="parer-btn">Parer</button>
        </div>
</div>

<script src="javascript/combat.js"></script>