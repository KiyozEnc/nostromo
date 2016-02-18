<?php
require_once 'views/v_Alert.php';
if (array_key_exists('Reservation', $_SESSION)) {
    ?>

    <!-- COMPTEUR VOL DANS XX TEMPS EN JS ICI -->
    <div class="row row-centered">
        <div class="col-sm-6 col-xs-12 col-centered">
            <table class="table table-bordered table-hover table-condensed">
                <?php
                if (!$_SESSION['Reservation']->isValid()) {
                    ?> <legend>Vol demandé</legend> <?php

                } else {
                    ?> <legend>Vol réservé</legend> <?php

                }
                ?>

                <thead>
                <tr>
                    <th>Code</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Nombre de personnes</th>
                    <th>Prix</th>
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
                    <td><?php echo $_SESSION['Reservation']->getNbPers(); ?></td>
                    <td><?php echo number_format($_SESSION['Reservation']->getNbPers()*$_SESSION['Reservation']->getUnVol()->getPrice(), 2, ',', ' ').' €'; ?></td>
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
            <?php
            if (!$_SESSION['Reservation']->isValid()) {
                ?>
                <a class="btn btn-primary"
                   href="?page=maReservation&action=payment"
                   role="button">Valider la réservation
                </a>
                <?php

            } else {
                echo '<small>Pour retirer votre réservation, contacter Nostromo</small>';
            }
            ?>
        </div>
    </div>
    <?php

} else {
    ?> <p>Aucun vol actuellement réservé</p>

    <a class="btn btn-default" href="?page=index" role="button">Revenir à l'accueil</a>
    <?php
} ?>
