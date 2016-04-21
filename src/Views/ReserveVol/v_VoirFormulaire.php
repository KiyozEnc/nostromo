<?php
use Nostromo\Classes\Reservation;

require_once ROOT.'src/Views/v_Alert.php'; ?>
<div class="row">
    <div class="col-xs-12 col-lg-12 col-md-12 col-md-12">
        <div class="thumbnail">
            <div class="col-md-3 col-md-3">
                <img class="img-responsive" height="256" width="256" src=<?= \Nostromo\Classes\Build::genererUrlImgAvion() ?> title="Vol n°<?= $vol->getNumVol() ?>">
            </div>
            <div class="caption">
                <h2 class="text-primary">Vol n°<?= $vol->getNumVol() ?></h2>
                <h3>Date et heure : <?= $vol->getDateVol() ?> à <?= $vol->getHeureVol() ?></h3>
                <form action="?page=reserver&action=validReserverVol&vol=<?= $vol->getNumVol(); ?>" method="POST" role="form" autocomplete="off">
                    <h3 class="text-muted"><?= $nbPlaceRestante ?> places disponibles !</h3>
                    <h4 class="text-uppercase text-warning">Vol à partir de <?= \Nostromo\Classes\Build::formaterEuro($vol->getPrice()) ?></h4>
                    <div class="row">
                        <div class="col-xs-12 col-md-2">
                            <div class="form-group">
                                <label for="">Nombre de personnes</label>
                                <input type="number" min="1" class="form-control" id="nbPers" name="nbPers" placeholder="Nombre de personnes" value="1">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-2">
                            <div class="checkbox">
                                <label><input id="reduction" type="checkbox" name="reduction">Appliqué une réduction ?</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="">Réduction (-<?= Reservation::STEP_REDUCTION * 100 ?>% par <?= Reservation::STEP_POINTS ?> points)</label>
                                <input
                                    id="pointsUtilise"
                                    type="number"
                                    class="form-control"
                                    name="pointsUtilise"
                                    min="<?= Reservation::STEP_POINTS ?>"
                                    step="<?= Reservation::STEP_POINTS ?>"
                                    max="<?= Reservation::STEP_POINTS * 14 ?>"
                                    placeholder="Combien de points ?"
                                readonly>
                            </div>
                        </div>
                    </div>
                    <a href="?page=reserver" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php ob_start(); ?>
    <script src="public/Resources/js/flight-manager.js"></script>
<?php $scripts = ob_get_clean(); ?>