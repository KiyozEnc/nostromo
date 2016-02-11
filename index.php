<?php
require_once('classes/date.classe.php');
require_once('models/m_Connexion.php');
require_once('models/m_Vols.php');
require_once('models/m_Article.php');
require_once('models/m_Commande.php');
require_once('models/m_Commander.php');
require_once('classes/produit.classe.php');
require_once('classes/utilisateur.classe.php');
require_once('classes/reservation.classe.php');
require_once('classes/article.classe.php');
require_once('classes/panier.classe.php');
require_once('classes/collection.classe.php');
require_once('classes/commande.classe.php');
require_once('classes/commander.classe.php');
session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css' rel='stylesheet'>
    <link type='text/css' rel='stylesheet' href='css/main.css'/>
    <link type='text/css' rel='stylesheet' href='css/index.css'>
    <title>Nostromo</title>
</head>

<body class='background'>
<nav class='navbar navbar-default' role='navigation'>
    <div class='navbar-header'>
        <a class='navbar-brand' href='?uc=index'>
            Nostromo
        </a>
        <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-ex1-collapse'>
            <span class='sr-only'>Toggle navigation</span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
        </button>
        <a class='navbar-brand' href='?uc=index'></a>
    </div>
    <div class='collapse navbar-collapse navbar-ex1-collapse'>
        <ul class='nav navbar-nav'>
            <li <?php
            if (array_key_exists('uc', $_GET)) {
                if ($_GET['uc'] === 'index') {
                    echo "class='active'";
                }
            }
            ?>>
                <a href='?uc=index'>
                    <img src='img/home.png' height='20'> Accueil
                </a>
            </li>
            <li <?php
            if (array_key_exists('uc', $_GET)) {
                if ($_GET['uc'] === 'reserver') {
                    echo "class='active'";
                }
            }
            ?>>
                <a href='?uc=reserver'>
                    <img src='img/avion.png' height='20'> Réserver un vol
                </a>
            </li>
            <li <?php
            if (array_key_exists('uc', $_GET)) {
                if ($_GET['uc'] === 'materiel') {
                    echo "class='active'";
                }
            }
            ?>>
                <a href='?uc=materiel'>
                    <img src='img/boutique.png' height='20'> Achats de matériel
                </a>
            </li>
            <li <?php
            if (array_key_exists('uc', $_GET)) {
                if ($_GET['uc'] === 'aPropos') {
                    echo "class='active'";
                }
            }
            ?>>
                <a href='?uc=aPropos'>
                    <img src='img/information.png' height='20'> A propos
                </a>
            </li>
        </ul>
        <?php if (!Connexion::sessionOuverte()) { ?>
            <ul class='nav navbar-nav navbar-right'>
                <li <?php
                if (array_key_exists('uc', $_GET)) {
                    if ($_GET['uc'] === 'connexion') {
                        echo "class='active'";
                    }
                }
                ?>>
                    <a href='?uc=connexion'>Connexion</a></li>
                <li <?php
                if (array_key_exists('uc', $_GET)) {
                    if ($_GET['uc'] === 'inscription') {
                        echo "class='active'";
                    }
                }
                ?>>
                    <a href='?uc=inscription'>Inscription</a></li>
            </ul>
        <?php } else { ?>
            <ul class='nav navbar-nav navbar-right'>
                <li <?php
                if (array_key_exists('uc', $_GET)) {
                    if ($_GET['uc'] === 'maReservation') {
                        echo "class='active'";
                    }
                }
                ?>>
                    <a href='?uc=maReservation'>
                        <img src='img/reservation.png' height='20'> Ma réservation
                    </a>
                </li>
                <li <?php
                if (array_key_exists('uc', $_GET)) {
                    if ($_GET['uc'] === 'monPanier') {
                        echo "class='active'";
                    }
                }
                ?>>
                    <a href='?uc=monPanier'>
                        <img src='img/panier2.png' height='20'> Panier
                    </a>
                </li>
                <li <?php
                if (array_key_exists('uc', $_GET)) {
                    if ($_GET['uc'] === 'monCompte') {
                        echo "class='active'";
                    }
                }
                ?>>
                    <a href='?uc=monCompte'>
                        <img src='img/user.png' height='20'> Mon Compte
                        [<?php echo $_SESSION['Utilisateur']->getPrenom()
                                .' '
                                .$_SESSION['Utilisateur']->getNom() ?>]
                    </a>
                </li>
                <li><a href='?uc=deconnexion'>Déconnexion</a></li>
            </ul>
        <?php } ?>
    </div>
</nav>
<div class='jumbotron'>
    <div class='container'>
        <?php
        if (Connexion::sessionOuverte()) {
            echo "<div class='col-md-9 col-sm-9 col-xs-9 col-lg-9'>";
        }
        if (array_key_exists('uc', $_GET)) {
            switch ($_GET['uc'])
            {
                case 'index' :
                    include('controllers/index/c_Index.php');
                    break;
                case 'reserver' :
                    include('controllers/reserveVol/c_ReserveVol.php');
                    break;
                case 'connexion' :
                    include('controllers/connexion/c_ConnexionSite.php');
                    break;
                case 'inscription' :
                    include('controllers/inscription/c_InscriptionSite.php');
                    break;
                case 'deconnexion' :
                    include('controllers/deconnexion/c_Deconnexion.php');
                    break;
                case 'maReservation' :
                    include('controllers/maReservation/c_MaReservation.php');
                    break;
                case 'monCompte' :
                    include('controllers/compte/c_MonCompte.php');
                    break;
                case 'materiel' :
                    include('controllers/boutique/c_Boutique.php');
                    break;
                case 'monPanier' :
                    include('controllers/panier/c_Panier.php');
                    break;
                case 'aPropos' :
                    include('views/aPropos/v_APropos.php');
                    break;
                default :
                    include('views/index/v_Erreur.php');
                    break;
            }
        } else {
            header('Location:?uc=index');
        } ?>
    </div>
    <?php
    if (Connexion::sessionOuverte()) {
        if (array_key_exists('action', $_GET)) {
            $action = $_GET['action'];
        } else {
            if ($_GET['uc'] === 'maReservation') {
                $action = 'voirReservation';
            }
        } ?>
        <div class='col-md-3 col-xs-3 col-sm-3' id='leftCol'>
            <div class='row'>
                <?php
                if ($action !== 'voirReservation') { ?>
                    <div class='rectangle col-md-12'>
                        <h4 class='text-center'><a href='?uc=maReservation'>Réservation</a></h4>
                        <?php
                        if (array_key_exists('Reservation', $_SESSION)) {
                            echo "<p class='text-justify'> Vol n° "
                                    .$_SESSION['Reservation']->getUnVol()->getNumVol()
                                    .' - '
                                    .$_SESSION['Reservation']->getNbPers()
                                    .'/'
                                    .$_SESSION['Reservation']->getUnVol()->getNbPlace()
                                    .' personnes, pour le '
                                    .$_SESSION['Reservation']->getUnVol()->getDateVol()
                                    .' à '.$_SESSION['Reservation']->getUnVol()->getHeureVol()
                                    .'</p>'
                            ;
                        } else {
                            echo '<p class=\'text-justify\'>Aucune réservation</p>';
                        } ?>
                    </div>
                    <?php
                } ?>
            </div>
            <div class='row'>
                <?php
                if ($action !== 'voirCommandes') { ?>
                    <div class='rectangle col-md-12 col-xs-12'>
                        <h4 class='text-center'>
                            <a href='?uc=monCompte&action=voirCommandes'>Vos dernières commandes</a>
                        </h4>
                        <?php
                        if (array_key_exists('Commandes', $_SESSION)) {
                            foreach ($_SESSION['Commandes']->getCollection() as $commande) {
                                echo 'N°'.$commande->getId().' - le '.$commande->getUnedate();
                                echo '<p class=\'margin\'>';
                                foreach ($commande->getLesArticles()->getCollection() as $article) {
                                    echo 'Article n°: '.$article->getNumArt()
                                            .' - '
                                            .$article->getDesignation()
                                            .' - Quantité : '
                                            .$article->getQte()
                                            .'<br>'
                                    ;
                                }
                                echo '</p>';
                            }
                        } else {
                            echo 'Aucune commande';
                        } ?>
                    </div>
                    <?php
                } ?>
            </div>
        </div>
        <?php
    } ?>
</div>
</body>
<script src='https://code.jquery.com/jquery-2.2.0.min.js' type='text/javascript'></script>
<script
        src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'
        crossorigin='anonymous'>
</script>
<script src='js/main.js' type='text/javascript'></script>
</html>