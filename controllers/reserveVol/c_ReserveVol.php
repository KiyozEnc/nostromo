<?php
require_once('models/m_Connexion.php');
require_once('models/m_Vols.php');

if(isset($_GET['action']))
	$action = $_GET['action'];
else
	$action = "voirVols";

switch($action)
{
	case 'voirVols' :

	$tabVols = MVol::getVols();
	include("views/reserveVol/v_VoirVols.php"); break;

	case 'reserverVol' :

	if(isset($_GET['vol']) && !empty($_GET['vol']))
	{

	}
	else
	{
		$_SESSION['error'] = "Le vol demandé n'existe pas.";
		header("Location:?uc=reserver");
	}
	; break;
	default :
	$_SESSION['error'] = "Impossible d'accéder à la page demandé.";
	header("Location:?uc=index");
}
