<?php
require_once("classes/date.classe.php");
require_once('models/m_Connexion.php');
require_once('models/m_Vols.php');
require_once('classes/produit.classe.php');
session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	<!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
	<link type="text/css" rel="stylesheet" href="/nostromo/css/main.css"/>
	<title>Nostromo</title>
</head>

<body class="fond">
	<?php
	/*$TailleImage = getimagesize("/nostromo/img/logo2.png");
	$largeur=$TailleImage[1];
	$longueur=$TailleImage[0];
	echo $TailleImage;*/
	?>
	<!--<div calss="Titre"><img  src="/nostromo/img/logo2.png" height="<?php echo $largeur ?>" width="<?php echo $longueur ?>"/> NOSTROMO</div>-->
	<nav class="navbar navbar-default" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/nostromo/">Nostromo</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li <?php if(isset($_GET['uc'])) { if($_GET['uc'] == 'index') { ?> class="active" <?php }} ?>><a href="?uc=index">Accueil</a></li>
				<li <?php if(isset($_GET['uc'])) { if($_GET['uc'] == 'reserver') { ?> class="active" <?php }} ?>><a href="?uc=reserver">Réservations de vol</a></li>
				<li <?php if(isset($_GET['uc'])) { if($_GET['uc'] == 'materiel') { ?> class="active" <?php }} ?>><a href="?uc=materiel">Achats de matériel</a></li>
				<li <?php if(isset($_GET['uc'])) { if($_GET['uc'] == 'apropos') { ?> class="active" <?php }} ?>><a href="?uc=apropos">A propos</a></li>
			</ul>
			<?php if(!Connexion::sessionOuverte())
			{ ?>
			<ul class="nav navbar-nav navbar-right">
				<li <?php if(isset($_GET['uc'])) { if($_GET['uc'] == 'connexion') { ?> class="active" <?php }} ?>><a href="?uc=connexion">Connexion</a></li>
				<li <?php if(isset($_GET['uc'])) { if($_GET['uc'] == 'inscription') { ?> class="active" <?php }} ?>><a href="?uc=inscription">Inscription</a></li>
			</ul>
			<?php } else { ?>
			<ul class="nav navbar-nav navbar-right">
				<li <?php if(isset($_GET['uc'])) { if($_GET['uc'] == 'maReservation') { ?> class="active" <?php }} ?>><a href="?uc=maReservation">Ma réservation</a></li>
				<li <?php if(isset($_GET['uc'])) { if($_GET['uc'] == 'voirPanier') { ?> class="active" <?php }} ?>><a href="?uc=voirPanier">Panier</a></li>
				<li <?php if(isset($_GET['uc'])) { if($_GET['uc'] == 'monCompte') { ?> class="active" <?php }} ?>><a href="?uc=monCompte">Mon Compte</a></li>
				<li><a href="?uc=deconnexion">Déconnexion</a></li>
			</ul>
			<?php } ?>
		</div><!-- /.navbar-collapse -->
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
			default : include("views/Index/v_Erreur.php"); break;
		}
		else
		{
			header("Location:?uc=index");
		} ?>
	</div>
</body>
</html>
