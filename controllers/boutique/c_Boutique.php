<?php
$action = array_key_exists('action', $_GET) ? $_GET['action'] : 'voirBoutique';
switch($action)
{
    case 'voirBoutique' :
        $tabArt = MArticle::getArticles();
        include_once('views/boutique/v_VoirBoutique.php');
        break;

    case 'voirArticle':
        $article = MArticle::getArticle($_GET['article']);
        include_once('views/boutique/v_VoirArticle.php');
        break;

    default :
        $_SESSION['error'] = "Impossible d'accéder à la page demandé.";
        header('Location:?uc=index');
}