# Pour la base de donn�e

- Reflexion sur la base de donn�e : Cr�ation d'un sch�ma entit�-association
- Poser nos tables et les attributs associ�es --> cf. fichier .ddd et .png associ�s
- Impl�mentation de la BD avec PhpMyAdmin puis exportation en .sql --> cf. fichier .sql

# Bootstrap

	lien de git :   https://github.com/T-PHP/Bootstrap-4-Ecommerce-Theme
	Ouvrir �  l'aide d'un serveur local (wamp / easyPhp)(dossier ~www)

### A faire

| Nom de la page | EquivalenceIHM | S'inspirer de | A Faire |
|:-------------------:|:--------------------:|:---------------:|:---------:|
| Barre de navigation | Diapo1	 | x | Info clients en haut a gauche (nom/prenom en cours + deconnexion client) + Deplacer barre de recherche produit au milieu + Laisser panier + Ajouter connexion / deconnexion concierge| 
| Barre du bas | x | x | A voir les info qu'on veut mettre dedant ( racourrcis pour toutes les pages ou presque ?) |
| InfoProduits.html | Diapo7 | cart.html + product.html | Degager barre grise en haut de page + Information de la table produit dans la 1ere partie (type product.html) cf.Diapo7 + Informations de la table article (relatives au fournisseur -> prix) (type cart.html) cf.Diapo7 |
| RechercheProduit.html | Diapo3 | category.html | Degager barre grise en haut de page + Remplacer la barre de lien (home/category/sub-category) par un champ de recherche de produit par nom + possibilit� d'ajouter un produit +  Modifier menu cat�gorie par les filtres de recherche + Ne pas afficher le prix des articles + Enlever last product + Soit mettre les produits sur plusieurs pages, soit retirer les differentes pages de produits (actuellement non fonctionnel) + Reprendre des exemple (au moins 1 fois) de l'affichage r�el d'un produit (cf. Diapo 3 les informations mises en tant que description)|
| Panier.html | Diapo4 | cart.html | Degager barre grise en haut de page + Enlever "in stock" (?) + Rajouter nom fournisseur de chaque article command� +  Ajouter bouton + et - � cot� de la qte d chaque articles +  Rajouter prix utitaire entre quantit� et prix total +  En dessous shipping rajouter une ligne D�pot : indiquant le montant du d�pot que le client veut utiliser (zone de texte ? Il faudrait aussi indiquer facilement 	au concierge � ce moment le montant de d�pot qu'a le client) + | En dessous indiquer le montant de la remise d'un produit (en fonction du montant_vente_remise de la table Article) +  Checkout lient vers page RecapCommande.html |
| ListeClient.html | Diapo2 | category.html | Degager barre grise en haut de page +  Remplacer la barre de lien (home/category/sub-category) par un champ de recherche de client par nom + possibilit� d'ajouter un client +  Remplacer l'affichage d'un article par l'affichage d'un client :  nom | pr�nom \n Date de naissance | adresse \n Bouton vers la page de son profil (connecte le client (?) Sur l'IHM c'est ce  qu'il y avait de marqu�, et au pire, si c'est juste pour faire des  modifs, le concierge pourra le deconnecter juste apr�s) |
| InfoClient.html | Diapo6 | contact.html | Degager barre grise en haut de page + lien vers cette page (home / contact) + Info client � gauche ( info perso + adresse de facturation) +  A droite : Au moins afficher la date de chaque commande et le nombre d'article dans chacunes d'elles + lien vers la facture (qui sera une image .png) (-> s'inspirer du zoom de la page product.html) |
| AddModifProduit.html | Diapo10 | contact.html + category.html | Partir sur la base de category.html +  Degager barre grise en haut de page + Degager lien vers cette page (home / category/sub-category) +   A la place de categories : zone pour ajouter / modifier photo de produit +  suppr last product +  Dans la zone de droite faire un formulaire (exemple de champs dans contact.html) +  En dessous, 1 fournisseur doit �tre renseigner au minimum mais possibilit� d'en  ajouter d'autres fournisseurs au besoin -> ajout d'un bouton pour pouvoir   inserer un nouveau fournisseur -> affiche de nouveaux champs de formulaire :  Cf. diapo 10 |
| RecapCommande.html | Diapo5 | category.html | Degager barre grise en haut de page + lien vers cette page (home / category/sub-category) + Degager last product +  Dans categories, indiquer le nom du client qui a fait une commande, et son adresse de facturation +  Dans la partie droite, afficher : pour chaque ligne la date d'une commande pass�e par le client puis un lien (image? bouton avec le nom du produit en contenu ?) vers chaque produit (/articles) command�s pour cette commande |
|  LstCommandesClient.html	 | Diapo8 | contact.html | J'ai pas d'id�e de comment la faire bien, donc comme vous le sentez |
| AddModifClient.html | Diapo9 | contact.html | Degager barre grise en haut de page + lien vers cette page (home / contact) + Degager le bloc avec adresse +  Faire un formulaire pour modifier les info d'un client ou ajouter un nouveau client |

### Travail collaboratif : (Si vous avez d'autres id�es hesitez pas)

- Garder le fichier boostrap du github en local sur son pc
- Cr�er les pages de notre en local sur son PC en utilisant les m�me fichiers css que ceux du git
- Une fois une page finie la mettre dans le repertoire git (SiteParfumerie_Developpement) pour que tout le monde puisse y acc�der
- Prevenir lorsqu'une modif a �t� faite sur le git et sur quel fichier
	
### Repartition des taches : 

	Reste � faire :
		- Panier.php
		- RecapCommandeClient.php
		- LseCommandeClient.php



	Ghada :
		- InfoProduits.php -> fait (?)
		
		- RechercheProduit.php -> en cours



	Lauriane : 
		- BarNav -> fait (modif � pr�voir � la fin -> lien vers les autres pages)
		- Barre du bas -> fait (modif � pr�voir � la fin -> lien vers les autres pages)
		
		- AddModifClient.php -> fait	
		- ListeClients.php -> fait
		- InfoClient -> fait
	
		- LseCommandeClient.php -> en cours


	Abdou :
	


	Lilian :



	
	