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
    <title>Recherche Produit</title>
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
              Deconnection
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
        <div class="col-12 col-sm-3">
            <div class="card bg-light mb-3">
                <div class="card-header bg-grey "> Trier par: </div> 
                <ul class="list-group category_block">Prix: 
                <input type="number" min="200" max="100" step="1" width="20" id="input-number">

    <input type="number" min="200" max="1000" step="1" id="input-number">
                </ul>
                <ul class="list-group category_block">Marque: 
                <li class="list-group-item">   
                <div>
  <input type="checkbox" id="sephora" name="sephora"
         checked>
  <label for="sephora">Sephora</label></br>
  <input type="checkbox" id="Lancôme" name="Lancôme"
         checked>
  <label for="Lancôme">Lancôme</label></br>
  <input type="checkbox" id="Dior" name="Dior"
         checked>
  <label for="Dior">Dior</label></br>
  <input type="checkbox" id="Armani" name="Armani"
         checked>
  <label for="Armani">Armani</label></br>
  <input type="checkbox" id="Nocibé" name="Nocibé"
         checked>
  <label for="Nocibé">Nocibé</label></br>
</div>

                        </li>


                </ul>
                <ul class="list-group category_block">Famille Olfactive: 
                    <li class="list-group-item">               <div>
  <input type="checkbox" id="aromatique" name="aromatique"
         checked>
  <label for="aromatique">Aromatique</label></br>
    <input type="checkbox" id="Boisé" name="Boisé"
         checked>
  <label for="Boisé">Boisé</label></br>
  <input type="checkbox" id="Floral" name="Floral"
         checked>
  <label for="Floral">Floral</label></br>
  <input type="checkbox" id="Fruité" name="Fruité"
         checked>
  <label for="Fruité">Fruité</label></br>
  <input type="checkbox" id="Chypré" name="Chypré"
         checked>
  <label for="Chypré">Chypré</label></br>
</div>
</li>   
                </ul>
            </div>
          
        </div>
        <div class="col">
        <div class="row">
        <?php
                          $requete = 'SELECT a.id_produit, lm.nom_marque,ty.type_produit,p.nom_article,p.ingredients,p.photo,a.prix_vente, f.nom_vendeur FROM article a inner join fournisseur f on f.id_fournisseur=a.id_fournisseur inner join produit p on a.id_produit=p.id_produit inner join type_produit ty
                          on ty.id_type_produit=p.id_type_produit inner join liste_marque lm on lm.id_marque=p.id_marque ';
     if(!empty($_GET['Name'])){
      $requete=$requete.'WHERE p.nom_article = "'.$_GET['Name'].'"';
}
                          $resultat = $mysqli->query($requete);
                          if($resultat!=NULL){
                          while ($ligne = $resultat->fetch_assoc()) {
                            echo'
           
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <img class="card-img-top" src="'.$ligne["photo"].'" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title"><a href="InfoProduits.php?Id='.$ligne['id_produit'].' " title="View Product">'.$ligne['nom_article'].'</a></h4>
                            <p class="card-text"> By: '.$ligne['nom_vendeur'].' </p>
                            <div class="row">
                                <div class="col">
                                    <p class="btn btn-danger btn-block">'.$ligne['prix_vente'].' &nbsp;$ </p>
                                </div>
                                <div class="col">
                                    <a href="Panier.php " class="btn btn-success btn-block">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';
              }}
              ?>
                <div class="col-12">
                    <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
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
<script>
   var select = document.getElementById('input-select');
for ( var i = 200; i <= 1000; i++ ){
var option = document.createElement("option");
    option.text = i;
    option.value = i;
    select.appendChild(option);
}
var html5Slider = document.getElementById('html5');
noUiSlider.create(html5Slider, {
 start: [ 500, 800 ],
 connect: true,
 range: {
    'min': 200,
    'max': 1000
 }
});

var inputNumber = document.getElementById('input-number');

html5Slider.noUiSlider.on('update', function( values, handle ) {

var value = values[handle];

if ( handle ) {
    inputNumber.value = value;
} else {
    select.value = Math.round(value);
}
});

select.addEventListener('change', function(){
    html5Slider.noUiSlider.set([this.value, null]);
});

inputNumber.addEventListener('change', function(){
    html5Slider.noUiSlider.set([null, this.value]);
});
  </script>
</body>
</html>
