<?php
require_once("models/m_Connexion.php");

?>
<div class="jumbotron">
	<?php if(isset($_SESSION['valid'])) { ?>
	<div class="alert alert-success" role="alert">
		<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
		<?= $_SESSION['valid'] ?>
	</div>
	<?php } ?>
	<?php if(isset($_SESSION['error'])) { ?>
	<div class="alert alert-danger" role="alert">
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		<span class="sr-only">Error:</span>
		<?= $_SESSION['error'] ?>
	</div>
	<?php } ?>
	<?php echo $article->getDesignation(); ?> → Prix unitaire : <?php echo $article->getPu(); ?> €
	<br><br><br>

	<form action="?uc=monPanier&action=ajouterArticle" method="POST" role="form">

		<div class="form-group">
			<label for="">Quantitée voulu</label>
			<input type="text" class="form-control" id="" placeholder="Quantitée">
		</div>



		<button type="submit" class="btn btn-primary">Acheté</button>
	</form>
</div>

<?php if(isset($_SESSION['valid'])) { unset($_SESSION['valid']); } ?>
<?php if(isset($_SESSION['error'])) { unset($_SESSION['error']); } ?>
