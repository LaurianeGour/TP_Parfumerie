<?php
  $mysqli = new mysqli("localhost", "root", "", "bd_parfumerie");
  if($mysqli->connect_errno) {
    echo "Echec lors de la connexion à la base de données : (" . $mysqli->connect_errno . ")" . $mysqli->connect_error;
  }
  mysqli_set_charset($mysqli, 'utf8');
  date_default_timezone_set('Europe/Paris');

  $requete = 'INSERT INTO `client_actif`(`id_client_actif`) VALUES ('.$_GET['Id'].')';
  $mysqli->query($requete);

  header('Location: http://127.0.0.1:8080/Parfumerie/InfoClient.php?Id='.$_GET['Id'].'');
  exit();


  if(!mysqli_close($mysqli)) {
    echo "Echec lors de la déconnexion à la base de données";
  }
?>
