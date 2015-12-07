<?php
if (isset($_GET['action']))
    $action = $_GET['action'];
else
    $action = "voirPanier";

switch ($action)
{
    case 'voirPanier' :
        include("views/panier/v_VoirPanier.php"); break;
    case 'ajouterArticle' :
        if(!isset($_SESSION['Panier']))
        {
            $_SESSION['Panier'] = new Panier();
        }
        $prod = MArticle::getArticle($_GET['ref']);
        if(($prod->getQteStock() - $_POST['qte']) < 0)
        {
            $_SESSION['error']="Quantitée en stock insuffisante.";
            $ref = $_GET['ref'];
            if($_SESSION['Panier']->getNbProd() == 0)
            {
                unset($_SESSION['Panier']);
            }
            header("Location:?uc=materiel&action=voirArticle&article=$ref");
        }
        else
        {
            $prod->setQte($_POST['qte']);
            $_SESSION['Panier']->ajouterUnProduit($prod, $_POST['qte']);
            header('Location:?uc=materiel');
        }

        ; break;

    case 'supprimerProduit' :
        $_SESSION['Panier']->supprimerUnProduit($_GET['article']);
        if($_SESSION['Panier']->getNbProd() == 0)
        {
            unset($_SESSION['Panier']);
        }
        header('Location:?uc=monPanier');break;

    case 'augmenterProduit' :

        $_SESSION['Panier']->augmenterQuantiteProduit($_GET['article'], 1);
        $prod = MArticle::getArticle($_GET['article']);
        var_dump($prod);
        if(($prod->getQteStock() - $prod->getQte()) < 0)
        {
            $_SESSION['error']="Quantitée en stock insuffisante.";
            $ref=$_GET['article'];
            header("Location:?uc=materiel&action=voirArticle&article=$ref");
        }
        header('Location:?uc=monPanier');
        break;

    case 'diminuerProduit' :
        $_SESSION['Panier']->diminuerQuantiteProduit($_GET['article'], 1);
        if($_SESSION['Panier']->getNbProd() == 0)
        {
            unset($_SESSION['Panier']);
        }
        header('Location:?uc=monPanier');
        break;

    case 'validerCommande' :	;break;


    case 'viderPanier' :
        unset($_SESSION['Panier']);
        include("views/panier/v_VoirPanier.php");
        break;

    default :
        $_SESSION['error'] = "Impossible d'accéder à la page demandé.";
        header("Location:?uc=index");break;
}
