<?php
namespace Nostromo;

use Nostromo\Models\MConnexion;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__.DS);

require_once ROOT.'Autoload.php';

Autoload::register();

session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css' rel='stylesheet'>
    <link type='text/css' rel='stylesheet' href='css/main.css'/>
    <link type='text/css' rel='stylesheet' href='css/index.css'>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Nostromo</title>
</head>

<body class='background'>
<nav class='navbar navbar-default' role='navigation'>
    <div class='navbar-header'>
        <a class='navbar-brand' href='?page=index'>
            Nostromo
        </a>
        <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-ex1-collapse'>
            <span class='sr-only'>Toggle navigation</span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
        </button>
        <a class='navbar-brand' href='?page=index'></a>
    </div>
    <div class='collapse navbar-collapse navbar-ex1-collapse'>
        <ul class='nav navbar-nav'>
            <li <?php
            if (array_key_exists('page', $_GET)) {
                if ($_GET['page'] === 'index') {
                    echo "class='active'";
                }
            }
            ?>>
                <a href='?page=index'>
                    <img src='img/home.png' height='20'> Accueil
                </a>
            </li>
            <li <?php
            if (array_key_exists('page', $_GET)) {
                if ($_GET['page'] === 'reserver') {
                    echo "class='active'";
                }
            }
            ?>>
                <a href='?page=reserver'>
                    <img src='img/avion.png' height='20'> Réserver un vol
                </a>
            </li>
            <li <?php
            if (array_key_exists('page', $_GET)) {
                if ($_GET['page'] === 'materiel') {
                    echo "class='active'";
                }
            }
            ?>>
                <a href='?page=materiel'>
                    <img src='img/boutique.png' height='20'> Achats de matériel
                </a>
            </li>
            <li <?php
            if (array_key_exists('page', $_GET)) {
                if ($_GET['page'] === 'aPropos') {
                    echo "class='active'";
                }
            }
            ?>>
                <a href='?page=aPropos'>
                    <img src='img/information.png' height='20'> A propos
                </a>
            </li>
        </ul>
        <?php
        if (!MConnexion::sessionOuverte()) {
            ?>
            <ul class='nav navbar-nav navbar-right'>
                <li <?php
                if (array_key_exists('page', $_GET)) {
                    if ($_GET['page'] === 'connexion') {
                        echo "class='active'";
                    }
                }
                ?>>
                    <a href='?page=connexion'>Connexion</a></li>
                <li <?php
                if (array_key_exists('page', $_GET)) {
                    if ($_GET['page'] === 'inscription') {
                        echo "class='active'";
                    }
                }
                ?>>
                    <a href='?page=inscription'>Inscription</a></li>
            </ul>
            <?php
        } else {
            ?>
            <ul class='nav navbar-nav navbar-right'>
                <li <?php
                if (array_key_exists('page', $_GET)) {
                    if ($_GET['page'] === 'maReservation') {
                        echo "class='active'";
                    }
                }
                ?>>
                    <a href='?page=maReservation'>
                        <img src='img/reservation.png' height='20'> Ma réservation
                    </a>
                </li>
                <li <?php
                if (array_key_exists('page', $_GET)) {
                    if ($_GET['page'] === 'monPanier') {
                        echo "class='active'";
                    }
                }
                ?>>
                    <a href='?page=monPanier'>
                        <img src='img/panier2.png' height='20'> Panier
                    </a>
                </li>
                <li <?php
                if (array_key_exists('page', $_GET)) {
                    if ($_GET['page'] === 'monCompte') {
                        echo "class='active'";
                    }
                }
                ?>>
                    <a href='?page=monCompte'>
                        <img src='img/user.png' height='20'> Mon Compte
                        [<?php echo $_SESSION['Utilisateur']->getNom() ?>]
                    </a>
                </li>
                <li><a href='?page=deconnexion'>Déconnexion</a></li>
            </ul>
            <?php
        } ?>
    </div>
</nav>
<div class='jumbotron'>
    <div class='container-fluid'>
        <?php
        if (MConnexion::sessionOuverte()) {
            echo "<div class='col-sm-8 col-xs-12 col-lg-9'>";
        }
        if (array_key_exists('page', $_GET)) {
            switch ($_GET['page']) {
                case 'index':
                    include_once ROOT.'controllers/index/c_Index.php';
                    break;
                case 'reserver':
                    include_once ROOT.'controllers/reserveVol/c_ReserveVol.php';
                    break;
                case 'connexion':
                    include_once ROOT.'controllers/connexion/c_ConnexionSite.php';
                    break;
                case 'inscription':
                    include_once ROOT.'controllers/inscription/c_InscriptionSite.php';
                    break;
                case 'deconnexion':
                    include_once ROOT.'controllers/deconnexion/c_Deconnexion.php';
                    break;
                case 'maReservation':
                    include_once ROOT.'controllers/maReservation/c_MaReservation.php';
                    break;
                case 'monCompte':
                    include_once ROOT.'controllers/compte/c_MonCompte.php';
                    break;
                case 'materiel':
                    include_once ROOT.'controllers/boutique/c_Boutique.php';
                    break;
                case 'monPanier':
                    include_once ROOT.'controllers/panier/c_Panier.php';
                    break;
                case 'aPropos':
                    include_once ROOT.'views/aPropos/v_APropos.php';
                    break;
                default:
                    include_once ROOT.'views/index/v_Erreur.php';
                    break;
            }
        } else {
            header('Location:?page=index');
        } ?>
    </div>
    <?php
    if (MConnexion::sessionOuverte()) {
        $action = '';
        if (array_key_exists('action', $_GET)) {
            $action = $_GET['action'];
        }
        if ($_GET['page'] === 'maReservation') {
            $action = 'voirReservation';
        }
        ?>
        <div class='col-lg-3 hidden-xs col-sm-4' id='leftCol'>
            <div class='row'>
                <?php
                if ($action !== 'voirReservation') {
                    ?>
                    <div class='rectangle col-sm-12'>
                        <ul class="list-unstyled">
                            <li>
                                <h4>
                                    <a class="btn btn-link" href='?page=maReservation'>Réservation</a>
                                </h4>
                            </li>
                        </ul>
                        <?php
                        if (array_key_exists('Reservation', $_SESSION)) {
                            echo '<ul class="list-unstyled">
                                        <li>Vol n°'.$_SESSION['Reservation']->getUnVol()->getNumVol().'
                                            le '.$_SESSION['Reservation']->getUnVol()->getDateVol().'
                                            à '.$_SESSION['Reservation']->getUnVol()->getHeureVol().'
                                        </li>
                                        <ul>
                                            <li>Réservé pour '.$_SESSION['Reservation']->getNbPers().' personnes</li>
                                        </ul>
                                      </ul>';
                        } else {
                            echo '<ul class="list-unstyled"><li><h5>Aucune réservation.</h5></li></ul>';
                        }
                        ?>
                    </div>
                    <?php

                }
                ?>
            </div>
            <div class='row'>
                <?php
                if ($action !== 'voirCommandes') {
                    ?>
                    <div class='rectangle col-sm-12'>
                        <ul class="list-unstyled">
                            <li>
                                <h4>
                                    <a class="btn btn-link" href='?page=monCompte&action=voirCommandes'>Vos dernières commandes</a>
                                </h4>
                            </li>
                        </ul>
                        <?php
                        if (array_key_exists('Commandes', $_SESSION)) {
                            foreach ($_SESSION['Commandes']->getCollection() as $commande) {
                                echo '<ul class="list-unstyled"><li><h5>N°'.$commande->getId().' - le '.$commande->getUnedate().'</h5></li>';
                                foreach ($commande->getLesArticles()->getCollection() as $article) {
                                    echo '<ul><li>'.$article->getDesignation().'</li>';
                                    echo '<ul><li>Quantité : '.$article->getQte().'</li></ul></ul>';
                                }
                                echo '</ul>';
                            }
                        } else {
                            echo '<ul class="list-unstyled"><li><h5>Aucune commande.</h5></li></ul>';
                        }
                        ?>
                    </div>
                    <?php

                }
                ?>
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