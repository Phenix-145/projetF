<?php require('view/HeaderV.php')?>

<div class="box" id="centree">
<button class="boutonPageLogin" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Sign Up</button>
<button class="boutonPageLogin" onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Login</button>
</div>

<?php
if (isset($_GET['error'])) {
  $messageErreur = $_GET['error'];
  echo '<div class="erreur">' . htmlspecialchars($messageErreur) . '</div>';
}
?>

<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close">&times;</span>
  <form class="modal-content" method="post" action="controlleur/Sign_upControlleur.php">
    <div class="container">
      <p>Veuillez remplir ce formulaire pour créer un compte.</p>
      
      <label for="speudo"><b>Speudo</b></label>
      <input type="text" placeholder="Enter un Speudo" name="speudo" autocomplete="off" required>

      <label for="password"><b>Mot de passe</b></label>
      <input type="password" placeholder="Enter un mot de passe" name="password" required>

      <label for="Rpassword"><b>Réentrée le mot de passe</b></label>
      <input type="password" placeholder="Réentrée le mot de passe" name="Rpassword" required>

      <!-- <p>En créant un compte, vous acceptez nos <a href="#" style="color:dodgerblue">conditions et confidentialité</a>.</p> -->

      <div class="clearfix">
        <button type="submit" class="signupbtn, boutonPageLogin">Sign Up</button>
      </div>
    </div>
  </form>
</div>

<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="close">&times;</span>
  <form class="modal-content" method="post" action="controlleur/LoginControlleur.php">
    <div class="container">
      
      <label for="speudo"><b>Speudo</b></label>
      <input type="text" placeholder="Enter votre Speudo" name="speudo" autocomplete="off" required>

      <label for="password"><b>Mot de passe</b></label>
      <input type="password" placeholder="Enter votre mot de passe" name="password" required>

      <div class="clearfix">
        <button type="submit" class="signupbtn, boutonPageLogin">Login</button>
      </div>
    </div>
  </form>
</div>



<script src="javascript/interrationLogin.js"></script>
    
            <?php require('view/BottomV.php'); ?>