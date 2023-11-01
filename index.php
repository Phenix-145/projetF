<?php 
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
        if (isset($_SESSION['speudo'])){
            $speudo = $_SESSION['speudo'];
        }else{
            header("Location: Login.php");
            die();
        }
    } 
 require('view/HeaderV.php')?>



    <div id="mySidenav" class="sidenav">
        <button class="openbtn" onclick="openinventaireC()" id="Carte">Carte</button>
        <button class="openbtn" onclick="openinventaireI()" id="Item">Item</button>
    </div>
    <div id="inventairecarte" class="sidepanel">
        <a href="javascript:void(0)" class="closebtn" onclick="closeinventaireC()">×</a>
        test

    </div>
    <div id="inventaireitem" class="sidepanel">
        <a href="javascript:void(0)" class="closebtn" onclick="closeinventaireI()">×</a>
        test

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
  <?php require('view/BottomV.php'); ?>