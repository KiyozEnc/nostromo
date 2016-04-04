<?php
require_once ROOT.'src/Views/v_Alert.php'; ?>
<div class="row">
    <div class="col-xs-12 col-lg-12 col-sm-12 col-md-12">
        <div class="thumbnail">
            <div class="col-md-3 col-sm-3">
                <img class="img-responsive" src="public/Resources/img/avion.png" title="Vol n°<?= $vol->getNumVol() ?>">
            </div>
            <div class="caption">
                <h3>Vol n°<?= $vol->getNumVol() ?></h3>
                <p>Date et heure : <?= $vol->getDateVol() ?> à <?= $vol->getHeureVol() ?></p>
                <form action="?page=reserver&action=validReserverVol&vol=<?= $vol->getNumVol(); ?>" method="POST" role="form" autocomplete="off">
                    <p class="text-info"><?= $nbPlaceRestante ?> places disponibles !<br>Vol à partir de <?php echo $vol->getFormattedPrice(); ?></p>
                    <div class="row">
                        <div class="col-xs-12 col-sm-2">
                            <div class="form-group">
                                <label for="">Nombre de personnes</label>
                                <input type="number" class="form-control" id="nbPers" name="nbPers" placeholder="Nombre de personnes" value="1">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-2">
                            <div class="checkbox">
                                <label><input id="reduction" type="checkbox" name="reduction">Appliqué une réduction ?</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <div class="form-group">
                                <label for="">Réduction</label>
                                <input
                                    id="pointsUtilise"
                                    type="number"
                                    class="form-control"
                                    name="pointsUtilise"
                                    placeholder="Combien de points ?"
                                    disabled>
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