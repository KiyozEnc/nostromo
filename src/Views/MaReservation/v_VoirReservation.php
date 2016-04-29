<?php
use Nostromo\Classes\Build;

require_once ROOT.'src/Views/v_Alert.php';
if (array_key_exists('Reservation', $_SESSION)) {
    ?>
    <div class="row row-centered">
        <div class="col-md-6 col-xs-12 col-centered">
            <table class="table table-bordered table-hover table-condensed">
                <?php
                if (!$_SESSION['Reservation']->isValid()) {
                    ?> <legend>Vol souhaité</legend> <?php

                } else {
                    ?> <legend>Vol réservé</legend> <?php

                }
                ?>

                <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Date du vol</th>
                    <th>Heure du vol</th>
                    <th>Réservé pour</th>
                    <?php
                    if (!$_SESSION['Reservation']->isValid()) {
                        ?>
                        <th>Actions</th>
                        <?php
                    }
                    ?>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo $_SESSION['Reservation']->getUnVol()->getNumVol();
                        ?></td>
                    <td><?php echo $_SESSION['Reservation']->getUnVol()->getDateVol() ?></td>
                    <td><?php echo $_SESSION['Reservation']->getUnVol()->getHeureVol() ?></td>
                    <td><?php echo $_SESSION['Reservation']->getNbPers().' personnes'; ?></td>

                    <?php
                    if (!$_SESSION['Reservation']->isValid()) {
                        ?>
                        <td><a
                                href="?page=maReservation&action=annulerReservation"
                                title="Annuler pour le vol n°<?= $_SESSION['Reservation']->getUnVol()->getNumVol(); ?>">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Annuler
                            </a>
                        </td>
                        <?php

                    }
                    ?>
                </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-xs-12 col-md-7">
                    <?php
                    if ($_SESSION['Reservation']->getNbEcheance() === 1) {
                        echo '<h3>Échéances :</h3>';
                        echo 'Payé : '.Build::fEuro($_SESSION['Reservation']->getPriceReservation()).
                            ' - le '.Build::fDateTimeDate($_SESSION['Reservation']->getDateRes());
                    } elseif ($_SESSION['Reservation']->getNbEcheance() === 3) {
                        /* @var \Nostromo\Classes\Echeance $echeance */
                        echo '<h3>Échéances :</h3>';
                        foreach ($_SESSION['Reservation']->getLesEcheance()->getCollection() as $echeance) {
                            $now = new \DateTime();
                            if ($echeance->getDate() > new \DateTime() ||
                                Build::fDateTimeDate($echeance->getDate()) === Build::fDateTimeDate($now)) {
                                echo ' '. Build::fEuro($echeance->getMontant());
                                echo ' pour le : '.Build::fDateTimeDate($echeance->getDate()).'<br>';
                            }
                        }
                    } else {
                        echo '<h4>A payer : '.Build::fEuro($_SESSION['Reservation']->getPriceReservation()).'</h4>';
                        if ($_SESSION['Reservation']->getReduction() > 0) {
                            echo '<h5>Dont : '.Build::fEuro($_SESSION['Reservation']->getPriceRemise()).
                                ' de remise lié aux points de fidélité.</h5>';
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
            if (!$_SESSION['Reservation']->isValid()) {
                ?>
                <a class="btn btn-primary"
                   href="?page=maReservation&action=payment"
                   role="button">Valider la réservation
                </a>
                <?php
            } else { ?>
                <div class="row">
                    <div class="col-xs-12 col-md-2">
                        <br>
                        <a
                            href="?page=maReservation&action=annulerReservationValidee"
                            class="btn btn-primary">Annuler la réservation
                        </a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <?php

} else {
    ?> <div class="row">
        <p class="col-xs-12 col-md-6 col-md-offset-2 text-muted">
            Vous n'avez aucune réservation.
            <a href="?page=reserver" role="button">Réserver un vol</a>
        </p>
    </div>
    <?php
}
