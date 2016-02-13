<?php

use Nostromo\Models\MArticle;
use Nostromo\Models\MConnexion as Connexion;

$action = array_key_exists('action', $_GET) ? $_GET['action'] : 'voirBoutique';
switch ($action) {
    case 'voirBoutique':
        try {
            $tabArt = MArticle::getArticles();
            include_once('views/boutique/v_VoirBoutique.php');
        } catch (InvalidArgumentException $e) {
            Connexion::setFlashMessage($e->getMessage(), 'error');
            header('Location:?uc=error404');
        }
        break;

    case 'voirArticle':
        $article = MArticle::getArticle($_GET['article']);
        include_once('views/boutique/v_VoirArticle.php');
        break;

    default:
        $_SESSION['error'] = "Impossible d'accéder à la page demandé.";
        header('Location:?uc=index');
}
