<?php
if(isset($_GET['action']))
	$action = $_GET['action'];
else
	$action = "voirBoutique";

switch($action)
{
	case 'voirBoutique' :
		$tabArt = MArticle::getArticles();
	include("views/boutique/v_VoirBoutique.php"); break;

	case 'voirArticle':
		$article = MArticle::getArticle($_GET['article']);
	include("views/boutique/v_VoirArticle.php"); break;

	default :
		$_SESSION['error'] = "Impossible d'accéder à la page demandé.";
	header("Location:?uc=index");
}