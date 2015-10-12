<div class="jumbotron">
	<?php if(isset($_SESSION['error'])) { ?>
	<div class="alert alert-danger" role="alert">
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		<span class="sr-only">Error:</span>
		<?= $_SESSION['error'] ?>
	</div>
	<?php } ?>
	<form action="?uc=inscription&action=inscrire" method="POST" role="form">
		<legend>Inscription à Nostromo</legend>

		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<div class="form-group">
				<label for="nomUser">Nom</label>
				<input type="text" class="form-control" id="nomUser" name="nomUser" placeholder="Nom">
			</div>
		</div>
		<div class="form-group">
			<label for="prenUser">Prénom</label>
			<input type="text" class="form-control" id="prenUser" name="prenUser" placeholder="Prénom">
		</div>
		<div class="form-group">
			<label for="adrUser">Adresse (n° et rue)</label>
			<input type="text" class="form-control" id="adrUser" name="adrUser" placeholder="Adresse (n° et rue)">
		</div>
		<div class="form-group">
			<label for="cpUser">Code postal</label>
			<input type="text" class="form-control" id="cpUser" name="cpUser" placeholder="Code postal">
		</div>
		<div class="form-group">
			<label for="villeUser">Ville</label>
			<input type="text" class="form-control" id="villeUser" name="villeUser" placeholder="Ville">
		</div>
		<div class="form-group">
			<label for="mailUser">Adresse e-mail</label>
			<input type="email" class="form-control" id="mailUser" name="mailUser" placeholder="Adresse e-mail">
		</div>
		<div class="form-group">
			<label for="mdpUser">Mot de passe</label>
			<input type="password" class="form-control" id="mdpUser" name="mdpUser" placeholder="Mot de passe">
		</div>
		<div class="form-group">
			<label for="mdpConfUser">Confirmation mot de passe</label>
			<input type="password" class="form-control" id="mdpConfUser" name="mdpConfUser" placeholder="Confirmation mot de passe">
		</div>



		<button type="submit" class="btn btn-primary">Valider</button>
		<a class="btn btn-default" href="?uc=connexion" role="button">Déjà inscrit ?</a>
	</form>
</div>
<?php if(isset($_SESSION['error'])) { unset($_SESSION['error']); } ?>
