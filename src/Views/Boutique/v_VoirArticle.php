<?php
require_once ROOT.'src/Views/v_Alert.php'; ?>
<div class="row row-centered">
    <div class="col-xs-12 col-sm-8 col-centered">
        <div class="thumbnail">
            <br>
            <div class="col-xs-12 col-sm-3">
                <img class="img-responsive" src=<?php echo 'public/Resources/'.$article->getUrl(); ?> title="Article n°<?= $article->getNumArt() ?>">
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
                        <?php /* @var \Nostromo\Classes\Article $article */ ?>
                            <h5 class="col-xs-12 col-sm-8">Prix
                                : <?php echo '<span id="priceContainer">'.\Nostromo\Classes\Build::formaterEuro($article->getPu()).'</span>'; ?>
                            </h5>
                        <label class="control-label col-xs-4 col-sm-1">Quantité</label>
                        <div class="col-xs-6 col-sm-2">
                            <input id="qte" type="number" class="form-control" name="qte" placeholder="Quantité" value="1">
                            <input type="hidden" id="price" readonly disabled value="<?php echo $article->getPu() ?>">
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <p class="text-info rectangle">
                                    <?php echo '<br>'.$article->getDescription(); ?>
                                </p>
                            </div>
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
<?php ob_start(); ?>
<script src="/public/Resources/js/price-manager.js"></script>
<?php $scripts = ob_get_clean(); ?>