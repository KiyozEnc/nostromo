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
	<table class="table table-bordered table-hover table-condensed">
		<legend>Liste des articles disponible</legend>
		<thead>
			<tr>
				<th>Numéro de l'article</th>
				<th>Désignation</th>
				<th>Prix unitaire</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($tabArt as $art => $unArt)
				{ ?>
			<tr>
				<td> <?php echo $unArt->getNumArt(); ?> </td>
				<td> <?php echo $unArt->getDesignation(); ?> </td>
				<td><?php echo $unArt->getPu(); ?> €</td>
				<td> <a href="?uc=materiel&action=voirArticle&article=<?php echo $unArt->getNumArt(); ?>" type="button" class="btn btn-default">Détails</a></td>

			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<?php if(isset($_SESSION['valid'])) { unset($_SESSION['valid']); } ?>
<?php if(isset($_SESSION['error'])) { unset($_SESSION['error']); } ?>
