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


  $requete1 = "SELECT `id_client` FROM `client` INNER JOIN `client_actif` ON `id_client`=`id_client_actif`";
  $resultat1 = $mysqli->query($requete1);
  $val1=$resultat1->fetch_assoc();
  $requete2;
  $message;
  if($val1 == null)
  {
    echo'NewClient : ';
    $requete2 = "INSERT INTO `client`
          (`id_client`, `nom`, `prenom`, `date_naissance`, `adresse`, `montant_depot`)
          VALUES (DEFAULT,'".$Nom."','".$Prenom."','".$Naissance."','".$Adresse."','".$Depot."')";
          $message= "Un nouveau client été ajouté.";
    echo''.$requete2;
  }else{
    echo'Modif Client: ';
    $requete2="UPDATE `client` SET
          `nom`= '".$Nom."',
          `prenom`='".$Prenom."',
          `date_naissance`='".$Naissance."',
          `adresse`='".$Adresse."',
          `montant_depot`= '".$Depot."'
           WHERE `id_client`= ".$val1['id_client'].";";
           $message = "Mise à jour du client effectuée.";
  }
  echo''.$requete2;
  $mysqli->query($requete2);

  header('Location: http://127.0.0.1:8080/PagesParfumerie/AddModifClient.php');
  exit();

  if(!mysqli_close($mysqli)) {
    echo "Echec lors de la déconnexion à la base de données";
  }


?>
