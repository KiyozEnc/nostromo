<?php

use Nostromo\Classes\Panier;
use Nostromo\Models\MArticle;
use Nostromo\Models\MConnexion as Connexion;

$action = array_key_exists('action', $_GET) ? $_GET['action'] : 'voirPanier';

switch ($action) {
    case 'voirPanier':
        include_once('views/panier/v_VoirPanier.php');
        break;
    case 'ajouterArticle':
        try {
            if ($_POST['qte'] === 0) {
                throw new InvalidArgumentException('Veuillez sélectionner une quantité');
            }
            if (!array_key_exists('Panier', $_SESSION)) {
                $_SESSION['Panier'] = new Panier();
            }
            $prod = MArticle::getArticle($_GET['ref']);
            if (($prod->getQteStock() - $_POST['qte']) < 0) {
                Connexion::setFlashMessage('Quantitée en stock insuffisante.', 'error');
                if ($_SESSION['Panier']->getNbProd() === 0) {
                    unset($_SESSION['Panier']);
                }
                header('Location:?uc=materiel&action=voirArticle&article='.$_GET['ref']);
            } else {

                $prod->setQte($_POST['qte']);
                $_SESSION['Panier']->ajouterUnProduit($prod, $_POST['qte']);
                Connexion::setFlashMessage(
                    'Produit ajouté au panier. <a href=\'?uc=monPanier\'>Voir mon panier</a>',
                    'valid'
                );
                header('Location:?uc=materiel');
            }
        } catch (Exception $e) {
            Connexion::setFlashMessage($e->getMessage(), 'error');
            header('Location:?uc=materiel&action=voirArticle&article='.$_GET['ref']);
        }
        break;

    case 'supprimerProduit':
        $_SESSION['Panier']->supprimerUnProduit($_GET['article']);
        if ($_SESSION['Panier']->getNbProd() === 0) {
            unset($_SESSION['Panier']);
        }
        header('Location:?uc=monPanier');
        break;

    case 'augmenterProduit':
        try {
            $_SESSION['Panier']->augmenterQuantiteProduit($_GET['article'], 1);
            $prod = MArticle::getArticle($_GET['article']);
        } catch (Exception $e) {
            Connexion::setFlashMessage($e->getMessage(), 'error');
        }
        header('Location:?uc=monPanier');
        break;

    case 'diminuerProduit':
        $_SESSION['Panier']->diminuerQuantiteProduit($_GET['article'], 1);
        if ($_SESSION['Panier']->getNbProd() === 0) {
            unset($_SESSION['Panier']);
        }
        header('Location:?uc=monPanier');
        break;

    case 'validerPanier':
        include_once('views/panier/v_ValiderPanier.php');
        break;

    case 'viderPanier':
        unset($_SESSION['Panier']);
        include_once('views/panier/v_VoirPanier.php');
        break;

    default:
        Connexion::setFlashMessage('Impossible d\'accéder à la page demandé.', 'error');
        header('Location:?uc=index');
        break;
}
