<?php
  $mysqli = new mysqli("localhost", "root", "", "bd_parfumerie");
  if($mysqli->connect_errno) {
    echo "Echec lors de la connexion à la base de données : (" . $mysqli->connect_errno . ")" . $mysqli->connect_error;
  }
  mysqli_set_charset($mysqli, 'utf8');
  date_default_timezone_set('Europe/Paris');

  $requete = "DELETE FROM `client_actif`";
  $mysqli->query($requete);

  include("BarreNav.php");


  if(!mysqli_close($mysqli)) {
    echo "Echec lors de la déconnexion à la base de données";
  }
?>
