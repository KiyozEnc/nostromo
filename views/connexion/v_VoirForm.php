<div class="jumbotron">
	<?php if(isset($_SESSION['error'])) { ?>
	<div class="alert alert-danger" role="alert">
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		<span class="sr-only">Error:</span>
		<?= $_SESSION['error'] ?>
	</div>
	<?php } ?>
	<form action="?uc=connexion&action=seConnecter" method="POST" role="form">
		<legend>Connexion à Nostromo</legend>

		<div class="form-group">
			<label for="">Adresse e-mail</label>
			<input type="email" class="form-control" id="mailUser" name="mailUser" placeholder="Adresse e-mail">
		</div>
		<div class="form-group">
			<label for="">Mot de passe</label>
			<input type="password" class="form-control" id="mdpUser" name="mdpUser" placeholder="Mot de passe">
		</div>



		<button type="submit" class="btn btn-primary">Valider</button>
		<a class="btn btn-default" href="?uc=inscription" role="button">Pas encore inscrit ?</a>
	</form>
</div>
<?php if(isset($_SESSION['error'])) { unset($_SESSION['error']); } ?>
