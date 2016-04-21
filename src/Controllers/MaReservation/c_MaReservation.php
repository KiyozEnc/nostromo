<?php

use Nostromo\Classes\Exception\NotConnectedException;
use Nostromo\Models\MConnexion as Connexion;
use Nostromo\Models\MReservation;

$action = array_key_exists('action', $_REQUEST) ? $_REQUEST['action'] : 'voirReservation';

try {
    if (!Connexion::sessionOuverte()) {
        throw new NotConnectedException();
    }
} catch (NotConnectedException $e) {
    Connexion::setFlashMessage($e->getMessage());
    header('?page=connexion');
    echo "<script>window.location.replace('?page=connexion')</script>";
    exit();
}

switch ($action) {
    case 'voirReservation':
        require_once ROOT.'src/Views/MaReservation/v_VoirReservation.php';
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
                MReservation::validerReservation($_SESSION['Utilisateur'], $_SESSION['Reservation']->getUnVol(), $_SESSION['Reservation']);
                $_SESSION['valid'] = 'Réservation validée avec succès.';
            }
        } catch (Exception $e) {
            Connexion::setFlashMessage($e->getMessage(), 'error');
        } finally {
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
                $datePost = new \DateTime($_POST['CBYear'].'-'.$_POST['CBMonth'].'-01');
                if (new \DateTime() > $datePost || new \DateTime('+3 months') > $datePost) {
                    throw new \UnexpectedValueException('Votre carte a expirée ou votre carte sera expirée lors de la 3ème échéance.');
                }
                switch ($_GET['type']) {
                    case '3fois':
                        header('Location:?page=maReservation&action=validerReservation&type=3fois');
                        break;
                    case 'comptant':
                        header('Location:?page=maReservation&action=validerReservation&type=comptant');
                        break;
                    default:
                        throw new \UnexpectedValueException('Veuillez choisir un mode de paiement.');
                        break;
                }
            } else {
                if (array_key_exists('type', $_GET) && empty($_GET['type'])) {
                    header('Location:?page=maReservation&action=payment');
                }
                require_once ROOT.'src/Views/MaReservation/v_VoirCB.php';
            }
        } catch (\UnexpectedValueException $e) {
            Connexion::setFlashMessage($e->getMessage(), 'error');
            if (array_key_exists('type', $_GET)) {
                $type = $_GET['type'] === 'comptant' ? $_GET['type'] : '3fois';
            }
            header('Location:?page=maReservation&action=payment&type='.$type);
        } catch (\LogicException $e) {
            $_SESSION['Reservation'] = MReservation::getReservationClient($_SESSION['Utilisateur']);
            header('Location:?page=maReservation&payment');
        } catch (\Nostromo\Classes\Exception\ErrorSQLException $e) {
            Connexion::setFlashMessage($e->getMessage());
            header('Location:?page=maReservation&payment');
        }
}
