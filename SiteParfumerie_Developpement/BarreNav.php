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
  <?php
    $mysqli = new mysqli("localhost", "root", "", "bd_parfumerie");
    if($mysqli->connect_errno) {
		    echo "Echec lors de la connexion à la base de données : (" . $mysqli->connect_errno . ")" . $mysqli->connect_error;
		}
    mysqli_set_charset($mysqli, 'utf8');
	  date_default_timezone_set('Europe/Paris');
  ?>

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




  <div>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
  </div>



  <!-- Footer : Lien non fonctionnels-->
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


</body>
</html>
