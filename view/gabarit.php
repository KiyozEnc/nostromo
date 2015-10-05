<!DOCTYPE html>
<html>
<head>
	<link href="/nostromo/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="/nostromo/css/main.css"/>
	<title>Nostromo</title>
</head>

<body class="fond">
	<?php
	$TailleImage = getimagesize("/nostromo/img/logo2.png");
	$largeur=$TailleImage[1];
	$longueur=$TailleImage[0];
	echo $TailleImage;
	?>
	<div calss="Titre"><img  src="/nostromo/img/logo2.png" height="<?php echo $largeur ?>" width="<?php echo $longueur ?>"/> NOSTROMO</div>

	<br><br><br>
	<?= $menu ?>
	<?= $contenu ?>
</body>
</html>
