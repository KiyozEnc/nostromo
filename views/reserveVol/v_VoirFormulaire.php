<?php if(isset($_SESSION['error'])) { ?>
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        <?= $_SESSION['error'] ?>
    </div>
<?php } ?>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="thumbnail">
            <div class="col-md-3">
                <img class="img-responsive" src="img/avion.png" title="Vol n°<?= $vol->getNumVol() ?>">
            </div>
            <div class="caption">
                <h3>Vol n°<?= $vol->getNumVol() ?></h3>
                <p>Date et heure : <?= $vol->getDateVol() ?> à <?= $vol->getHeureVol() ?></p>
                <form action="?uc=reserver&action=validReserverVol&vol=<?= $vol->getNumVol(); ?>" method="POST" role="form" autocomplete="off">
                    <p class="text-info"><?= $nbPlaceRestante ?> places restantes !</p>
                    <div class="row">
                        <div class="row col-xs-12 col-sm-12 col-md-7 col-lg-7">
                            <div class="form-group">
                                <label for="">Nombre de personnes</label>
                                <input type="text" class="form-control" id="nbPers" name="nbPers" placeholder="Nombre de personnes">
                            </div>
                        </div>
                    </div>

                    <a href="?uc=reserver" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php if(isset($_SESSION['error'])) { unset($_SESSION['error']); } ?>
