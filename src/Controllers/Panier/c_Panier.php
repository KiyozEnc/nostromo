<?php

use Nostromo\Classes\Build;
use Nostromo\Classes\Exception\NotConnectedException;
use Nostromo\Classes\Panier;
use Nostromo\Classes\Collection;
use Nostromo\Classes\Commande;
use Nostromo\Classes\Commander;
use Nostromo\Models\MArticle;
use Nostromo\Models\MCommande;
use Nostromo\Models\MCommander;
use Nostromo\Models\MConnexion as Connexion;
use Nostromo\Models\MUtilisateur;

$action = array_key_exists('action', $_GET) ? $_GET['action'] : 'voirPanier';
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
    case 'voirPanier':
        require_once ROOT.'src/Views/Panier/v_VoirPanier.php';
        break;
    case 'enregistrerPanier':
        try {
            if (!array_key_exists('numCarte', $_POST)) {
                throw new \UnexpectedValueException('Les données saisies sont invalides. pas de post');
            }
            if (strlen($_POST['numCarte']) !== 16) {
                throw new \UnexpectedValueException('Les données saisies sont invalides. 16 numéros carte');
            }
            $datePost = new \DateTime($_POST['CBYear'].'-'.$_POST['CBMonth'].'-01');
            if (new \DateTime() > $datePost) {
                throw new \UnexpectedValueException('Votre carte a expirée.');
            }
            $uneCommande = new Commande(Connexion::getLastIdCommande(), $_SESSION['Utilisateur'], date('Y-m-d H:i:s'));
            $lesCommander = new Collection();
            foreach ($_SESSION['Panier']->getProduitsPanier() as $unArticle) {
                $unCommander = new Commander();
                $unCommander->setUnArticle($unArticle);
                $unCommander->setQte($unArticle->getQte());
                $unCommander->setUneCommande($uneCommande);
                $lesCommander->ajouter($unCommander);
            }
            $uneCommande->setLesArticles($lesCommander);
            if ($_SESSION['Panier']->getPointsUtilise() > 0) {
                $uneCommande->setPointsUtilise($_SESSION['Panier']->getPointsUtilise());
            }
            MCommande::ajouterCommande($uneCommande);
            foreach ($uneCommande->getLesArticles()->getCollection() as $unCommander) {
                MCommander::ajouterArticleCommande($unCommander);
                MArticle::updateQteStock($unCommander->getUnArticle(), $unCommander->getQte());
            }
            MUtilisateur::setPoints(
                $_SESSION['Utilisateur'],
                $_SESSION['Utilisateur']->getPoints() +
                Build::getNewPoints(
                    $_SESSION['Panier']->getPrixTotal(),
                    Build::TYPE_COMMANDE
                )
            );
            unset($_SESSION['Panier']);
            header('Location:?page=monCompte&action=voirCommandes');
        } catch (\InvalidArgumentException $e) {
            Connexion::setFlashMessage($e->getMessage());
            header('Location:?page=monPanier');
        } catch (\UnexpectedValueException $e) {
            Connexion::setFlashMessage($e->getMessage());
            header('Location:?page=monPanier&action=validerPanier');
        }
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
                Connexion::setFlashMessage('Quantitée en stock insuffisante.');
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
            Connexion::setFlashMessage($e->getMessage());
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
        try {
            if (array_key_exists('pointsUtilise', $_POST)) {
                if ($_POST['pointsUtilise'] > MUtilisateur::getPoints($_SESSION['Utilisateur'])) {
                    throw new \InvalidArgumentException('Vous n\'avez pas assez de points');
                }
                $_SESSION['Panier']->setPointsUtilise($_POST['pointsUtilise']);
                if (empty($_POST['pointsUtilise'])) {
                    $_SESSION['Panier']->setPointsUtilise(null);
                }
                echo "<script>window.location.replace('?page=monPanier&action=validerPanier')</script>";
            } else {
                require_once ROOT.'src/Views/Panier/v_ValiderPanier.php';
            }
        } catch (\InvalidArgumentException $e) {
            Connexion::setFlashMessage($e->getMessage());
            echo "<script>window.location.replace('?page=monPanier&action=voirPanier')</script>";
        }
        break;

    case 'viderPanier':
        unset($_SESSION['Panier']);
        require_once ROOT.'src/Views/Panier/v_VoirPanier.php';
        break;

    case 'choisirQte':
        try {
            if (!array_key_exists('qte', $_GET) &&
                !array_key_exists('article', $_GET) &&
                !array_key_exists('Panier', $_SESSION)) {
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
