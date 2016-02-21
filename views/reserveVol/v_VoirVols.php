<?php

use Nostromo\Models\MConnexion as Connexion;

include_once ROOT.'views/v_Alert.php'; ?>

<div class="row row-centered">
    <h2 class="text-center text-info text-muted">Vols disponibles</h2>
    <?php foreach ($lesVols->getCollection() as $unVol) { ?>
        <?php /* @var $unVol \Nostromo\Classes\Vol */ ?>
        <div class="col-sm-4 col-lg-3 col-centered">
            <div class="thumbnail">
                <img
                        class="img-responsive hidden-xs"
                        height="50%"
                        width="50%"
                        src="img<?= DS ?>avion.png"
                        title="Vol n°<?= $unVol->getNumVol() ?>"
                >
                <div class="caption">
                    <h3>Vol n°<?= $unVol->getNumVol() ?></h3>
                    <p>Date et heure : <?= $unVol->getDateVol() ?> à <?= $unVol->getHeureVol() ?></p>
                    <p>Prix : <?php echo number_format($unVol->getPrice(), 2, ',', ' ').' €'; ?></p>
                    <?php
                    if (Connexion::sessionOuverte()) : ?>
                        <p><a
                                    href="?page=reserver&action=reserverVol&vol=<?= $unVol->getNumVol() ?>"
                                    class="btn btn-primary"
                                    role="button">Réserver
                            </a>
                        </p>
                        <?php
                    endif ?>
                </div>
            </div>
        </div>
    <?php
} ?>
</div>
