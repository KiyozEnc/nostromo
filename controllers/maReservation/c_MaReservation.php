<?php

require_once('classes/produit.classe.php');

if (isset($_REQUEST['action']))
	$action = $_REQUEST['action'];
else
	$action = "voirReservation";

switch ($action)
{
	case 'voirReservation' :

       // Si le panier n'existe pas encore, on le crée
	include ('views/maReservation/v_VoirReservation.php');
	break;

	case 'ajouterProduit' :

		 // Si le Reservation n'existe pas encore, on le crée
         //   ....
	if(isset($_SESSION['Reservation']))
	{
		$prod = new Produit($_GET['ref']);
		$_SESSION['Reservation'] = $prod;
   		 // On crée un produit et on l'ajoute au Reservation
   		 // $prod =

		echo "
		<SCRIPT LANGUAGE='JavaScript' TYPE='text/javascript'>
			alert('Votre produit ".$prod->getRef()." a été ajouté au Reservation');
		</SCRIPT>";
		header("Location:?uc=maReservation");
	}
	else
	{
		header("Location:?uc=maReservation");
	}
	break;

	case 'supprimerProduit' :
	if(isset($_SESSION['Reservation']))
	{
		$_SESSION['Reservation']->supprimerUnProduit($_GET['ref']);

		echo "
		<SCRIPT LANGUAGE='JavaScript' TYPE='text/javascript'>
			alert('Votre produit ".$_GET['ref']." a été supprimé du Reservation');
			document.location='index.php?uc=Reservation&action=voirReservation';
		</SCRIPT>";
	}
	else
	{
		header("Location:?uc=maReservation");
	}
	break;

	case 'validerReservation' :
	echo "Bravo";
	break;
}
?>

