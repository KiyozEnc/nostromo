<?php
if (isset($_GET['action']))
	$action = $_GET['action'];
else
	$action = "voirPanier";

switch ($action)
{
	case 'voirPanier' :// si le panier n'éxiste pas on le crée
	if(!isset($_SESSION['Panier']))
	{
		$_SESSION['Panier'] = new Panier();
	}
	include("views/panier/v_VoirPanier.php"); break;

	case 'ajouterArticle' :// si le panier n'éxiste pas on le crée
	if(!isset($_SESSION['Panier']))
	{
		$_SESSION['Panier'] = new Panier();
	}
	$prod = new Produit($_GET('ref'));
	$_SESSION['Panier']->ajouterProduit($prod);
	;break;

	case 'supprimerProduit' :	;break;

	case 'augmenterProduit' :	;break;

	case 'diminuerProduit' :	;break;

	case 'validerCommande' :	;break;

	default :
	$_SESSION['error'] = "Impossible d'accéder à la page demandé.";
	header("Location:?uc=index");
}
