<?php
/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 25/01/2016
 * Time: 13:44
 */
require_once('models/m_Vols.php');
require_once('models/m_Connexion.php');

if(isset($_GET['action']))
    $action = $_GET['action'];
else
    $action = "voirIndex";
switch ($action)
{
    case 'voirIndex' :
        try
        {
            if(isset($_SESSION['Utilisateur']))
            {
                if(!isset($_SESSION['Reservation']))
                {
                    $_SESSION['Reservation'] = MVol::reservationExistante($_SESSION['Utilisateur']);
                }
                if(empty($_SESSION['Reservation']->getId()))
                    unset($_SESSION['Reservation']);
                if(!isset($_SESSION['Commandes']))
                $_SESSION['Commandes'] = MCommande::getCommandes($_SESSION['Utilisateur']);
                if(empty($_SESSION['Commandes']->getCollection()))
                    unset($_SESSION['Commandes']);
            }
            include("views/index/v_Accueil.php");
        }
        catch (Exception $e)
        {
            Connexion::setFlashMessage($e->getMessage(), "error");
        }
        break;
}