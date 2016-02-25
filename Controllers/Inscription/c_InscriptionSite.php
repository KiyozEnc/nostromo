<?php

use Nostromo\Models\MConnexion as Connexion;
use Nostromo\Models\MConnexionSite as ConnexionSite;
use Nostromo\Classes\Utilisateur;

$action = array_key_exists('action', $_GET) ? $_GET['action'] : 'voirForm';

switch ($action) {
    case 'voirForm':
        include_once 'Views/Inscription/v_VoirInscription.php';
        break;

    case 'inscrire':
        try {
            if (array_key_exists('mailUser', $_POST)) {
                $unUser = ConnexionSite::getUser($_POST['mailUser']);
                if (null === $_POST['mailUser']
                    || null === $_POST['prenUser']
                    || null === $_POST['nomUser']
                    || null === $_POST['cpUser']
                    || null === $_POST['mdpUser']
                    || null === $_POST['mdpConfUser']
                    || null === $_POST['villeUser']
                    || null === $_POST['adrUser']) {
                    Connexion::setFlashMessage('Veuillez renseignez tous les champs.', 'error');
                    header('Location:?page=inscription');
                } elseif ($_POST['mailUser'] === $unUser->getMail()) {
                    Connexion::setFlashMessage('Cette e-mail est déjà utilisée.', 'error');
                    header('Location:?page=inscription');
                } elseif (strlen($_POST['nomUser']) > 20) {
                    Connexion::setFlashMessage('Le nom entré est trop long', 'error');
                    header('Location:?page=inscription');
                } elseif (strlen($_POST['prenUser']) > 20) {
                    Connexion::setFlashMessage('Le prénom entré est trop long', 'error');
                    header('Location:?page=inscription');
                } elseif (strlen($_POST['cpUser']) !== 5) {
                    Connexion::setFlashMessage('Le code postal entré n\'est pas au bon format (ex: 30000)', 'error');
                    header('Location:?page=inscription');
                } elseif ($_POST['mdpUser'] !== $_POST['mdpConfUser']) {
                    Connexion::setFlashMessage('Les mots de passes ne sont pas identiques', 'error');
                    header('Location:?page=inscription');
                } else {
                    $unUser = new Utilisateur();
                    $unUser
                        ->setNom($_POST['nomUser'])
                        ->setPrenom($_POST['prenUser'])
                        ->setAdresse($_POST['adrUser'])
                        ->setCp($_POST['cpUser'])
                        ->setVille($_POST['villeUser'])
                        ->setMdp(sha1($_POST['mdpUser']))
                        ->setMail($_POST['mailUser'])
                        ->setPoints(10);
                    ConnexionSite::setAjoutUser($unUser);
                    Connexion::setFlashMessage('Inscription réussie, vous pouvez désormais vous connecter.', 'valid');
                    header('Location:?page=index');
                }
            } else {
                header('Location:?page=index');
            }
        } catch (Exception $e) {
            Connexion::setFlashMessage($e->getMessage(), 'error');
            header('Location:?page=inscription');
        }
        break;

    default:
        header('Location:?page=index');
        break;
}
