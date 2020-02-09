<?php
$mysqli=new mysqli('localhost','root','','bd_parfumerie');
$query='SELECT lm.nom_marque,ty.type_produit,p.nom_article,p.ingredients,p.photo FROM produit p inner join type_produit ty
 on ty.id_type_produit=p.id_type_produit inner join liste_marque lm on lm.id_marque=p.id_marque';

$result=$mysqli->query($query);
if($result!=null){
  $product=$result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Site meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Panier</title>
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


<div class="container mb-4">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Product</th>
                            <th scope="col">Available</th>
                            <th scope="col" class="text-center">Quantity</th>
                            <th scope="col" class="text-right">Price</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img src="https://dummyimage.com/50x50/55595c/fff" /> </td>
                            <td>Product Name Dada</td>
                            <td>In stock</td>
                            <td><input class="form-control" type="text" value="1" /></td>
                            <td class="text-right">124,90 €</td>
                            <td class="text-right"><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button> </td>
                        </tr>
                        <tr>
                            <td><img src="https://dummyimage.com/50x50/55595c/fff" /> </td>
                            <td>Product Name Toto</td>
                            <td>In stock</td>
                            <td><input class="form-control" type="text" value="1" /></td>
                            <td class="text-right">33,90 €</td>
                            <td class="text-right"><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button> </td>
                        </tr>
                        <tr>
                            <td><img src="https://dummyimage.com/50x50/55595c/fff" /> </td>
                            <td>Product Name Titi</td>
                            <td>In stock</td>
                            <td><input class="form-control" type="text" value="1" /></td>
                            <td class="text-right">70,00 €</td>
                            <td class="text-right"><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button> </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Sub-Total</td>
                            <td class="text-right">255,90 €</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Shipping</td>
                            <td class="text-right">6,90 €</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td class="text-right"><strong>346,90 €</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                    <button class="btn btn-block btn-light">  <a href="RechercheProduit.php">Continue Shopping</a></button>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <button class="btn btn-lg btn-block btn-success text-uppercase">Checkout</button>
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
