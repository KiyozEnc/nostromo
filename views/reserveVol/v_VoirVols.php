<?php

use Nostromo\Models\MConnexion as Connexion;

if (isset($_SESSION['valid'])) { ?>
    <div class="alert alert-success" role="alert">
        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
        <?= $_SESSION['valid'] ?>
    </div>
<?php } ?>
<?php if (isset($_SESSION['error'])) { ?>
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        <?= $_SESSION['error'] ?>
    </div>
<?php } ?>
<div class="row">
    <h2 class="text-center text-info text-muted">Vols disponibles</h2>
    <?php foreach ($lesVols->getCollection() as $unVol)
    { ?>
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <img class="img-responsive" src="img/avion.png" title="Vol n°<?= $unVol->getNumVol() ?>">
                <div class="caption">
                    <h3>Vol n°<?= $unVol->getNumVol() ?></h3>
                    <p>Date et heure : <?= $unVol->getDateVol() ?> à <?= $unVol->getHeureVol() ?></p>
                    <?php if(Connexion::sessionOuverte()) : ?>
                        <p><a href="?uc=reserver&action=reserverVol&vol=<?= $unVol->getNumVol() ?>" class="btn btn-primary" role="button">Réserver</a></p>
                    <?php endif ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php if(isset($_SESSION['valid'])) { unset($_SESSION['valid']); } ?>
<?php if(isset($_SESSION['error'])) { unset($_SESSION['error']); } ?>
