
<?php 

    require("controlleur/info_sup_partie.php");
    require("donnee_personnage.php");

    if ($evenement == "fight"){
        require("fightV.php");
        print_r($evenement);
    }




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




    <!-- script pour la section partie ("gére les interation") -->
    <script src="javascript/partie.js"></script>