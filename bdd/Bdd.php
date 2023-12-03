<?php

class Bdd
{
  private $bdd;

  public function __construct()
  {
    require_once 'data.php';
    $dsn = 'mysql:dbname=pmu_bdd;host=localhost:3306';
    $dbUser = recupnam();
    $dbPwd = recuppwd();

    try {
      $this->bdd = new PDO($dsn, $dbUser, $dbPwd);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function getConnexion($login, $mdp)
  {
    $sql = "SELECT ID_user AS NumClient, login_user AS speudo FROM  projetf.user WHERE password = :pwd and login_user = :login  ";
    $query = $this->bdd->prepare($sql);
    $query->execute(array(":login" => $login, ":pwd" => $mdp));
    return $query->fetch();
  }

  //test si le log existe
  public function gettestlogin($login)
  {
    $sql = "SELECT login_user AS speudo FROM  projetf.user WHERE login_user = :user";
    $query = $this->bdd->prepare($sql);
    $query->execute(array(":user" => $login));
    return $query->fetch();
  }

  //recupertation du sel pour la connexion
  public function getsel($login)
  {
    $sql = "SELECT sel AS salt FROM  projetf.user WHERE login_user = :user";
    $query = $this->bdd->prepare($sql);
    $query->execute(array(":user" => $login));
    return $query->fetch();
  }

  //création nouveau utilisateur
  public function newuser($login, $pwd, $sel)
  {
    $sql = "INSERT INTO projetf.user (login_user, password, sel) VALUES (:user, :motDePasse, :sel)";
    try {
      $query = $this->bdd->prepare($sql);
      $query->execute(array(":user" => $login, ":motDePasse" => $pwd, ":sel" => $sel));
      return true;
    } catch (PDOException $e) {
      return false;
    }
  }


  public function donnéepartieActive($NumUtilisateur)
  {
    $sql = "SELECT ID_partie, perso_lvl, exp, perso_attaque, perso_vittesse, perso_vie_max, perso_vie_actuelle, perso_def FROM projetf.partie_active WHERE NumUSER = :Nuser";
    $query = $this->bdd->prepare($sql);
    $query->execute(array(":Nuser" => $NumUtilisateur));
    return $query->fetch();
  }

  public function infoclass()
  {
    $sql = "SELECT ID_class, name_class, libelle_class, attaqueBase, vitesseBase, vieBase, deffenceBase, img_class FROM projetf.class;";
    $query = $this->bdd->prepare($sql);
    $query->execute(array());
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

}
?>