<?php
  $mysqli = new mysqli("localhost", "root", "", "bd_parfumerie");
  if($mysqli->connect_errno) {
    echo "Echec lors de la connexion à la base de données : (" . $mysqli->connect_errno . ")" . $mysqli->connect_error;
  }
  mysqli_set_charset($mysqli, 'utf8');
  date_default_timezone_set('Europe/Paris');


  $qte = $_POST["quantity"];


  $requete1 = "SELECT id_commande, id_client FROM commande NATURAL JOIN articles_commandes INNER JOIN client_actif ON id_client = id_client_actif WHERE etat_commande= 'Current being processed'";
  $resultat1 = $mysqli->query($requete1);
  $val1=$resultat1->fetch_assoc();
  $id_com;
  if($val1 == null)
  {

    $requete2 = "INSERT INTO `commande`(`id_commande`, `id_concierge`, `date_heure`, `montant_total`, `montant_depot`, `montant_livraison`, `etat_commande`)
               VALUES (DEFAULT,1,'11/02/2020 - 12h15',0,0,0,'Current being processed')";
    $resultat2 = $mysqli->query($requete2);
    $val2=$resultat2->fetch_assoc();
    $id_com = $val2['id_commande'];
  }else{
    $id_com=$val1['id_commande'];
  }

  $reqArt = "SELECT * FROM article WHERE id_article = ".$_GET['Art'];
  $resultArt = $mysqli->query($reqArt);
  $valArt=$resultArt->fetch_assoc();

  $reqVerifArt = 'SELECT * FROM articles_commandes NATURAL JOIN commande INNER JOIN client_actif ON id_client = id_client_actif WHERE id_article = '.$_GET['Art'].' AND id_commande = '.$id_com;
  $resultVeArt = $mysqli->query($reqVerifArt);
  $valVeArt=$resultVeArt->fetch_assoc();

  $requete3;
  $val3;
  if($valVeArt == null)
  {
    $requete3= "INSERT INTO articles_commandes (id_client, id_article, id_commande, quantite_commandee, prix_total, remarque)
                    VALUES (".$val1['id_client'].",".$_GET['Art'].",".$id_com.",".$qte.",".$valArt['prix_vente_remise']*$qte.", '')";
  }else{
    $newQte =$valVeArt['quantite_commandee']+ $qte;
    $newPrix = ($valVeArt['prix_total']*$newQte);
    $requete3 ="UPDATE `articles_commandes` SET `quantite_commandee`=".$newQte.",`prix_total`= ".$newPrix ." WHERE id_commande = ".$id_com;
    echo $requete3;
  }
  $resultat3 = $mysqli->query($requete3);


  $requeteFin = "UPDATE `commande` SET `montant_total`= SELECT SUM(prix_total) FROM articles_commande NATURAL JOIN commande WHERE id_commande = ".$id_com;
  $resultatFin = $mysqli->query($requeteFin);



//  header('Location: http://127.0.0.1:8080/Parfumerie/RechercheProduit.php');
//  exit();

  if(!mysqli_close($mysqli)) {
    echo "Echec lors de la déconnexion à la base de données";
  }
?>
