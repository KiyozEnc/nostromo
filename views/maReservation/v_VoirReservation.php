<?php
use Nostromo\Classes\Build;

require_once ROOT.'views/v_Alert.php';
if (array_key_exists('Reservation', $_SESSION)) {
    ?>
    <!-- COMPTEUR VOL DANS XX TEMPS EN JS ICI -->
    <div class="row row-centered">
        <div class="col-sm-6 col-xs-12 col-centered">
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
                        <td><a href="?page=maReservation&action=annulerReservation"
                               title="Annuler la réservation du vol n°<?php echo $_SESSION['Reservation']->getUnVol()->getNumVol(); ?>">
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
                <div class="col-xs-12 col-sm-6">
                    <?php
                    if ($_SESSION['Reservation']->getNbEcheance() === 1) {
                        echo '<h3>Échéances :</h3>';
                        echo 'Payé : '.Build::formaterEuro($_SESSION['Reservation']->getPriceReservation()).' - le '.Build::formaterDateTimeWithDate($_SESSION['Reservation']->getDateRes());
                    } elseif ($_SESSION['Reservation']->getNbEcheance() === 3) {
                        /* @var \Nostromo\Classes\Echeance $echeance */
                        echo '<h3>Échéances :</h3>';
                        foreach ($_SESSION['Reservation']->getLesEcheance()->getCollection() as $echeance) {
                            $now = new \DateTime();
                            if ($echeance->getDate() > new \DateTime() ||
                                Build::formaterDateTimeWithDate($echeance->getDate()) === Build::formaterDateTimeWithDate($now)) {
                                echo ' '. Build::formaterEuro($echeance->getMontant());
                                echo ' pour le : '.Build::formaterDateTimeWithDate($echeance->getDate()).'<br>';
                            }
                        }
                    } else {
                        echo '<h4>A payer : '.Build::formaterEuro($_SESSION['Reservation']->getPriceReservation()).'</h4>';
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

            }
            ?>
        </div>
    </div>
    <?php

} else {
    ?> <p>Aucun vol actuellement réservé</p>

    <a class="btn btn-default" href="?page=index" role="button">Revenir à l'accueil</a>
    <?php
}
