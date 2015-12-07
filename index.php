<?php
require_once("classes/date.classe.php");
require_once('models/m_Connexion.php');
require_once('models/m_Vols.php');
require_once('models/m_Article.php');
require_once('classes/produit.classe.php');
require_once('classes/article.classe.php');
require_once('classes/panier.classe.php');
require_once('classes/collection.classe.php');
session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="/2014-nostromo/css/main.css"/>
    <title>Nostromo</title>
</head>

<body class="fond">
<nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="?uc=index">Nostromo</a>
    </div>
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li <?php if(isset($_GET['uc'])) { if($_GET['uc'] == 'index') { ?> class="active" <?php }} ?>><a href="?uc=index"><img src="img/home.png" height="20"> Accueil</a></li>
				<li <?php if(isset($_GET['uc'])) { if($_GET['uc'] == 'reserver') { ?> class="active" <?php }} ?>><a href="?uc=reserver"><img src="img/avion.png" height="20"> Réservations de vol</a></li>
				<li <?php if(isset($_GET['uc'])) { if($_GET['uc'] == 'materiel') { ?> class="active" <?php }} ?>><a href="?uc=materiel"><img src="img/boutique.png" height="20"> Achats de matériel</a></li>
				<li <?php if(isset($_GET['uc'])) { if($_GET['uc'] == 'apropos') { ?> class="active" <?php }} ?>><a href="?uc=apropos"><img src="img/information.png" height="20"> A propos</a></li>
			</ul>
			<?php if(!Connexion::sessionOuverte())
			{ ?>
			<ul class="nav navbar-nav navbar-right">
				<li <?php if(isset($_GET['uc'])) { if($_GET['uc'] == 'connexion') { ?> class="active" <?php }} ?>><a href="?uc=connexion">Connexion</a></li>
				<li <?php if(isset($_GET['uc'])) { if($_GET['uc'] == 'inscription') { ?> class="active" <?php }} ?>><a href="?uc=inscription">Inscription</a></li>
			</ul>
			<?php } else { ?>
			<ul class="nav navbar-nav navbar-right">
				<li <?php if(isset($_GET['uc'])) { if($_GET['uc'] == 'maReservation') { ?> class="active" <?php }} ?>><a href="?uc=maReservation"><img src="img/reservation.png" height="20"> Ma réservation</a></li>
				<li <?php if(isset($_GET['uc'])) { if($_GET['uc'] == 'monPanier') { ?> class="active" <?php }} ?>><a href="?uc=monPanier"><img src="img/panier2.png" height="20"> Panier</a></li>
				<li <?php if(isset($_GET['uc'])) { if($_GET['uc'] == 'monCompte') { ?> class="active" <?php }} ?>><a href="?uc=monCompte"><img src="img/user.png" height="20"> Mon Compte</a></li>
				<li><a href="?uc=deconnexion">Déconnexion</a></li>
			</ul>
			<?php } ?>
		</div>
	</nav>
	<div class="container">
		<?php
		if (isset($_GET['uc']))
			switch ($_GET['uc'])
		{
			case 'index' : include("views/index/v_Accueil.php"); break;
			case 'reserver' : include("controllers/reserveVol/c_ReserveVol.php");break;
			case 'connexion' : include("controllers/connexion/c_ConnexionSite.php");break;
			case 'inscription' : include("controllers/inscription/c_InscriptionSite.php");break;
			case 'deconnexion' : include("controllers/deconnexion/c_Deconnexion.php");break;
			case 'maReservation' : include("controllers/maReservation/c_MaReservation.php");break;
			case 'monCompte' : include("controllers/compte/c_MonCompte.php");break;
			case 'materiel' : include("controllers/boutique/c_Boutique.php");break;
			case 'monPanier' :include("controllers/panier/c_Panier.php");break;
			default : include("views/index/v_Erreur.php"); break;
		}
		else
		{
			header("Location:?uc=index");
		} ?>
	</div>
</body>
</html>
