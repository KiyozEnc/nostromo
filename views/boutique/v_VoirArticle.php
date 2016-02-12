<?php
if (array_key_exists('valid', $_SESSION)) { ?>
    <div class="alert alert-success" role="alert">
        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
        <?php echo $_SESSION['valid'] ?>
    </div>
<?php } ?>
<?php
if (array_key_exists('error', $_SESSION)) { ?>
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        <?php echo $_SESSION['error'] ?>
    </div>
<?php } ?>
<h2>
    <?php echo $article->getDesignation(); ?>
    — Référence : <?php echo $article->getNumArt() ?>
</h2>
<p>Prix unitaire : <?php echo $article->getPu(); ?> € TTC</p>
<form action="?uc=monPanier&action=ajouterArticle&ref=<?php echo $article->getNumArt(); ?>"
      method="POST"
      role="form"
      autocomplete="off">
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label for="">Quantité voulue</label>
                <input name="qte" type="number" class="form-control" id="" placeholder="Quantité">
            </div>
        </div>
    </div>
    <a href="?uc=materiel" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
    <button type="submit" class="btn btn-primary">Ajouter au panier</button>
</form>
<?php if (array_key_exists('valid', $_SESSION)) {
    unset($_SESSION['valid']);
} ?>
<?php if (array_key_exists('error', $_SESSION)) {
    unset($_SESSION['error']);
}
