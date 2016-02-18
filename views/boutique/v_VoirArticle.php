<?php
require_once 'views/v_Alert.php'; ?>
<div class="row row-centered">
    <div class="col-xs-12 col-sm-8 col-centered">
        <div class="thumbnail">
            <br>
            <div class="col-xs-12 col-sm-3">
                <img class="img-responsive" src=<?php echo $article->getUrl(); ?> title="Article n°<?= $article->getNumArt() ?>">
                <br>
            </div>
            <div class="caption">
                <h3 class="text-center text-uppercase">Article n°<?= $article->getNumArt() ?></h3>
                <form
                        class="form-horizontal"
                        action="?page=monPanier&action=ajouterArticle&ref=<?php echo $article->getNumArt();
                        if (array_key_exists('target', $_GET)) {
                            echo '&target='.$_GET['target'];
                        } ?>" method="POST" role="form" autocomplete="off">
                    <div class="form-group">
                        <label class="control-label col-xs-4 col-sm-1">Quantité</label>
                        <div class="col-xs-6 col-sm-2">
                            <input type="number" class="form-control" name="qte" placeholder="Quantité" value="1">
                        </div>
                    </div>
                    <br>
                    <a href="?page=materiel" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
            </div>
        </div>
    </div>
</div>
