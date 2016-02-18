<?php

use Nostromo\Models\MConnexion as Connexion;

$action = array_key_exists('action', $_REQUEST) ? $_REQUEST['action'] : 'voirReservation';

switch ($action) {
    case 'voirReservation':
        include_once ROOT.'views/maReservation/v_VoirReservation.php';
        break;

    case 'annulerReservation':
        if (array_key_exists('Reservation', $_SESSION)) {
            unset($_SESSION['Reservation']);
            $_SESSION['valid'] = 'Réservation annulée avec succès.';
        }
        header('Location:?page=maReservation');
        break;

    case 'validerReservation':
        try {
            if (array_key_exists('Reservation', $_SESSION)) {
                $_SESSION['Reservation']->setValid(true);
                $_SESSION['Reservation']->flushValid();
                $_SESSION['valid'] = 'Réservation validée avec succès.';
            }
            header('Location:?page=maReservation');
        } catch (Exception $e) {
            Connexion::setFlashMessage($e->getMessage(), 'error');
            header('Location:?page=maReservation');
        }
        break;
    case 'payment':
        try {
            if (!array_key_exists('Reservation', $_SESSION)) {
                throw new \LogicException();
            }
            if (array_key_exists('CBNumber', $_POST) && array_key_exists('type', $_GET)) {
                if (empty($_POST['CBNumber'])) {
                    throw new \UnexpectedValueException('Veuillez saisir le numéro de carte.');
                }
                if (!is_numeric($_POST['CBNumber']) || !(strlen($_POST['CBNumber']) === 16)) {
                    throw new \UnexpectedValueException('Le numéro de carte est invalide.');
                }
                if (strlen($_POST['CBSecret']) > 4 || strlen($_POST['CBSecret']) < 3) {
                    throw new \UnexpectedValueException('Le code CVC est incorrecte.');
                }
                $dateNow = new \DateTime();
                $datePost = new \DateTime($_POST['CBYear'].'-'.$_POST['CBMonth'].'-01');
                if ($dateNow > $datePost) {
                    throw new \UnexpectedValueException('Votre carte a expirée.');
                }
                switch ($_GET['type']) {
                    case '3fois':
                        //TODO: Action d'enregistrement lors 3 fois valide
                        break;
                    case 'comptant':
                        break;
                    default:
                        throw new \UnexpectedValueException('Veuillez choisir un mode de paiement.');
                        break;
                }
            } else {
                if (array_key_exists('type', $_GET)) {
                    if (empty($_GET['type'])) {
                        header('Location:?page=maReservation&action=payment');
                    }
                }
                require_once ROOT.'views/maReservation/v_VoirCB.php';
            }
        } catch (\UnexpectedValueException $e) {
            Connexion::setFlashMessage($e->getMessage(), 'error');
            if (array_key_exists('type', $_GET)) {
                $type = $_GET['type'] === 'comptant' ? $_GET['type'] : '3fois';
            }
            header('Location:?page=maReservation&action=payment&type='.$type);
        } catch (\LogicException $e) {
            echo 'Reservation doesn\'t exists';
        }
}
