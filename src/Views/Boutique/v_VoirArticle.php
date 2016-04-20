<?php
use Nostromo\Classes\Reservation;

require_once ROOT.'src/Views/v_Alert.php'; ?>
<div class="thumbnail">
    <img class="img-responsive" height="256" width="256" src=<?php echo $article->getUrl(); ?> title="Article n°<?= $article->getNumArt() ?>">
    <hr>
    <div class="caption">
        <h3 class="text-center text-primary text-uppercase"><?= $article->getDesignation() ?></h3>
        <form
            class="form-horizontal"
            action="?page=monPanier&action=ajouterArticle&ref=<?php echo $article->getNumArt();
            if (array_key_exists('target', $_GET)) {
                echo '&target='.$_GET['target'];
            } ?>" method="POST" role="form" autocomplete="off">
            <div class="form-group">
                <div class="col-xs-12 col-md-offset-1 col-md-10">
                    <p class="text-muted text-center visible-lg">
                        <?php echo $article->getDescription(); ?>
                    </p>
                    <p class="text-muted text-justify hidden-lg">
                        <?= $article->getDescription(); ?>
                    </p>
                </div>
                <div class="col-xs-12 col-md-2 col-md-offset-1">
                    <label>Quantité</label>
                    <input id="qte" type="number" min="1" max=<?= $article->getQteStock() ?> class="form-control" name="qte" placeholder="Quantité" value="1">
                    <input type="hidden" id="price" readonly disabled value="<?php echo $article->getPu() ?>">
                </div>
                <div class="col-xs-12 col-md-2">
                    <div class="checkbox">
                        <label><input id="reduction" type="checkbox" name="reduction">Appliqué une réduction ?</label>
                    </div>
                </div>
                <div class="col-xs-12 col-md-2">
                    <div class="form-group">
                        <label for="">Réduction (-<span id="percent"><?= Reservation::STEP_REDUCTION * 100 * 2 ?></span>% par <span id="step"><?= Reservation::STEP_POINTS ?></span> points)</label>
                        <input
                            id="pointsUtilise"
                            type="number"
                            class="form-control"
                            name="pointsUtilise"
                            min="<?= Reservation::STEP_POINTS ?>"
                            step="<?= Reservation::STEP_POINTS ?>"
                            max="<?= Reservation::STEP_POINTS * 14 ?>"
                            placeholder="Combien de points ?"
                            disabled>
                    </div>
                </div>
                <div class="col-xs-12 col-md-5">
                    <h3>Prix : <span class="text-info"><?php echo '<span id="priceContainer">'.\Nostromo\Classes\Build::formaterEuro($article->getPu()).'</span>'; ?></span></h3>
                </div>
            </div>
            <br>
            <a href="?page=materiel" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
    </div>
</div>
<?php ob_start(); ?>
<script src="public/Resources/js/price-manager.js"></script>
<script src="public/Resources/js/flight-manager.js"></script>
<?php $scripts = ob_get_clean(); ?>
