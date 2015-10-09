<!DOCTYPE html>
<html>
<head>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
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
	<!--<div calss="Titre"><img  src="/nostromo/img/logo2.png" height="<?php echo $largeur ?>" width="<?php echo $longueur ?>"/> NOSTROMO</div>

	<br><br><br>-->
	<!--<div class="nav-bar"><?= $menu ?></div>-->
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
				<li class="active"><a href="/nostromo/">Accueil</a></li>
				<li><a href="/nostromo/reserveVol">Réservations de vol</a></li>
				<li><a href="/nostromo/achatMateriel">Achats de matériel</a></li>
				<li><a href="/nostromo/aPropos">A propos</a></li>
			</ul>
			<form class="navbar-form navbar-left" role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Rechercher">
				</div>
				<button type="submit" class="btn btn-default">Envoyer</button>
			</form>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">Connexion</a></li>
				<li><a href="#">Inscription</a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</nav>
	<div class="container"><?= $contenu ?></div>
</body>
</html>
