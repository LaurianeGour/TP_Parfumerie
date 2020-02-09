<?php
$mysqli=new mysqli('localhost','root','','bd_parfumerie');
$requete="SELECT * FROM client WHERE id_client=".$_GET['Id'].";";

$result=$mysqli->query($requete);
if($result!=null){
  $user=$result->fetch_assoc();
}

?>


<!DOCTYPE html>
<html lang="fr">

  <head>
    <!-- Site meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Site Parfumerie</title>
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
        <form method="get" action="RechercheProduits.php" class="collapse navbar-collapse justify-content-center widthSearch">
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
                  echo''.$val['nbArticles'];
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


    <div class="container margBot">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header bg-primary text-white">
              <div class="row ">
                <div class="col justify-content-center">
                  <i class="fa fa-user"></i>
                  <label class="espace" >Informations Personnelles</label>
                </div class="col justify-content-center">
                  <?php
                    $url = 'AddModifClient.php?Id='.$_GET['Id'];
                    echo'<a class="btn btn-secondary btn-number espace" href="'.$url.'">';
                   ?>

                    <i class="fa fa-cog" aria-hidden="true">
                      Modifier
                    </i>
                  </a>
                  <a class="btn btn-secondary btn-number" href="ExeConnectionClient.php">
                    <i class="fa fa-sign-in" aria-hidden="true">
                      Commander pour le client
                    </i>
                  </a>
              </div>
            </div>
            <div class="card-body">
              <?php
              echo'
                <p>Nom : '.utf8_encode ($user['nom']).'</p>
                <p>Prénom : '.utf8_encode ($user['prenom']).'</p>
                <p>Date de naissance : '.utf8_encode ($user['date_naissance']).'</p>
                <p>Adresse : '.utf8_encode ($user['adresse']).'</p>
                <p>Montant dépot : '.utf8_encode ($user['montant_depot']).'</p>
              ';
              ?>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-4">
          <div class="card bg-light mb-3">
            <div class="card-header bg-success text-white">
              <i class="fa fa-tags"></i> Liste des commandes passées
            </div>
            <div class="card-body">
            <?php
            $requeteCommandePassee = "SELECT COUNT(id_article) AS nbArticles, date_heure FROM `commande` NATURAL JOIN `articles_commandes` WHERE (etat_commande=3 OR etat_commande=4) AND id_client=".$_GET['Id']." GROUP BY(id_commande)";
            $resultatCommandePassee = $mysqli->query($requeteCommandePassee);
            if(!empty($CommandePassee=$resultatCommandePassee->fetch_assoc())){
              echo"
              <table class='table table-striped'>
                  <thead>
                      <tr>
                          <th scope='col' class='text-center'>Date</th>
                          <th scope='col' class='text-center'>Nombre d'articles</th>
                          <th scope='col' class='text-center'>Facture</th>
                      </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class='text-center'>".$CommandePassee['date_heure']."</td>
                      <td class='text-center'>".$CommandePassee['nbArticles']."</td>
                      <td>
                        <button type='button' data-toggle='modal' data-target='#infos' class='btn btn-secondary'>
                          <i class='fa fa-barcode'></i>
                        </button>
                      </td>
                    </tr>
              ";
              while ($CommandePassee = $resultatCommandePassee->fetch_assoc()) {
                      echo'
                      <tr>
                        <td class="text-center">'.$CommandePassee['date_heure'].'</td>
                        <td class="text-center">'.$CommandePassee['nbArticles'].'</td>
                        <td>
                          <button type="button" data-toggle="modal" data-target="#infos" class="btn btn-secondary">
                            <i class="fa fa-barcode"></i>
                          </button>
                        </td>
                      </tr>
                      ';
              }
                echo'
                </tbody>
              </table>';
            }else{
              echo"<p>Aucune commande n'a été passé par le client pour le moment</p>";
            }
            ?>



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
              <li class="interligne-2"><a href="RechercheProduits.php">Rechercher un produit</a></li>
              <li class="interligne-2"><a href="ListeClients.php">Liste Clients</a></li>
              <li class="interligne-2"><a href="">Liste des commandes d'un client</a></li>
              <li class="interligne-2"><a href="InfoProduits.php">Information produit</a></li>
              <li class="interligne-2"><a href="">Information d'un client</a></li>
              <li class="interligne-2"><a href="AddModifClient.php">Ajouter ou modifier un client</a></li>
              <li class="interligne-2"><a href="">Recapitulatif de commande</a></li>
              <li class="interligne-2"><a href="">Panier</a></li>
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


    <div class="modal" id="infos">
      <div class="modal-dialog">
        <div class="modal-content">
          <img src="img/Facture1.jpg" alt="Facture">
        </div>
      </div>
    </div>

  </body>
</html>
