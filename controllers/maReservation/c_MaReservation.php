<?php
require_once('models/m_Connexion.php');
require_once('classes/produit.classe.php');

if (isset($_REQUEST['action']))
	$action = $_REQUEST['action'];
else
	$action = "voirReservation";

switch ($action)
{
	case 'voirReservation' :
	include ('views/maReservation/v_VoirReservation.php');
	break;

	case 'ajouterProduit' :

	if(isset($_SESSION['Reservation']))
	{
		$_SESSION['Reservation'] = new Produit($_GET['ref']);
		$_SESSION['valid'] = "Réservation effectuée avec succès.";
	}
	header("Location:?uc=maReservation");
	break;

	case 'annulerReservation' :
	if(isset($_SESSION['Reservation']))
	{
		//$_SESSION['Reservation']->setNonValid();
		unset($_SESSION['Reservation']);
		$_SESSION['valid'] = "Réservation annulée avec succès.";
	}
	header("Location:?uc=maReservation");
	break;

	case 'validerReservation' :
	if(isset($_SESSION['Reservation']))
	{
		$_SESSION['valid'] = "Réservation validée avec succès.";
		$_SESSION['Reservation']->setValider();
		$_SESSION['Reservation']->enregistrerValid();
		header("Location:?uc=maReservation");
	}
	else
	{
		header("Location:?uc=maReservation");
	}
	break;
}
?>

