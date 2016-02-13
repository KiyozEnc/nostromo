<?php
$action = array_key_exists('action', $_GET) ? $_GET['action'] : 'voirVols';

use Nostromo\Models\MVol;
use Nostromo\Models\MConnexion;
use Nostromo\Classes\Reservation;

switch ($action) {
    case 'voirVols':
        $lesVols = MVol::getVols();
        include_once('views/reserveVol/v_VoirVols.php');
        break;
    case 'reserverVol':
        try {
            if (!MConnexion::sessionOuverte()) {
                throw new LogicException('Vous devez être connecté.');
            }
            $vol = MVol::getUnVol($_GET['vol']);
            $nbPlaceRestante = MVol::getPlaceRestante($vol);
            include_once('views/reserveVol/v_VoirFormulaire.php');
        } catch (LogicException $e) {
            MConnexion::setFlashMessage($e->getMessage(), 'error');
            header('Location:?uc=connexion');
        } catch (Exception $e) {
            MConnexion::setFlashMessage($e->getMessage(), 'error');
            header('Location:?uc=reserver');
        }
        break;
    case 'validReserverVol':
        try {
            if (array_key_exists('vol', $_GET) && array_key_exists('nbPers', $_POST)) {
                if (!array_key_exists('Reservation', $_SESSION)) {
                    $unVol = MVol::getUnVol($_GET['vol']);
                    if ($_POST['nbPers'] < 0 &&
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
                        $numVol = $unVol->getNumVol();
                        header("Location:?uc=reserver&action=reserverVol&vol=$numVol");
                    }
                    if (array_key_exists('Reservation', $_SESSION)) {
                        header('Location:?uc=maReservation');
                    }
                } else {
                    if (!$_SESSION['Reservation']->isValid()) {
                        MConnexion::setFlashMessage(
                            'Vous avez déjà une réservation. Vous pouvez l\'annuler via le bouton ci-dessous.',
                            'error'
                        );
                    } else {
                        MConnexion::setFlashMessage(
                            'Vous avez déjà une réservation.
                            Veuillez contacter Nostromo pour annuler votre réservation.',
                            'error'
                        );
                    }
                    header('Location:?uc=maReservation');
                }
            } else {
                MConnexion::setFlashMessage(
                    'Le vol demandé n\'existe pas.',
                    'error'
                );
                header('Location:?uc=reserver');
            }
        } catch (Exception $e) {
            MConnexion::setFlashMessage($e->getMessage(), 'error');
            header('Location:?reserver');
        }
        break;

    default:
        MConnexion::setFlashMessage('Erreur 404 : page introuvable', 'error');
        header('Location:?uc=index');
        break;
}
