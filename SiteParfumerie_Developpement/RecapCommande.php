<?php
$mysqli=new mysqli('localhost','root','','bd_parfumerie');
$query='SELECT p.nom_article,p.photo,c.montant_livraison ,x.id_article,x.quantite_commandee,x.prix_total FROM articles_commandes x 
INNER JOIN article a on x.id_article = a.id_article 
INNER JOIN produit p on a.id_produit = p.id_produit 
INNER JOIN client_actif ca on x.id_client = ca.id_client_actif
 inner join commande c on x.id_commande=c.id_commande 
 where c.etat_commande="Current being processed"';  

 $result=$mysqli->query($query);
if($result!=null){
$artiicle=$result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Site meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Free Bootstrap 4 Ecommerce Template</title>
    <!-- CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark margBot">
    <div class="container">
      <div class="collapse navbar-collapse justify-content-start">
          <img  style: height="50px" width="50px" src="img/logo.png" class="espace"/>

        <?php
          $requete = "SELECT `nom`, `prenom` FROM `client` INNER JOIN `client_actif` ON `id_client`=`id_client_actif`";
          $resultat = $mysqli->query($requete);
          $val=$resultat->fetch_assoc();
          if($val == null)
          {
            echo'
              <div class="espace front_bar_nav navbar-collapse align-items-center">
                <img class="icon espace" src="IconesSite\user.png">
                  <a class="btn btn-secondary btn-number espace" href="ListeClients.php">
                    <i class="fa fa-sign-in" aria-hidden="true">
                      Voir les clients
                    </i>
                  </a>
              </div>
            ';
          }
          else
          {
            echo'
              <div class="espace">
                <a href="PageClient.php" class="navbar-brand bouton">
                  <img class="icon" src="IconesSite\user.png">
                    '.$val['nom'].' '.$val['prenom'].'
                </a>
                <a class="btn btn-secondary btn-number espace" href="ExeDecoClient.php">
                  <i class="fa fa-sign-out" aria-hidden="true">
                    Changer de client
                  </i>
                </a>
              </div>
            ';
          }
        ?>
      </div>
      <form method="get" action="RechercheProduit.php" class="collapse navbar-collapse justify-content-center widthSearch">
            <div class="input-group input-group-sm">
                <input type="text" id="Name" name="Name" class="form-control" placeholder="Chercher un produit par nom">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-secondary btn-number" >
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
      <div class="collapse navbar-collapse justify-content-end">
          <div class="form-inline my-2 my-lg-0 espace" id="navbarsExampleDefault">
              <a class="btn btn-success btn-sm ml-3" href="Panier.php">
                      <i class="fa fa-shopping-cart"></i> Panier
                      <span class="badge badge-light">
                        <?php
                          $requete = "SELECT COUNT(id_article) AS nbArticles FROM `articles_commandes` NATURAL JOIN `commande` JOIN `client_actif` ON `id_client`=`id_client_actif` WHERE `etat_commande` = 'Current being processed'";
                          $resultat = $mysqli->query($requete);
                          $val=$resultat->fetch_assoc();
                          if($val == null)
                          {
                            echo'
                              0
                            ';
                          }
                          else
                          {
                            echo''.
                              $val['nbArticles'].'
                            ';
                          }
                        ?>
                      </span>
              </a>
          </div>
          <a class="btn btn-secondary btn-number" href="ExeDecoConcierge.php"> <!--Voir si on laisse decoUser ou si on met une autre page -->
            <i class="fa fa-sign-out" aria-hidden="true">
              Déconnexion
            </i>

          </a>
        </div>
      </div>
  </nav>

    <div class="container">
      <div class="collapse navbar-collapse justify-content-start">
        <?php
          $requete = "SELECT `nom`, `prenom` FROM `client` INNER JOIN `client_actif` ON `id_client`=`id_client_actif`";
          $resultat = $mysqli->query($requete);
          $val=$resultat->fetch_assoc();
          if($val == null)
          {
            echo'
              <div class="espace front_bar_nav navbar-collapse align-items-center">
                <img class="icon espace" src="IconesSite\user.png">
                  <a class="btn btn-secondary btn-number espace" href="ListeClient.php">
                    <i class="fa fa-sign-in" aria-hidden="true">
                      Connecter client
                    </i>
                  </a>
              </div>
            ';
          }
          else
          {
            echo'
              <div class="espace">
                <a href="PageClient.php" class="navbar-brand bouton">
                  <img class="icon" src="IconesSite\user.png">
                    '.$val['nom'].' '.$val['prenom'].'
                </a>
                <a class="btn btn-secondary btn-number espace" href="ExeDecoClient.php">
                  <i class="fa fa-sign-out" aria-hidden="true">
                    Deconnecter client
                  </i>
                </a>
              </div>
            ';
          }
        ?>
      </div>
        <form class="collapse navbar-collapse justify-content-center widthSearch">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control" placeholder="Search a product">
                <div class="input-group-append">
                    <button onclick="window.location.href = 'RechercheProduit.php';" type="button" class="btn btn-secondary btn-number" >
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <div class="collapse navbar-collapse justify-content-end">
          <div class="form-inline my-2 my-lg-0 espace" id="navbarsExampleDefault">
              <a class="btn btn-success btn-sm ml-3" href="cart.html">
                      <i class="fa fa-shopping-cart"></i> Panier
                      <span class="badge badge-light">
                        <?php
                          $requete = "SELECT COUNT(id_article) AS nbArticles FROM `articles_commandes` NATURAL JOIN `commande` JOIN `client_actif` ON `id_client`=`id_client_actif` WHERE `etat_commande` = 'Current being processed'";
                          $resultat = $mysqli->query($requete);
                          $val=$resultat->fetch_assoc();
                          if($val == null)
                          {
                            echo'
                              0
                            ';
                          }
                          else
                          {
                            echo''.
                              $val['nbArticles'].'
                            ';
                          }
                        ?>
                      </span>
              </a>
          </div>
          <a class="btn btn-secondary btn-number" href="ExeDecoConcierge.php"> <!--Voir si on laisse decoUser ou si on met une autre page -->
            <i class="fa fa-sign-out" aria-hidden="true">
              Deconnection
            </i>

          </a>
        </div>
      </div>
  </nav>




<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-grey ">Informations de livraison
                </div> 
                <div  class="card-body">
               
                 <p> Nom et prénom: </p>
                
        <?php
          $requete = "SELECT `nom`, `prenom`,`adresse`,`id_client_actif` FROM `client` INNER JOIN `client_actif` ON `id_client`=`id_client_actif`";
          $resultat = $mysqli->query($requete);
          $val=$resultat->fetch_assoc();
          if($val != null)
          {
            echo'
         <p> '.$val['nom'].' '.$val['prenom'].'</p>  
                 <p> Adresse: </p>
                 <p> '.$val['adresse'].'</p> 
                
                 <a href="AddModifClient.php?Id='.$val['id_client_actif'].' " class="btn btn-secondary btn-number" >Modifier Informations </a></div>
                 ';
                }
              ?>
            </div>

        </div>
        <div class="col-12 col-sm-8">
            <div class="card bg-light mb-3">
                <div class="card-header bg-grey "> Description de la commande</div>
                <div class="card-body bg-white">
                <?php
    

    if($result!=null){
  $pt=0 ;
$ml=0;
      while ($article = $result->fetch_assoc()) {
         echo'
         <table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">Photo</th>
      <th scope="col">Nom de l\'article</th>
      <th scope="col">Quantité commandée</th>
      <th scope="col">Prix</th>
    </tr>
  </thead>
  <tbody>
    <tr>
     
      <td> <img src="'.$article["photo"].'" height="70" width="70" /> </td>
      <td>'.$article['nom_article'].'</td>
      <td>'.$article['quantite_commandee'].'</td>
      <td>'.$article['prix_total'].'</td>
    </tr>
   
  </tbody>
</table>
                     ';  $pt=$pt+$article['prix_total'];
                     $ml=$article['montant_livraison'];
               }}
             ?><p> Le prix total à payer :  <?php echo $pt+$ml?> € </p>
                                   <a href="RechercheProduit.php" class="btn btn-secondary btn-number" >Payer </a></div>

                </div>

            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="justify-content-start espaceGrand">
            <h5>Plan du site</h5>
            <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-50">
            <ul class="list-unstyled">
              <li class="interligne-2"><a href="">Liste des clients</a></li>
              <li class="interligne-2"><a href="">Liste Client</a></li>
              <li class="interligne-2"><a href="">Liste des commandes d'un client</a></li>
              <li class="interligne-2"><a href="InfoProduits.php">Information produit</a></li>
              <li class="interligne-2"><a href="">Information client</a></li>
              <li class="interligne-2"><a href="">Ajouter ou modifier un produit</a></li>
              <li class="interligne-2"><a href="AddModifClient.php">Ajouter ou modifier un client</a></li>
              <li class="interligne-2"><a href="">Recapitulatif de commande</a></li>
                    </ul>
        </div>

          <div class="justify-content-end">
          <h5>Contact</h5>
          <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-50">
          <ul class="list-unstyled">
            <li class="interligne-2"><i class="fa fa-user mr-2"></i> AZHARI Abderrhaman</li>
            <li class="interligne-2"><i class="fa fa-user mr-2"></i> DRIDI Ghada</li>
            <li class="interligne-2"><i class="fa fa-user mr-2"></i> GOURAUD Lauriane</li>
            <li class="interligne-2"><i class="fa fa-user mr-2"></i> VALLÉE Lilian</li>
          </ul>
        </div>
        </div>
      </div>
    </footer>


<!-- JS -->
<script src="//code.jquery.com/jquery-3.2.1.slim.min.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" type="text/javascript"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" type="text/javascript"></script>

</body>
</html>
