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

	$tabVols = Vol::getVols();
	include("views/reserveVol/v_VoirVols.php"); break;
	case 'ajoutVol' :
	$d = 'd';break;
	default : header("Location:?uc=index");
}
