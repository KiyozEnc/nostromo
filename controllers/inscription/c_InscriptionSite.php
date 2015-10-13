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
	include("views/inscription/v_VoirInscription.php"); break;

	case 'inscrire' :
	if(isset($_POST['mailUser']))
	{
		$_SESSION['error'] = "";
		$utilisateur = ConnexionSite::getUser($_POST['mailUser']);
		if($_POST['mailUser'] == $utilisateur['mailClt'])
		{
			$_SESSION['error'] .= 'Cette e-mail est déjà utilisée.';
			header("Location:?uc=inscription");
		}
		elseif(strlen($_POST['nomUser']) > 20)
		{
			$_SESSION['error'] .= 'Le nom entré est trop long';
			header("Location:?uc=inscription");
		}
		elseif(strlen($_POST['prenUser']) > 20)
		{
			$_SESSION['error'] .= 'Le prénom entré est trop long';
			header("Location:?uc=inscription");
		}
		elseif(strlen($_POST['cpUser']) != 5)
		{
			$_SESSION['error'] .= "Le code postal entré n'est pas au bon format (ex: 30000)";
			header("Location:?uc=inscription");
		}
		elseif($_POST['mdpUser'] != $_POST['mdpConfUser'])
		{
			$_SESSION['error'] .= 'Les mots de passes ne sont pas identiques';
			header("Location:?uc=inscription");
		}
		else
		{
			unset($_SESSION['error']);
			$User = array(
				'nom' => $_POST['nomUser'],
				'pren' => $_POST['prenUser'],
				'adr' => $_POST['adrUser'],
				'cp' => $_POST['cpUser'],
				'ville' => $_POST['villeUser'],
				'mdp' => $_POST['mdpUser'],
				'mail' => $_POST['mailUser']);
			ConnexionSite::setAjoutUser($User['nom'],$User['pren'],$User['adr'],$User['cp'],$User['ville'],$User['mdp'],$User['mail']);
			$_SESSION['valid'] = "Inscription réussie, vous pouvez désormais vous connecter.";
			header("Location:?uc=index");
		}
	}
	else
	{
		header("Location:?uc=index");
	}
	;break;
	default : header("Location:?uc=index");
}
