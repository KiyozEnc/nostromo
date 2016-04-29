<?php

use Nostromo\Classes\Exception\ErrorSQLException;
use Nostromo\Classes\Exception\NotConnectedException;
use Nostromo\Models\MConnexion as Connexion;
use Nostromo\Models\MUtilisateur as ConnexionSite;
use Nostromo\Models\MCommande;
use Nostromo\Models\MVol;

$action = array_key_exists('action', $_GET) ? $_GET['action'] : 'voirMonCompte';
try {
    if (!Connexion::sessionOuverte()) {
        throw new NotConnectedException();
    }
} catch (NotConnectedException $e) {
    Connexion::setFlashMessage($e->getMessage());
    header('Location:?page=connexion');
    exit();
}

switch ($action) {
    case 'voirMonCompte':
        try {
            $title = 'Page principale';
            if (!Connexion::sessionOuverte()) {
                throw new NotConnectedException();
            }
            require_once ROOT.'src/Views/Compte/v_GabCompte.php';
            require_once ROOT.'src/Views/Compte/v_VoirProfile.php';
        } catch (NotConnectedException $e) {
            Connexion::setFlashMessage($e->getMessage(), 'error');
            header('Location:?page=connexion');
        }
        break;
    // Partie Kevin C
    case 'edit':
        try {
            if (array_key_exists('actualpwd', $_POST)) {
                if (empty($_POST['pwd']) &&
                    empty($_POST['pwdconf']) &&
                    empty($_POST['name']) &&
                    empty($_POST['firstname']) &&
                    empty($_POST['cp']) &&
                    empty($_POST['city']) &&
                    empty($_POST['address'])) {
                    throw new InvalidArgumentException(
                        'Veuillez remplir au moins un champ à modifier.'
                    );
                }
                if (sha1($_POST['actualpwd']) === $_SESSION['Utilisateur']->getMdp()) {
                    if (!empty($_POST['pwd']) && !empty($_POST['pwdconf'])) {
                        if ($_POST['pwd'] && $_POST['pwdconf']) {
                            $_SESSION['Utilisateur']->setMdp(sha1($_POST['pwd']));
                        } else {
                            throw new InvalidArgumentException(
                                'Les mots de passe ne sont pas identiques.'
                            );
                        }
                    }
                    if (!empty($_POST['name'])) {
                        $_SESSION['Utilisateur']->setNom($_POST['name']);
                    }
                    if (!empty($_POST['firstname'])) {
                        $_SESSION['Utilisateur']->setPrenom($_POST['firstname']);
                    }
                    if (!empty($_POST['cp']) &&
                        !empty($_POST['city']) &&
                        !empty($_POST['address'])) {
                        if (is_numeric($_POST['cp'])) {
                            $_SESSION['Utilisateur']
                                ->setAdresse($_POST['address'])
                                ->setCp($_POST['cp'])
                                ->setVille($_POST['city']);
                        } else {
                            throw new InvalidArgumentException(
                                'Le code postal doit être au format numérique.'
                            );
                        }
                    }
                    if (!empty($_POST['cp']) && !is_numeric($_POST['cp'])) {
                        throw new InvalidArgumentException(
                            'Le code postal doit être au format numérique.'
                        );
                    }
                } else {
                    throw new InvalidArgumentException('Mot de passe incorrect.');
                }
                ConnexionSite::updateUser($_SESSION['Utilisateur']);
                Connexion::setFlashMessage('Données mise à jour avec succès', 'valid');
                header('Location:?page=monCompte&action=edit');
            } else {
                $title = 'Modifier mes informations';
                require_once ROOT.'src/Views/Compte/v_GabCompte.php';
                require_once ROOT.'src/Views/Compte/v_EditProfile.php';
            }
        } catch (InvalidArgumentException $e) {
            Connexion::setFlashMessage($e->getMessage(), 'error');
            header('Location:?page=monCompte&action=edit');
        }
        break;
    // Fin Partie
    case 'voirCommandes':
        try {
            if (array_key_exists('Utilisateur', $_SESSION)) {
                $lesCommandes = MCommande::getCommandes($_SESSION['Utilisateur']);
                if (array_key_exists('cde', $_GET) && !empty($_GET['cde'])) {
                    $uneCommande = MCommande::getUneCommande($_GET['cde']);
                }
                $title = 'Mes commandes';
                require_once ROOT.'src/Views/Compte/v_GabCompte.php';
                require_once ROOT.'src/Views/Compte/v_VoirCommandes.php';
            } else {
                header('Location:?page=connexion');
            }
        } catch (InvalidArgumentException $e) {
            Connexion::setFlashMessage($e->getMessage());
            header('Location:?page=monCompte');
        }
        break;
    case 'getTimer':
        if (array_key_exists('Reservation', $_SESSION)) {
            $monTimer = MVol::getTimer($_SESSION['Reservation']->getUnVol());
            require_once ROOT.'src/Views/Compte/v_Timer.php';
        }
        break;
    default:
        header('Location:?page=compte');
        break;
}
