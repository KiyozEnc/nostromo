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
            if ($_POST['qte'] <= 0) {
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
                header('Location:?page=materiel&action=voirArticle&article='.$_GET['ref']);
            } else {
                $prod->setQte($_POST['qte']);
                $_SESSION['Panier']->ajouterUnProduit($prod, $_POST['qte']);
                Connexion::setFlashMessage(
                    'Produit ajouté au panier. <a href=\'?page=monPanier\'>Voir mon panier</a>',
                    'valid'
                );
                if (array_key_exists('target', $_GET)) {
                    switch ($_GET['target']) {
                        case 'panier':
                            header('Location:?page=monPanier');
                            break;
                        case 'reserver':
                            header('Location:?page=reserver');
                            break;
                        default:
                            header('Location:?page=materiel');
                            break;
                    }
                } else {
                    header('Location:?page=materiel');
                }
            }
        } catch (Exception $e) {
            Connexion::setFlashMessage($e->getMessage(), 'error');
            header('Location:?page=materiel&action=voirArticle&article='.$_GET['ref']);
        }
        break;

    case 'supprimerProduit':
        $_SESSION['Panier']->supprimerUnProduit($_GET['article']);
        if ($_SESSION['Panier']->getNbProd() === 0) {
            unset($_SESSION['Panier']);
        }
        header('Location:?page=monPanier');
        break;

    case 'augmenterProduit':
        try {
            $_SESSION['Panier']->augmenterQuantiteProduit($_GET['article'], 1);
            $prod = MArticle::getArticle($_GET['article']);
        } catch (Exception $e) {
            Connexion::setFlashMessage($e->getMessage(), 'error');
        }
        header('Location:?page=monPanier');
        break;

    case 'diminuerProduit':
        $_SESSION['Panier']->diminuerQuantiteProduit($_GET['article'], 1);
        if ($_SESSION['Panier']->getNbProd() === 0) {
            unset($_SESSION['Panier']);
        }
        header('Location:?page=monPanier');
        break;

    case 'validerPanier':
        include_once('views/panier/v_ValiderPanier.php');
        break;

    case 'viderPanier':
        unset($_SESSION['Panier']);
        include_once('views/panier/v_VoirPanier.php');
        break;

    case 'choisirQte':
        try {
            if (!array_key_exists('qte', $_GET) && !array_key_exists('article', $_GET) && !array_key_exists('Panier', $_SESSION)) {
                throw new InvalidArgumentException('Invalid args');
            }
            if ($_GET['qte'] === '0') {
                $_SESSION['Panier']->supprimerUnProduit($_GET['article']);
                if ($_SESSION['Panier']->getNbProd() === 0) {
                    unset($_SESSION['Panier']);
                }
            } else {
                $_SESSION['Panier']->setQteProduit($_GET['article'], $_GET['qte']);
            }
            header('Location:?page=monPanier');

        } catch (InvalidArgumentException $e) {
            Connexion::setFlashMessage($e->getMessage(), 'error');
            header('Location:?page=index');
        }
        break;

    default:
        Connexion::setFlashMessage('Impossible d\'accéder à la page demandé.', 'error');
        header('Location:?page=index');
        break;
}
