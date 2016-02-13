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
    <div class="row">
        <div class="col-xs-12 col-lg-12 col-sm-12 col-md-12">
            <div class="thumbnail">
                <br>
                <div class="col-md-3 col-sm-3 col-lg-3 col-xs-3">
                    <img class="img-responsive" src=<?php echo $article->getUrl(); ?> title="Article n°<?= $article->getNumArt() ?>">
                </div>
                <div class="caption">
                    <h3>Article n°<?= $article->getNumArt() ?></h3>
                    <form action="?uc=monPanier&action=ajouterArticle&ref=<?php echo $article->getNumArt(); ?>" method="POST" role="form" autocomplete="off">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                                <div class="form-group">
                                    <label for="">Quantité voulue</label>
                                    <input type="number" class="form-control" name="qte" placeholder="Quantité">
                                </div>
                            </div>
                        </div>
                        <br>
                        <a href="?uc=materiel" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php if (array_key_exists('valid', $_SESSION)) {
    unset($_SESSION['valid']);
} ?>
<?php if (array_key_exists('error', $_SESSION)) {
    unset($_SESSION['error']);
}
