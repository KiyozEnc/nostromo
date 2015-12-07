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
	<?php }
	$total=0;
	if(isset($_SESSION['Panier'])){
	?>
	<table class="table table-bordered table-hover table-condensed">
		<legend>Voici votre Panier</legend>
		<br>
		<thead>
			<tr>
				<th>Numéro de l'article</th>
				<th>Désignation</th>
				<th>Prix</th>
				<?php
				if(Connexion::sessionOuverte()) { ?><th>Actions</th><?php } ?>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($_SESSION['Panier']->getProduitsPanier() as $art => $Panier)
				{ ?>
			<tr>
				<td> <?php echo $Panier->getNumArt(); ?></td>
				<td> <?php echo $Panier->getDesignation(); ?> </td>
				<td><?php echo $Panier->getPu(); ?> €</td>
				<td>
					<a href="?uc=monPanier&action=diminuerProduit&article=<?php echo $Panier->getNumArt(); ?>" title="Enlever une quantité"><span class="glyphicon glyphicon-minus"></span></a>
					<?php echo $Panier->getQte(); ?>
					<a href="?uc=monPanier&action=augmenterProduit&article=<?php echo $Panier->getNumArt(); ?>" title="Ajouter une quantité"><span class="glyphicon glyphicon-plus"></span></a>
					<a href="?uc=monPanier&action=supprimerProduit&article=<?php echo $Panier->getNumArt(); ?>" title="Supprimer de la liste"><span class="glyphicon glyphicon-remove"></span></a>
				</td>
				<td><?php echo $Panier->getPu()*$Panier->getQte(); ?> €</td>
				<?php  $total=$total+$Panier->getPu()*$Panier->getQte(); ?>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	total à payer : <?php echo $total; ?> €
	<br><br>
		<a href ="?uc=monPanier&action=viderPanier" type="button" class="btn btn-primary">Vider le Panier</a>
		<a href ="?uc=monPanier&action=validerPanier" type="button" class="btn btn-primary">Valider la commande</a>
	<?php }
	else{ ?>
	<p>Vous n'avez rien sélectionné pour le moment.</p>
	<?php } ?>

</div>

<?php if(isset($_SESSION['valid'])) { unset($_SESSION['valid']); } ?>
<?php if(isset($_SESSION['error'])) { unset($_SESSION['error']); } ?>
