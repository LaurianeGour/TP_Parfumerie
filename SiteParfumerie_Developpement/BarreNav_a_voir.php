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

   
    <a class="navbar-brand" href="index.html">
 <img  style: height="50px" width="50px" src="img/logo.png" />
                </a>
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
         
        </div>
      </div>
      
<div class="dropdown">
  <button onclick="myFunction()" class="dropbtn btn btn-info">espace Concierge <i class="fa fa-caret-down"></i></button>
  <div id="myDropdown" class="dropdown-content">

    <a class="dropdown-item" href="#"><span class="fa fa-user-circle"></span> <font size="1"> passer commande pour client </font></a>
    <a class="dropdown-item disabled" href="#"><span class="fa fa-check-circle"></span> Terminer achats</a>
    <a class="dropdown-item disabled" href="#"><span class="fa fa-history"></span> Voir historique</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="ExeDecoConcierge.php"><span class="fa fa-sign-out"></span> Se déconnecter</a>
  
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
                <li class="interligne-2"><a href="RechercheProduit.php">Rechercher un produit</a></li>
                <li class="interligne-2"><a href="ListeClients.php">Liste Clients</a></li>
                <li class="interligne-2"><a href="ListeCommandeClient.php?Id=8">Liste des commandes d'un client</a></li>
                <li class="interligne-2"><a href="InfoProduits.php?Id=2">Information produit</a></li>
                <li class="interligne-2"><a href="InfoClient.php?Id=8">Information d'un client</a></li>
                <li class="interligne-2"><a href="AddModifClient.php">Ajouter ou modifier un client</a></li>
                <li class="interligne-2"><a href="RecapCommande.php">Recapitulatif de commande</a></li>
                <li class="interligne-2"><a href="Panier.php">Panier</a></li>
              </ul>
            </div>
            <div class="justify-content-end">
              <h5>Equipe Projet</h5>
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


  <script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
</body>
</html>
