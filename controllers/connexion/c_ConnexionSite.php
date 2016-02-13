<?php

use Nostromo\Models\MConnexionSite as ConnexionSite;
use Nostromo\Models\MConnexion as Connexion;
use Nostromo\Models\MVol;
use Nostromo\Classes\Utilisateur;

$action = array_key_exists('action', $_GET) ? $_GET['action'] : 'voirForm';

switch ($action) {
    case 'voirForm':
        include_once('views/connexion/v_VoirForm.php');
        break;
    case 'seConnecter':
        try {
            if (array_key_exists('mailUser', $_POST)) {
                $unUtilisateur = ConnexionSite::getUser($_POST['mailUser']);
                if ($_POST['mailUser'] === $unUtilisateur->getMail()
                    && sha1($_POST['mdpUser']) === $unUtilisateur->getMdp()
                ) {
                    $_SESSION['Utilisateur'] = new Utilisateur();
                    $_SESSION['Utilisateur'] = $unUtilisateur;
                    $_SESSION['Reservation'] = MVol::reservationExistante($_SESSION['Utilisateur']);
                    if (null === $_SESSION['Reservation']->getId()) {
                        unset($_SESSION['Reservation']);
                    }
                    Connexion::setFlashMessage('Connecté avec succès', 'valid');
                    header('Location:?uc=index');
                } else {
                    Connexion::setFlashMessage(
                        'E-mail ou mot de passe incorrecte',
                        'error'
                    );
                    header('Location:?uc=connexion');
                }
            } else {
                Connexion::setFlashMessage(
                    'Erreur 404 : Page introuvable',
                    'error'
                );
                header('Location:?uc=index');
            }
        } catch (InvalidArgumentException $e) {
            Connexion::setFlashMessage($e->getMessage(), 'error');
            header('Location:?uc=connexion');
        } catch (UnexpectedValueException $e) {
            Connexion::setFlashMessage($e->getMessage(), 'error');
            header('Location:?uc=connexion');
        }
        break;

    default:
        header('Location:?uc=index');
        break;
}
