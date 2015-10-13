<?php
require_once('models/m_Connexion.php');
require_once('models/m_Vols.php');
require_once('classes/produit.classe.php');

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
		if(!isset($_SESSION['Reservation']))
		{
			$prod = new Produit($_GET['vol']);
			$_SESSION['Reservation'] = $prod;
   		 // On crée un produit et on l'ajoute au Reservation
   		 // $prod =

			echo "
			<SCRIPT LANGUAGE='JavaScript' TYPE='text/javascript'>
				alert('Votre produit ".$prod->getRef()." a été ajouté au Reservation');
			</SCRIPT>";
			header("Location:?uc=maReservation");
		}
		break;
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
