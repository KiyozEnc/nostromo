<?php
use Nostromo\Classes\Build;
use Nostromo\Classes\Reservation;

require_once ROOT.'src/Views/v_Alert.php';

if (array_key_exists('Panier', $_SESSION)) {
    ?>
    <h2 class="text-center text-info">Votre Panier</h2>
    <?php
    $total = 0;
    foreach ($_SESSION['Panier']->getProduitsPanier() as $art) { ?>
        <div class="row">
            <div class="col-xs-12 col-md-3">
                <span class="text-uppercase">
                    <a
                        href="?page=materiel&action=voirArticle&article=<?= $art->getNumArt() ?>&target=panier">
                        <?= $art->getDesignation() ?>
                    </a>
                </span>
            </div>
            <div class="col-xs-12 col-md-3">
                <?= Build::fEuro($art->getPu()); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <?php
                if ($art->getQteStock() !== 0 && $art->getQte() <= $art->getQteStock()) { ?>
                    <span class="text-success">En stock</span>
                    <?php
                } else { ?>
                    <span class="text-danger">Rupture de stock !</span>
                    <?php
                }
                ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <span class="sr-only" data-attr="<?= $art->getNumArt(); ?>"></span>
                <select name="qte" id="qte" class="form-control" onchange="setQte(<?= $art->getNumArt();
                ?>, <?= $art->getQte();
                ?>)">
                    <?php
                    for ($i = 0; $i <= $art->getQteStock(); ++$i) {
                        ?>
                        <option
                            <?php
                            if ($art->getQte() === $i) {
                                echo 'selected=\'\'';
                            }
                            ?>
                            value="<?php echo $i;
                            ?>">
                            <?php
                            if ($i === 0) {
                                echo 'Supprimer';
                            } else {
                                echo $i;
                            }
                            ?>
                        </option>
                        <?php

                    }
                    ?>
                </select>
            </div>
            <br><br>
        </div>
        <?php
        $total += $art->getPu() * $art->getQte();
    }
    ?>
    <div class="row">
        <div class="col-xs-12 col-md-5">
            <div class="checkbox">
                <label><input id="reduction" type="checkbox" name="reduction"
                        <?php
                        if ($_SESSION['Panier']->getPointsUtilise() > 0) {
                            echo 'checked=checked';
                        } ?>
                    >Appliqué une réduction ?</label>
            </div>
        </div>
    </div>
    <form action="?page=monPanier&action=validerPanier" method="post" autocomplete="off">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                <div class="form-group">
                    <label for="">
                        Réduction
                        (-<span id="percent"><?= round(Reservation::STEP_REDUCTION * 100 * 1.5, 2) ?></span>%
                        par <span id="step">
                            <?= Reservation::STEP_POINTS ?>
                        </span> points)
                    </label>
                    <input
                        id="pointsUtilise"
                        type="number"
                        class="form-control"
                        name="pointsUtilise"
                        step="<?= Reservation::STEP_POINTS ?>"
                        max="<?= Reservation::STEP_POINTS * 11 ?>"
                        <?php
                        if ($_SESSION['Panier']->getPointsUtilise() > 0) {
                            echo "value='{$_SESSION['Panier']->getPointsUtilise()}'";
                        } else {
                            echo 'readonly';
                        } ?>
                        placeholder="Combien de points ?">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-5">
                <h4>Total à payer : <span id="total"><?php echo Build::fEuro($_SESSION['Panier']->getPrixTotal());
                        ?></span></h4>
                <h5>Total remise (en %) : <span id="remise">0%</span></h5>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <a
                    href="?page=monPanier&action=viderPanier"
                    onclick="return etesVousSur('Voulez-vous vider le panier ?')"
                    class="btn btn-primary">
                    <span class="glyphicon glyphicon-trash"></span> Vider
                </a>
                <button
                    type="submit"
                    class="btn btn-primary">
                    <span class="glyphicon glyphicon-ok"></span> Passer la commande
                </button>
            </div>
        </div>
    </form>
    <?php
} else {
    ?>
    <div class="row">
        <div class="col-xs-12 col-md-6 col-md-offset-2"><p class="text-muted">Votre panier est vide. <a
                    href="?page=materiel">Commandez maintenant !</a></p></div>
    </div>
    <?php
} ?>
<?php ob_start(); ?>
<script src="public/Resources/js/flight-manager.js"></script>
<script src="public/Resources/js/basket-manager.js"></script>
<?php $scripts = ob_get_clean(); ?>
