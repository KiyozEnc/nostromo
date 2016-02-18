<?php

use Nostromo\Models\MConnexion as Connexion;

require_once 'views/v_Alert.php'; ?>

<div class="row row-centered">
    <h2 class="text-center text-info text-muted">Vols disponibles</h2>
    <?php foreach ($lesVols->getCollection() as $unVol) {
    ?>
        <div class="col-sm-4 col-lg-3 col-centered">
            <div class="thumbnail">
                <img class="img-responsive hidden-xs" height="50%" width="50%" src="img/avion.png" title="Vol n°<?= $unVol->getNumVol() ?>">
                <div class="caption">
                    <h3>Vol n°<?= $unVol->getNumVol() ?></h3>
                    <p>Date et heure : <?= $unVol->getDateVol() ?> à <?= $unVol->getHeureVol() ?></p>
                    <?php
                    if (Connexion::sessionOuverte()) : ?>
                        <p><a href="?page=reserver&action=reserverVol&vol=<?= $unVol->getNumVol() ?>" class="btn btn-primary" role="button">Réserver</a></p>
                        <?php
                    endif ?>
                </div>
            </div>
        </div>
    <?php 
} ?>
</div>
