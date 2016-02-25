<?php

$action = array_key_exists('action', $_GET) ? $_GET['action'] : 'voirVols';

use Nostromo\Classes\Exception\NotConnectedException;
use Nostromo\Classes\Reservation;
use Nostromo\Models\MConnexion;
use Nostromo\Models\MVol;

switch ($action) {
    case 'voirVols':
        $lesVols = MVol::getVols();
        require_once ROOT.'src/Views/ReserveVol/v_VoirVols.php';
        break;
    case 'reserverVol':
        try {
            if (!MConnexion::sessionOuverte()) {
                throw new NotConnectedException('Vous devez être connecté.');
            }
            $vol = MVol::getUnVol($_GET['vol']);
            $nbPlaceRestante = MVol::getPlaceRestante($vol);
            require_once ROOT.'src/Views/ReserveVol/v_VoirFormulaire.php';
        } catch (NotConnectedException $e) {
            MConnexion::setFlashMessage($e->getMessage(), 'error');
            header('Location:?page=connexion');
        } catch (Exception $e) {
            MConnexion::setFlashMessage($e->getMessage(), 'error');
            header('Location:?page=reserver');
        }
        break;
    case 'validReserverVol':
        try {
            if (array_key_exists('Reservation', $_SESSION) && $_SESSION['Reservation']->isValid()) {
                    throw new InvalidArgumentException('Vous avez déjà une réservation.');
            }
            if (array_key_exists('vol', $_GET) && array_key_exists('nbPers', $_POST)) {
                $unVol = MVol::getUnVol($_GET['vol']);
                if ($_POST['nbPers'] !== 0 ||
                    $_POST['nbPers'] <= MVol::getPlaceRestante($unVol)
                ) {
                    $_SESSION['Reservation'] = new Reservation();
                    $_SESSION['Reservation']
                        ->setNbPers($_POST['nbPers'])
                        ->setValid(false)
                        ->setUnClient($_SESSION['Utilisateur'])
                        ->setUnVol($unVol);
                } else {
                    MConnexion::setFlashMessage(
                        'Il n\'y a plus assez de place pour ce vol, veuillez réduire le nombre de personnes',
                        'error'
                    );
                    if ($_POST['nbPers'] === 0) {
                        MConnexion::setFlashMessage('La valeur ne peut être zéro, veuillez recommencer', 'error');
                    }
                    header('Location:?page=reserver&action=reserverVol&vol='.$unVol->getNumVol());
                }
                if (array_key_exists('Reservation', $_SESSION)) {
                    header('Location:?page=maReservation');
                }
                if ($_SESSION['Reservation']->isValid()) {
                    MConnexion::setFlashMessage(
                        'Vous avez déjà une réservation.
                            Veuillez contacter Nostromo pour annuler votre réservation.',
                        'error'
                    );
                }
                header('Location:?page=maReservation');
            } else {
                MConnexion::setFlashMessage(
                    'Le vol demandé n\'existe pas.',
                    'error'
                );
                header('Location:?page=reserver');
            }
        } catch (InvalidArgumentException $e) {
            MConnexion::setFlashMessage($e->getMessage(), 'error');
            header('Location:?page=maReservation');
        } catch (Exception $e) {
            MConnexion::setFlashMessage($e->getMessage(), 'error');
            header('Location:?reserver');
        }
        break;

    default:
        MConnexion::setFlashMessage('Erreur 404 : page introuvable', 'error');
        header('Location:?page=index');
        break;
}
