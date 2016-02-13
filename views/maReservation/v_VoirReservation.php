<!-- Alerte valid -->
<?php if (array_key_exists('valid', $_SESSION)) { ?>
    <div class="alert alert-success" role="alert">
        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
        <?= $_SESSION['valid'] ?>
    </div>
<?php } ?>
<?php if (array_key_exists('error', $_SESSION)) { ?>
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        <?= $_SESSION['error'] ?>
    </div>
<?php } ?>
<?php if (array_key_exists('valid', $_SESSION)) {
    unset($_SESSION['valid']);
} ?>
<?php if (array_key_exists('error', $_SESSION)) {
    unset($_SESSION['error']);
}
if (array_key_exists('Reservation', $_SESSION)) { ?>

    <!-- COMPTEUR VOL DANS XX TEMPS EN JS ICI -->
    <table class="table table-bordered table-hover table-condensed">
        <?php
        if (!$_SESSION['Reservation']->isValid()) {
            ?> <legend>Vol demandé</legend> <?php
        } else {
            ?> <legend>Vol réservé</legend> <?php
        } ?>

        <thead>
        <tr>
            <th>Code</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Nombre de personnes</th>
            <?php if (!$_SESSION['Reservation']->isValid()) { ?>
                <th>Actions</th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $_SESSION['Reservation']->getUnVol()->getNumVol(); ?></td>
            <td><?php echo $_SESSION['Reservation']->getUnVol()->getDateVol() ?></td>
            <td><?php echo $_SESSION['Reservation']->getUnVol()->getHeureVol() ?></td>
            <td><?php echo $_SESSION['Reservation']->getNbPers(); ?></td>
            <?php
            if (!$_SESSION['Reservation']->isValid()) { ?>
                <td><a href="?uc=maReservation&action=annulerReservation"
                       title="Annuler la réservation du vol n°<?= $_SESSION['Reservation']->getUnVol()->getNumVol(); ?>">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Annuler
                    </a>
                </td>
            <?php
            } ?>
        </tr>
        </tbody>
    </table>
    <?php
    if (!$_SESSION['Reservation']->isValid()) { ?>
        <a class="btn btn-primary"
           href="?uc=maReservation&action=validerReservation"
           role="button">Valider la réservation
        </a>
    <?php
    } else {
        echo 'Pour retirer votre réservation, contacter Nostromo';
    }
} else {
    ?> <p>Aucun vol actuellement réservé</p>

    <a class="btn btn-default" href="?uc=index" role="button">Revenir à l'accueil</a>
<?php } ?>
