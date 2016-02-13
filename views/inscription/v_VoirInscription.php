<!-- Alerte valid -->
<?php if (array_key_exists('valid', $_SESSION)) { ?>
    <div class="alert alert-success" role="alert">
        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
        <?= $_SESSION['valid'] ?>
    </div>
<?php } ?>
<?php if (array_key_exists('error', $_SESSION)) { ?>
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        <?= $_SESSION['error'] ?>
    </div>
<?php } ?>
<?php if (array_key_exists('valid', $_SESSION)) {
    unset($_SESSION['valid']);
} ?>
<?php if (array_key_exists('error', $_SESSION)) {
    unset($_SESSION['error']);
} ?>
<form action="?uc=inscription&action=inscrire" method="POST" role="form">
	<legend>Inscription à Nostromo</legend>

	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
			<div class="form-group">
				<label for="nomUser">Nom</label>
				<input type="text" class="form-control" id="nomUser" name="nomUser" placeholder="Nom" required>
			</div>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
			<div class="form-group">
				<label for="prenUser">Prénom</label>
				<input type="text" class="form-control" id="prenUser" name="prenUser" placeholder="Prénom" required>
			</div>
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<div class="form-group">
				<label for="cpUser">Code postal</label>
				<input type="text" class="form-control" id="cpUser" name="cpUser" placeholder="Code postal" required>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
			<div class="form-group">
				<label for="adrUser">Adresse (n° et rue)</label>
				<input type="text" class="form-control" id="adrUser" name="adrUser" placeholder="Adresse (n° et rue)" required>
			</div>
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<div class="form-group">
				<label for="villeUser">Ville</label>
				<input type="text" class="form-control" id="villeUser" name="villeUser" placeholder="Ville" required>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<div class="form-group">
				<label for="mailUser">Adresse e-mail</label>
				<input type="email" class="form-control" id="mailUser" name="mailUser" placeholder="Adresse e-mail" required>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<div class="form-group">
				<label for="mdpUser">Mot de passe</label>
				<input type="password" class="form-control" id="mdpUser" name="mdpUser" placeholder="Mot de passe" required>
			</div>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<div class="form-group">
				<label for="mdpConfUser">Confirmation du mot de passe</label>
				<input type="password" class="form-control" id="mdpConfUser" name="mdpConfUser" placeholder="Confirmation du mot de passe" required>
			</div>
		</div>
	</div>



	<button type="submit" class="btn btn-primary">Valider</button>
	<a class="btn btn-default" href="?uc=connexion" role="button">Déjà inscrit ?</a>
</form>
