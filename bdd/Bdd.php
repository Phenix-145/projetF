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
    $sql = "SELECT ID_partie, perso_lvl, exp, perso_attaque, dexterite, perso_vitesse, perso_vie_max, perso_vie_actuelle, perso_def FROM projetf.partie_active WHERE NumUSER = :Nuser";
    $query = $this->bdd->prepare($sql);
    $query->execute(array(":Nuser" => $NumUtilisateur));
    return $query->fetch(PDO::FETCH_ASSOC);
  }

  public function infoclass()
  {
    $sql = "SELECT ID_class, name_class, libelle_class, attaque, dexterite, vitesse, vie, defence, img_class FROM projetf.class;";
    $query = $this->bdd->prepare($sql);
    $query->execute(array());
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  public function data_sup_partie($numpartie)
  {
    $sql = "SELECT nameC, img_class, nameB, img_biome, eventeA FROM projetf.infosup_partie where ID = :numPartie;";
    $query = $this->bdd->prepare($sql);
    $query->execute(array(":numPartie" => $numpartie));
    return $query->fetch(PDO::FETCH_ASSOC);
  }

  public function evenement($numpartie)
  {
    $sql = "SELECT evenement FROM projetf.evenement; where ID = :numPartie;";
    $query = $this->bdd->prepare($sql);
    $query->execute(array(":numPartie" => $numpartie));
    return $query->fetch(PDO::FETCH_ASSOC);
  }

  public function testclass($classe)
  {
    $sql = "SELECT ID_class, name_class, libelle_class, attaque, dexterite, vitesse, vie, defence FROM projetf.class WHERE name_class = :classe;";
    $query = $this->bdd->prepare($sql);
    $query->execute(array(":classe" => $classe));
    return $query->fetch(PDO::FETCH_ASSOC);
  }

  public function recup_combat($numpartie)
  {
    $sql = "SELECT ennemy_name, vie, attaque, dexterite, defence, vitesse, img_ennemy FROM projetf.recup_ennemy WHERE numPartie = :numPartie;";
    $query = $this->bdd->prepare($sql);
    $query->execute(array(":numPartie" => $numpartie));
    return $query->fetch(PDO::FETCH_ASSOC);
  }




  public function New_combat($numpartie)
  {
    $sql = "SELECT Numennemy FROM projetf.recup_table_mob WHERE numPartie = :numPartie;";
    $query = $this->bdd->prepare($sql);
    $query->execute(array(":numPartie" => $numpartie));
    $table = $query->fetchALL(PDO::FETCH_ASSOC);

    $Num = random_int(1, count($table));
    // recupére les donnée d'un ennemie
    $sql = "SELECT ID_ennemy, ennemy_nom, vie, attaque, dexterite, defence, vitesse FROM projetf.ennemy WHERE ID_ennemy = :numE;";
    $query = $this->bdd->prepare($sql);
    $query->execute(array(":numE" => $table[$Num - 1]['Numennemy']));
    $datamob = $query->fetch(PDO::FETCH_ASSOC);

    $sql = "INSERT INTO projetf.saveennemy (ennemy_ID, partie_ID, vie, attaque, dexterite, defence, vitesse) 
    VALUES (:IDennemy, :IDpartie, :vie, :attaque, :dexterite, :defence, :vitesse)
    ON DUPLICATE KEY UPDATE 
    vie = VALUES(vie), attaque = VALUES(attaque), dexterite = VALUES(dexterite), defence = VALUES(defence), vitesse = VALUES(vitesse)";
    $query = $this->bdd->prepare($sql);
    $query->execute(array(
      ":IDennemy" => $datamob['ID_ennemy'],
      ":IDpartie" => $numpartie,
      ":vie" => $datamob['vie'],
      ":attaque" => $datamob['attaque'],
      ":dexterite" => $datamob['dexterite'],
      ":defence" => $datamob['defence'],
      ":vitesse" => $datamob['vitesse']
    ));


    $data = $this->recup_combat($numpartie);
    return $data;
  }







  public function GenerationPartie($dataclass, $numclient)
  {
    $sql = "INSERT INTO projetf.partie (perso_lvl, exp, perso_attaque, dexterite, perso_vitesse, perso_vie_max, perso_vie_actuelle, perso_def, user_ID, class_ID) 
    VALUES (:lvl, :exp, :attaque, :dexterite, :vitesse, :viemax, :vie, :def, :user, :classid)";
    $query = $this->bdd->prepare($sql);
    $query->execute(array(
      ":lvl" => 0,
      ":exp" => 0,
      ":attaque" => $dataclass['attaque'],
      ":dexterite" => $dataclass['dexterite'],
      ":vitesse" => $dataclass['vitesse'],
      ":viemax" => $dataclass['vie'],
      ":vie" => $dataclass['vie'],
      ":def" => $dataclass['defence'],
      ":user" => $numclient,
      ":classid" => $dataclass['ID_class']
    ));
    $data = $this->donnéepartieActive($numclient);
    return $data;
  }

}
?>