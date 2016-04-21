<?php

use Nostromo\Classes\Exception\NotConnectedException;
use Nostromo\Models\MArticle;
use Nostromo\Models\MConnexion as Connexion;

$action = array_key_exists('action', $_GET) ? $_GET['action'] : 'voirBoutique';
switch ($action) {
    case 'voirBoutique':
        try {
            $tabArt = MArticle::getArticles();
            require_once ROOT.'src/Views/Boutique/v_VoirBoutique.php';
        } catch (InvalidArgumentException $e) {
            Connexion::setFlashMessage($e->getMessage(), 'error');
            header('Location:?page=error404');
        }
        break;

    case 'voirArticle':
        try {
            if (!array_key_exists('Utilisateur', $_SESSION)) {
                throw new NotConnectedException();
            }
        } catch (NotConnectedException $e) {
            Connexion::setFlashMessage($e->getMessage());
            header('?page=connexion');
            echo "<script>window.location.replace('?page=connexion')</script>";
            exit();
        }
        $article = MArticle::getArticle($_GET['article']);
        require_once ROOT.'src/Views/Boutique/v_VoirArticle.php';
        break;

    default:
        $_SESSION['error'] = "Impossible d'accéder à la page demandé.";
        header('Location:?page=index');
}
