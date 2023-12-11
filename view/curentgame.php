
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
                    <td>test</td>
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
                    <td>test</td>
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





<script>
    function openinventaireC() {
        document.getElementById("inventairecarte").style.width = "100%";
    }

    function closeinventaireC() {
        document.getElementById("inventairecarte").style.width = "0";
    }

    function openinventaireI() {
        document.getElementById("inventaireitem").style.width = "100%";
    }

    function closeinventaireI() {
        document.getElementById("inventaireitem").style.width = "0";
    }
</script>