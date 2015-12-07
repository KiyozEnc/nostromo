<?php
require_once('models/m_Connexion.php');
require_once('models/m_ConnexionSite.php');

if(isset($_GET['action']))
	$action = $_GET['action'];
else
	$action = "voirForm";

switch($action)
{
	case 'voirForm' :
		include("views/connexion/v_VoirForm.php"); break;
	case 'seConnecter' :
		if(isset($_POST['mailUser']))
		{
			$utilisateur = ConnexionSite::getUser($_POST['mailUser']);
			if($_POST['mailUser'] == $utilisateur['mailClt'] && sha1($_POST['mdpUser']) == $utilisateur['mdpClt'])
			{
				$_SESSION['numClt'] = $utilisateur['numClt'];
				$_SESSION['login'] = $utilisateur['nomClt'];
				$_SESSION['mailClient'] = $utilisateur['mailClt'];
				$_SESSION['prenomClient'] = $utilisateur['prenomClt'];
				$_SESSION['pointsClient'] = $utilisateur['pointsClt'];
				$_SESSION['Reservation'] = MVol::reservationExistante($utilisateur['numClt']);
				$_SESSION['Reservation']->setValider();
				if(empty($_SESSION['Reservation']->getRef()))
					unset($_SESSION['Reservation']);
				$_SESSION['valid'] = "Connecté avec succès.";
				header("Location:?uc=index");
			}
			else
			{
				$_SESSION['error'] = 'E-mail ou mot de passe incorrecte';
				header("Location:?uc=connexion");
			}
		}
		else
		{
			$_SESSION['error'] = "Impossible d'accéder à cette page.";
			header("Location:?uc=index");
		}
		;break;
	default : header("Location:?uc=index"); break;
}
