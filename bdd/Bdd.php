<?php

class Bdd
{
  private $bdd;

  public function __construct()
  {
    require_once 'data.php';
    $dsn = 'mysql:dbname=projetf;host=localhost:3306';
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
    // Vérifier si c'est le premier combat
    $sql_check_first_combat = "SELECT COUNT(*) AS count FROM projetf.saveennemy WHERE partie_ID = :IDpartie";
    $query_check_first_combat = $this->bdd->prepare($sql_check_first_combat);
    $query_check_first_combat->execute(array(":IDpartie" => $numpartie));
    $result = $query_check_first_combat->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] == 0) {
        // Si c'est le premier combat, choisir l'ennemi avec l'ID 1
        $ID_ennemy = 1;
    } else {
        // Sinon, choisir un ennemi aléatoire parmi ceux disponibles, en excluant l'ennemi du tutoriel (ID 1)
        $sql_select_random_ennemy = "SELECT Numennemy FROM projetf.recup_table_mob WHERE numPartie = :numPartie AND Numennemy != 1;";
        $query_select_random_ennemy = $this->bdd->prepare($sql_select_random_ennemy);
        $query_select_random_ennemy->execute(array(":numPartie" => $numpartie));
        $ennemies = $query_select_random_ennemy->fetchAll(PDO::FETCH_ASSOC);
        $random_index = random_int(0, count($ennemies) - 1);
        $ID_ennemy = $ennemies[$random_index]['Numennemy'];
    }

    // Récupérer les données de l'ennemi sélectionné
    $sql_select_ennemy_data = "SELECT ID_ennemy, ennemy_nom, vie, attaque, dexterite, defence, vitesse FROM projetf.ennemy WHERE ID_ennemy = :ID_ennemy;";
    $query_select_ennemy_data = $this->bdd->prepare($sql_select_ennemy_data);
    $query_select_ennemy_data->execute(array(":ID_ennemy" => $ID_ennemy));
    $datamob = $query_select_ennemy_data->fetch(PDO::FETCH_ASSOC);

    // Effectuer la mise à jour ou l'insertion
    $sql_update = "INSERT INTO projetf.saveennemy (ennemy_ID, partie_ID, vie, attaque, dexterite, defence, vitesse) 
                    VALUES (:IDennemy, :IDpartie, :vie, :attaque, :dexterite, :defence, :vitesse)
                    ON DUPLICATE KEY UPDATE 
                        ennemy_ID = VALUES(ennemy_ID),
                        vie = VALUES(vie),
                        attaque = VALUES(attaque),
                        dexterite = VALUES(dexterite),
                        defence = VALUES(defence),
                        vitesse = VALUES(vitesse)";
    $query_update = $this->bdd->prepare($sql_update);
    $query_update->execute(
        array(
            ":IDennemy" => $datamob['ID_ennemy'],
            ":IDpartie" => $numpartie,
            ":vie" => $datamob['vie'],
            ":attaque" => $datamob['attaque'],
            ":dexterite" => $datamob['dexterite'],
            ":defence" => $datamob['defence'],
            ":vitesse" => $datamob['vitesse']
        )
    );

    // Récupérer les données du combat
    $data = $this->recup_combat($numpartie);
    return $data;
}




  public function GenerationPartie($dataclass, $numclient)
  {
    $sql = "INSERT INTO projetf.partie (perso_lvl, exp, perso_attaque, dexterite, perso_vitesse, perso_vie_max, perso_vie_actuelle, perso_def, user_ID, class_ID) 
    VALUES (:lvl, :exp, :attaque, :dexterite, :vitesse, :viemax, :vie, :def, :user, :classid)";
    $query = $this->bdd->prepare($sql);
    $query->execute(
      array(
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
      )
    );
    $data = $this->donnéepartieActive($numclient);
    return $data;
  }

  public function update_vie($numpartie, $vieJoueur, $vieEnnemi)
  {
    // Mettre à jour la vie du joueur dans la table "partie" avec une condition
    if ($vieJoueur <= 0) {
      $requeteJoueur = $this->bdd->prepare('UPDATE partie SET perso_vie_actuelle = :vieJoueur, partie_END = 1 WHERE ID_partie = :idPartie');
    } else {
      $requeteJoueur = $this->bdd->prepare('UPDATE partie SET perso_vie_actuelle = :vieJoueur, exp = exp + 1 WHERE ID_partie = :idPartie');
    }
    $requeteJoueur->execute(array('vieJoueur' => $vieJoueur, 'idPartie' => $numpartie));

    // Mettre à jour la vie de l'ennemi dans la table "statutennemie"
    $requeteEnnemi = $this->bdd->prepare('UPDATE saveennemy SET vie = :vieEnnemi WHERE partie_ID = :idPartie');
    $requeteEnnemi->execute(array('vieEnnemi' => $vieEnnemi, 'idPartie' => $numpartie));
  }


  public function changerBiome($numpartie)
  {
     // Sélectionner une ID de biome aléatoire et son image
     $sql_select = "SELECT ID_biome, Img_biome FROM biome ORDER BY RAND() LIMIT 1";
     $query_select = $this->bdd->prepare($sql_select);
     $query_select->execute();
     $row = $query_select->fetch(PDO::FETCH_ASSOC);
     $ID_biome_obtenu = $row['ID_biome'];
     $img_biome = $row['Img_biome'];
 
     // Mettre à jour l'ID de biome et son image dans la table "partie"
     $sql_update = "UPDATE partie SET biome_ID = :ID_biome WHERE ID_partie = :numPartie";
     $query_update = $this->bdd->prepare($sql_update);
     $query_update->bindParam(':ID_biome', $ID_biome_obtenu, PDO::PARAM_INT);
     $query_update->bindParam(':numPartie', $numpartie, PDO::PARAM_INT);
     $query_update->execute();
 
     return $img_biome; // Retourner l'image de biome associée
  }



  public function getEvenementAleatoire($numpartie)
  {
     // Sélectionner un événement aléatoire et son nom
    $sql_select = "SELECT ID_evente, name_evente FROM evente ORDER BY RAND() LIMIT 1";
    $query_select = $this->bdd->prepare($sql_select);
    $query_select->execute();
    $row = $query_select->fetch(PDO::FETCH_ASSOC);
    $ID_evente_obtenu = $row['ID_evente'];
    $name_evente = $row['name_evente'];

    // Mettre à jour l'ID de l'événement et son nom dans la table "partie"
    $sql_update = "UPDATE partie SET evente_ID = :ID_evente WHERE ID_partie = :numPartie";
    $query_update = $this->bdd->prepare($sql_update);
    $query_update->bindParam(':ID_evente', $ID_evente_obtenu, PDO::PARAM_INT);
    $query_update->bindParam(':numPartie', $numpartie, PDO::PARAM_INT);
    $query_update->execute();

    return $name_evente; // Retourner le nom de l'événement associé
  }


}
?>