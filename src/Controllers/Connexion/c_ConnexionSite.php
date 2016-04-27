<?php

use Nostromo\Classes\Exception\NotFoundException;
use Nostromo\Models\MUtilisateur;
use Nostromo\Models\MConnexion as Connexion;
use Nostromo\Models\MReservation;

$action = array_key_exists('action', $_GET) ? $_GET['action'] : 'voirForm';

switch ($action) {
    case 'voirForm':
        require_once ROOT.'src/Views/Connexion/v_VoirForm.php';
        break;
    case 'seConnecter':
        try {
            try {
                if (!array_key_exists('mailUser', $_POST)) {
                    throw new NotFoundException('Cette page n\'existe pas.');
                }
                $unUtilisateur = MUtilisateur::getUser($_POST['mailUser']);
                if ($_POST['mailUser'] !== $unUtilisateur->getMail() &&
                    sha1($_POST['mdpUser']) !== $unUtilisateur->getMdp()
                ) {
                    throw new InvalidArgumentException('E-mail ou mot de passe incorrecte.');
                } else {
                    $_SESSION['Utilisateur'] = $unUtilisateur;
                    $_SESSION['Reservation'] = MReservation::getReservationClient($_SESSION['Utilisateur']);
                    Connexion::setFlashMessage('Connecté avec succès', 'valid');
                    header('Location:?page=index');
                }
            } catch (NotFoundException $e) {
                Connexion::setFlashMessage($e->getMessage(), 'error');
                header('Location:?page=index');
            } catch (\InvalidArgumentException $e) {
                Connexion::setFlashMessage($e->getMessage(), 'error');
                header('Location:?page=connexion');
            }
        } catch (InvalidArgumentException $e) {
            Connexion::setFlashMessage($e->getMessage(), 'error');
            header('Location:?page=connexion');
        } catch (UnexpectedValueException $e) {
            Connexion::setFlashMessage($e->getMessage(), 'error');
            header('Location:?page=connexion');
        }
        break;

    default:
        header('Location:?page=index');
        break;
}
