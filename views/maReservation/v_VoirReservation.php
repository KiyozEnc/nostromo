<?php

?>
<div class="jumbotron">
    <?php if(isset($_SESSION['valid'])) { ?>
        <div class="alert alert-success" role="alert">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            <?= $_SESSION['valid'] ?>
        </div>
    <?php } ?>
    <?php if(isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            <?= $_SESSION['error'] ?>
        </div>
    <?php } ?>
    <?php
    if(isset($_SESSION['Reservation']))
    {  ?>

        <!-- COMPTEUR VOL DANS XX TEMPS EN JS ICI -->
        <table class="table table-bordered table-hover table-condensed">
            <?php
            if($_SESSION['Reservation']->isValid() == false)
            {
                ?> <legend>Vol demandé</legend> <?php
            }
            else
            {
                ?> <legend>Vol réservé</legend> <?php
            } ?>

            <thead>
            <tr>
                <th>Code</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Nombre de personnes</th>
                <?php if($_SESSION['Reservation']->isValid() == false) { ?> <th>Actions</th> <?php } ?>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo $_SESSION['Reservation']->getUnVol()->getNumVol(); ?></td>
                <td><?php echo $_SESSION['Reservation']->getDateRes()->format('d/m/Y') ?></td>
                <td><?php echo $_SESSION['Reservation']->getDateRes()->format('H:i'); ?></td>
                <td><?php echo $_SESSION['Reservation']->getNbPers(); ?></td>
                <?php if($_SESSION['Reservation']->isValid() == false) { ?> <td><a href="?uc=maReservation&action=annulerReservation" title="Annuler la réservation du vol n°<?= $_SESSION['Reservation']->getUnVol()->getNumVol(); ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Annuler</a></td><?php } ?>
            </tr>
            </tbody>
        </table>
        <?php if($_SESSION['Reservation']->isValid() == false) { ?> <a class="btn btn-primary" href="?uc=maReservation&action=validerReservation" role="button">Valider la réservation</a><?php } else { echo "Pour retirer votre réservation, contacter Nostromo"; } ?>
    <?php }
    else
    {
        ?> <p>Aucun vol actuellement réservé</p>

        <a class="btn btn-default" href="?uc=index" role="button">Revenir à l'accueil</a>
    <?php } ?>
</div>

<?php if(isset($_SESSION['valid'])) { unset($_SESSION['valid']); } ?>
<?php if(isset($_SESSION['error'])) { unset($_SESSION['error']); } ?>
