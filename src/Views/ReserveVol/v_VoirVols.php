<?php

use Nostromo\Models\MConnexion as Connexion;
use Nostromo\Models\MVol;
use Nostromo\Classes\Build;

require_once ROOT.'src/Views/v_Alert.php'; ?>

<div class="row row-centered">
    <?php
    if ($lesVols->taille() === 0) {
        echo '<h2>Aucun vol actuellement. Revenez ultérieurement.</h2>';
    } else {
        ?>
        <h2 class="text-center text-info text-muted">Vols disponibles</h2>
        <?php
        foreach ($lesVols->getCollection() as $unVol) {
            ?>
            <?php /* @var $unVol \Nostromo\Classes\Vol */ ?>
            <div class="col-md-4 col-lg-3 col-centered">
                <div class="thumbnail">
                    <img
                        class="img-responsive hidden-xs"
                        height="128"
                        width="128"
                        src=<?= \Nostromo\Classes\Build::genererUrlImgAvion() ?>
                        title="Vol n°<?= $unVol->getNumVol() ?>"
                    >
                    <div class="caption">
                        <h2>Vol n°<?= $unVol->getNumVol() ?>
                            <?php
                            if (MVol::getPlaceRestante($unVol) === 0) {
                                echo ' - <span class="text-danger">COMPLET</span>';
                            }
                            ?></h2>
                        <h4>Date et heure : <?= $unVol->getDateVol() ?> à <?= $unVol->getHeureVol() ?></h4>
                        <h5>Prix : <?php echo Build::fEuro($unVol->getPrice());
                            ?>
                        </h5>
                        <?php
                        if (Connexion::sessionOuverte()) : ?>
                            <p><a
                                    href="?page=reserver&action=reserverVol&vol=<?= $unVol->getNumVol() ?>"
                                    <?php
                                    if (MVol::getPlaceRestante($unVol) === 0) {
                                        echo 'disabled';
                                    } ?>
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
        }
    } ?>
</div>
