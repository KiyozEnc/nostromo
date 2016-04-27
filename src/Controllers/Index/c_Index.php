<?php

use Nostromo\Classes\Exception\CollectionException;
use Nostromo\Classes\Exception\ErrorSQLException;
use Nostromo\Models\MConnexion as Connexion;
use Nostromo\Models\MReservation;
use Nostromo\Models\MCommande;

$action = array_key_exists('action', $_GET) ? $_GET['action'] : 'voirIndex';
if ($action === 'voirIndex') {
    try {
        if (array_key_exists('Utilisateur', $_SESSION)) {
            if (!array_key_exists('Reservation', $_SESSION)) {
                $_SESSION['Reservation'] = MReservation::getReservationClient($_SESSION['Utilisateur']);
            }
            if (0 === $_SESSION['Reservation']->getId()) {
                unset($_SESSION['Reservation']);
            }
            if (!array_key_exists('Commandes', $_SESSION)) {
                $_SESSION['Commandes'] = MCommande::getCommandes($_SESSION['Utilisateur'], true);
            }
            if (0 === $_SESSION['Commandes']->taille()) {
                unset($_SESSION['Commandes']);
            }
        }
        require_once ROOT.'src/Views/Index/v_Accueil.php';
    } catch (ErrorSQLException $e) {
        Connexion::setFlashMessage($e->getMessage(), 'error');
        header('Location:?page=error404');
    } catch (CollectionException $e) {
        Connexion::setFlashMessage($e->getMessage());
        header('Location:?page=index');
    }
} else {
    header('Location:?page=index');
}
