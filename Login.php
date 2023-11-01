<?php require('view/HeaderV.php')?>

<div class="box" id="centree">
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Sign Up</button>
<button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Login</button>
</div>

<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close">&times;</span>
  <form class="modal-content" method="post" action="controlleur/Sign_upControlleur.php">
    <div class="container">
      <p>Veuillez remplir ce formulaire pour créer un compte.</p>
      <hr>
      <!-- <label class="box" for="email"><b>Email<span id="asterisk">*</b></span> <div id="message">L'Email n'est pas obligatoire</div></label>
      <input type="text" placeholder="Enter Email" name="email"> -->
      
      <label for="speudo"><b>Speudo</b></label>
      <input type="text" placeholder="Enter un Speudo" name="speudo" required>

      <label for="password"><b>Mot de passe</b></label>
      <input type="password" placeholder="Enter un mot de passe" name="password" required>

      <label for="Rpassword"><b>Réentrée le mot de passe</b></label>
      <input type="password" placeholder="Réentrée le mot de passe" name="Rpassword" required>

      <!-- <p>En créant un compte, vous acceptez nos <a href="#" style="color:dodgerblue">conditions et confidentialité</a>.</p> -->

      <div class="clearfix">
        <button type="submit" class="signupbtn">Sign Up</button>
      </div>
    </div>
  </form>
</div>

<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="close">&times;</span>
  <form class="modal-content" method="post" action="controlleur/LoginControlleur.php">
    <div class="container">
      
      <label for="speudo"><b>Speudo</b></label>
      <input type="text" placeholder="Enter votre Speudo" name="speudo" required>

      <label for="password"><b>Mot de passe</b></label>
      <input type="password" placeholder="Enter votre mot de passe" name="password" required>

      <div class="clearfix">
        <button type="submit" class="signupbtn">Login</button>
      </div>
    </div>
  </form>
</div>



<script src="javascript/interrationLogin.js"></script>
    
            <?php require('view/BottomV.php'); ?>