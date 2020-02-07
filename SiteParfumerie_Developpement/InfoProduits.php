<?php
$mysqli=new mysqli('localhost','root','','bd_parfumerie');
$query='SELECT lm.nom_marque,ty.type_produit,p.nom_article,p.ingredients,p.photo FROM produit p inner join type_produit ty
 on ty.id_type_produit=p.id_type_produit inner join liste_marque lm on lm.id_marque=p.id_marque WHERE p.id_produit='.$_GET['Id'].';';

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
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="category.html">Categorie</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Parfum</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

    <div class="container">
        <div class="row">
            <!-- Image -->
            <div class="col-12 col-lg-6 ">
                <div class="card bg-light mb-3 text-center">
                    <div class="card-body">
                        <a href="" data-toggle="modal" data-target="#productModal">
                          <?php
                              echo'
                                <img class="img-fluid text-center" width="300" height="300" src="'.$product['photo'].'" />
                                  ';
                          ?>
                             <p class="text-center">Zoom</p> 
                        </a>
                        </br>
                        <?php
                            echo'
                            <h2 style="color:#fe7f9c">'.$product['nom_article'].'</h2>
                              ';

                        ?>
                    </div>
                </div>
            </div>


            <div class="col-12 col-lg-6 add_to_cart_block">
                <div class="card bg-light mb-3">
                    <div class="card-body">

                          <table class="table table-borderless ">
                            <?php
                                echo '
                                    <tr>
                                        <th style="color: grey;">Marque</th>
                                        <th class="form-group" style="color: grey;">'.$product['nom_marque'].'</th>
                                    </tr>
                                    <tr>
                                        <th style="color: grey;">Type</th>
                                        <th class="form-group" style="color: grey;">'.$product['type_produit'].'</th>
                                    </tr>
                                    <tr>
                                        <th style="color: grey;">Contenance</th>
                                        <th class="form-group" style="color: grey;">
                                ';
                                  $requeteContenance = "SELECT `contenance`, `unitee` FROM `parfum_volume`
                                                            NATURAL JOIN `article` WHERE `id_produit`=".$_GET['Id'].";";
                                  $resultatCont = $mysqli->query($requeteContenance);
                                  $unitee;
                                  $derniereval=0;
                                  while ($ligne = $resultatCont->fetch_assoc()) {
                                      if($ligne['contenance'] != $derniereval){
                                        echo''.$ligne['contenance'].' - ';
                                        $unitee=$ligne['unitee'];
                                        $derniereval=$ligne['contenance'];
                                      }
                                    }
                                      echo''.$unitee.'
                                        </th>
                                      </tr>
                                      <tr>
                                        <th style="color: grey;">Ingredients</th>
                                        <th class="form-group" style="color: grey;">'.$product['ingredients'].'</th>
                                    </tr>';
                                     ?>
                          </table>
                          <div class="product_rassurance">
                        <ul class="list-inline">
                            <li class="list-inline-item"><i class="fa fa-truck fa-2x"></i><br/>Fast delivery</li>
                            <li class="list-inline-item"><i class="fa fa-credit-card fa-2x"></i><br/>Secure payment</li>
                            <li class="list-inline-item"><i class="fa fa-phone fa-2x"></i><br/>+33 1 22 54 65 60</li>
                        </ul>
                    </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>



    <div class="container mb-4 margBot">
        <div class="class="card bg-light mb-3"">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                    <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center">Boutique</th>
                                <th scope="col" class="text-center">Prix de vente</th>
                                <th scope="col" class="text-center">MAJ prix</th>
                                <th scope="col" class="text-center">Quantite</th>
                                <th scope="col" class="text-center">Offre du marchand</th>
                                <th> </th>
                            </tr>
                        </thead>
                       
                       <tbody>
                          <?php
                          $requete = "SELECT * FROM fournisseur NATURAL JOIN article WHERE id_produit=".$_GET['Id'].";";
                          $resultat = $mysqli->query($requete);
                          while ($ligne = $resultat->fetch_assoc()) {
                            echo'
                            <tr>
                              <td scope="row" class="text-center">'.$ligne['nom_vendeur'].'</td>
                              <td scope="row" class="text-center">'.$ligne['prix_vente'].'</td>
                              <td scope="row" class="text-center">'.$ligne['date_derniere_maj_prix'].'</td>
                              <td scope="row" style="align:center">
                             
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <button type="button" class="quantity-left-minus btn btn-number "  data-type="minus" data-field="">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="input-box text-center"  id="quantity" name="quantity" min="1" max="100" value="1">
                                    <div class="input-group-append">
                                        <button type="button" class="quantity-right-plus btn btn-number" data-type="plus" data-field="">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                           
                              </td>
                              <td scope="row" class="text-center"> <a href="'.$ligne['url'].'">VOIR L\'OFFRE</a></td>
                            </tr>
                            ';
                          }
                          ?>
                      </tbody>
                    </table>
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





    <!-- Modal image -->
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Product title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <?php
                                echo '
                    <img class="img-fluid" src="'.$product['photo'].'" />'?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="//code.jquery.com/jquery-3.2.1.slim.min.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" type="text/javascript"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        //Plus & Minus for Quantity product
        $(document).ready(function () {
            var quantity = 1;

            $('.quantity-right-plus').click(function (e) {
                e.preventDefault();
                var quantity = parseInt($('#quantity').val());
                $('#quantity').val(quantity + 1);
            });

            $('.quantity-left-minus').click(function (e) {
                e.preventDefault();
                var quantity = parseInt($('#quantity').val());
                if (quantity > 1) {
                    $('#quantity').val(quantity - 1);
                }
            });

        });
    
       
    </script>
</body>

</html>
