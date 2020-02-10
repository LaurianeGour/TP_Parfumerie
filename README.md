# Pour la base de donnée

- Reflexion sur la base de donnée : Création d'un schéma entité-association
- Poser nos tables et les attributs associées --> cf. fichier .ddd et .png associés
- Implémentation de la BD avec PhpMyAdmin puis exportation en .sql --> cf. fichier .sql

# Bootstrap

	lien de git :   https://github.com/T-PHP/Bootstrap-4-Ecommerce-Theme
	Ouvrir �  l'aide d'un serveur local (wamp / easyPhp)(dossier ~www)

### A faire

| Nom de la page | EquivalenceIHM | S'inspirer de | A Faire |
|:-------------------:|:--------------------:|:---------------:|:---------:|
| Barre de navigation | Diapo1	 | x | Info clients en haut a gauche (nom/prenom en cours + deconnexion client) + Deplacer barre de recherche produit au milieu + Laisser panier + Ajouter connexion / deconnexion concierge| 
| Barre du bas | x | x | A voir les info qu'on veut mettre dedant ( racourrcis pour toutes les pages ou presque ?) |
| InfoProduits.html | Diapo7 | cart.html + product.html | Degager barre grise en haut de page + Information de la table produit dans la 1ere partie (type product.html) cf.Diapo7 + Informations de la table article (relatives au fournisseur -> prix) (type cart.html) cf.Diapo7 |
| RechercheProduit.html | Diapo3 | category.html | Degager barre grise en haut de page + Remplacer la barre de lien (home/category/sub-category) par un champ de recherche de produit par nom + possibilité d'ajouter un produit +  Modifier menu catégorie par les filtres de recherche + Ne pas afficher le prix des articles + Enlever last product + Soit mettre les produits sur plusieurs pages, soit retirer les differentes pages de produits (actuellement non fonctionnel) + Reprendre des exemple (au moins 1 fois) de l'affichage réel d'un produit (cf. Diapo 3 les informations mises en tant que description)|
| Panier.html | Diapo4 | cart.html | Degager barre grise en haut de page + Enlever "in stock" (?) + Rajouter nom fournisseur de chaque article commandé +  Ajouter bouton + et - à coté de la qte d chaque articles +  Rajouter prix utitaire entre quantité et prix total +  En dessous shipping rajouter une ligne Dépot : indiquant le montant du dépot que le client veut utiliser (zone de texte ? Il faudrait aussi indiquer facilement 	au concierge à ce moment le montant de dépot qu'a le client) + | En dessous indiquer le montant de la remise d'un produit (en fonction du montant_vente_remise de la table Article) +  Checkout lient vers page RecapCommande.html |
| ListeClient.html | Diapo2 | category.html | Degager barre grise en haut de page +  Remplacer la barre de lien (home/category/sub-category) par un champ de recherche de client par nom + possibilité d'ajouter un client +  Remplacer l'affichage d'un article par l'affichage d'un client :  nom | prénom \n Date de naissance | adresse \n Bouton vers la page de son profil (connecte le client (?) Sur l'IHM c'est ce  qu'il y avait de marqué, et au pire, si c'est juste pour faire des  modifs, le concierge pourra le deconnecter juste après) |
| InfoClient.html | Diapo6 | contact.html | Degager barre grise en haut de page + lien vers cette page (home / contact) + Info client à gauche ( info perso + adresse de facturation) +  A droite : Au moins afficher la date de chaque commande et le nombre d'article dans chacunes d'elles + lien vers la facture (qui sera une image .png) (-> s'inspirer du zoom de la page product.html) |
| AddModifProduit.html | Diapo10 | contact.html + category.html | Partir sur la base de category.html +  Degager barre grise en haut de page + Degager lien vers cette page (home / category/sub-category) +   A la place de categories : zone pour ajouter / modifier photo de produit +  suppr last product +  Dans la zone de droite faire un formulaire (exemple de champs dans contact.html) +  En dessous, 1 fournisseur doit être renseigner au minimum mais possibilité d'en  ajouter d'autres fournisseurs au besoin -> ajout d'un bouton pour pouvoir   inserer un nouveau fournisseur -> affiche de nouveaux champs de formulaire :  Cf. diapo 10 |
| RecapCommande.html | Diapo5 | category.html | Degager barre grise en haut de page + lien vers cette page (home / category/sub-category) + Degager last product +  Dans categories, indiquer le nom du client qui a fait une commande, et son adresse de facturation +  Dans la partie droite, afficher : pour chaque ligne la date d'une commande passée par le client puis un lien (image? bouton avec le nom du produit en contenu ?) vers chaque produit (/articles) commandés pour cette commande |
|  LstCommandesClient.html	 | Diapo8 | contact.html | J'ai pas d'idée de comment la faire bien, donc comme vous le sentez |
| AddModifClient.html | Diapo9 | contact.html | Degager barre grise en haut de page + lien vers cette page (home / contact) + Degager le bloc avec adresse +  Faire un formulaire pour modifier les info d'un client ou ajouter un nouveau client |

### Travail collaboratif : (Si vous avez d'autres idées hesitez pas)

- Garder le fichier boostrap du github en local sur son pc
- Créer les pages de notre en local sur son PC en utilisant les même fichiers css que ceux du git
- Une fois une page finie la mettre dans le repertoire git (SiteParfumerie_Developpement) pour que tout le monde puisse y accèder
- Prevenir lorsqu'une modif a �t� faite sur le git et sur quel fichier
	
### Repartition des taches : 

	Reste à faire :
		
		- RecapCommandeClient.php



	Ghada :
		- InfoProduits.php -> fait 
		
		- RechercheProduit.php -> reste la recherche/tri
		
		- Panier.php -> en cours


	Lauriane : 
		- BarNav -> fait (modif à prévoir à la fin -> lien vers les autres pages)
		- Barre du bas -> fait (modif à prévoir à la fin -> lien vers les autres pages)
		
		- AddModifClient.php -> fait	
		- ListeClients.php -> fait
		- InfoClient -> fait
	
		- LstCommandeClient.php -> A v�rifier


	Abdou :
	


	Lilian :



	
	
