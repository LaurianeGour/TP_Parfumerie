<?php
  $mysqli = new mysqli("localhost", "root", "", "bd_parfumerie");
  if($mysqli->connect_errno) {
    echo "Echec lors de la connexion à la base de données : (" . $mysqli->connect_errno . ")" . $mysqli->connect_error;
  }
  mysqli_set_charset($mysqli, 'utf8');
  date_default_timezone_set('Europe/Paris');


  $Nom = $_POST["Lname"];
  $Prenom = $_POST["Fname"];
  $Adresse = $_POST["Address"];
  $Naissance = $_POST["Birth"];
  $Depot;
  if (empty($_POST["Depot"])){
    $Depot = 0.0;
  }else{
    $Depot = $_POST["Depot"];
  }
  $idClient;
  $requete2;
  if(empty($_GET['Id']))
  {
    $requete2 = "INSERT INTO `client`
          (`id_client`, `nom`, `prenom`, `date_naissance`, `adresse`, `montant_depot`)
          VALUES (DEFAULT,'".$Nom."','".$Prenom."','".$Naissance."','".$Adresse."','".$Depot."')";
    $req= "SELECT MAX(id_client) as id FROM client";
    $result = $mysqli->query($req);
    $val = $result->fetch_assoc();
    $idClient = $val['id'];
  }else{
    $requete1 = "SELECT `id_client` FROM `client` WHERE `id_client`=".$_GET['Id'];
    $resultat1 = $mysqli->query($requete1);
    $val1=$resultat1->fetch_assoc();
    $requete2="UPDATE `client` SET
          `nom`= '".$Nom."',
          `prenom`='".$Prenom."',
          `date_naissance`='".$Naissance."',
          `adresse`='".$Adresse."',
          `montant_depot`= '".$Depot."'
           WHERE `id_client`= ".$val1['id_client'].";";
    $idClient = $_GET['Id'];
  }
  $mysqli->query($requete2);

  header('Location: http://127.0.0.1:8080/Parfumerie/AddModifClient.php?Id='.$idClient.'');
  exit();

  if(!mysqli_close($mysqli)) {
    echo "Echec lors de la déconnexion à la base de données";
  }


?>
