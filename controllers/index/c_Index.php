<?php
/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 25/01/2016
 * Time: 13:44
 */
require_once('models/m_Vols.php');
require_once('models/m_Connexion.php');

$action = array_key_exists('action', $_GET) ? $_GET['action'] : 'voirIndex';
switch ($action)
{
    case 'voirIndex' :
        try
        {
            if (array_key_exists('Utilisateur', $_SESSION)) {
                if (!array_key_exists('Reservation', $_SESSION)) {
                    $_SESSION['Reservation'] = MVol::reservationExistante($_SESSION['Utilisateur']);
                }
                if (null === $_SESSION['Reservation']->getId()) {
                    unset($_SESSION['Reservation']);
                }
                if (!array_key_exists('Commandes', $_SESSION)) {
                    $_SESSION['Commandes'] = MCommande::getCommandes($_SESSION['Utilisateur']);
                }
                if (null === $_SESSION['Commandes']->getCollection()) {
                    unset($_SESSION['Commandes']);
                }
            }
            include_once('views/index/v_Accueil.php');
        }
        catch (Exception $e)
        {
            Connexion::setFlashMessage($e->getMessage(), 'error');
        }
        break;
}