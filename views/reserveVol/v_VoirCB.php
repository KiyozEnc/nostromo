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
} ?>
<form action="?uc=reserver&action=validCB&vol=<?= $vol->getNumVol(); ?>" method="POST" role="form" autocomplete="off">
    <h2>Confirmer votre réservation</h2>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="">Nombre de personnes</label>
                <input type="text" class="form-control" id="nbPers" name="nbPers" placeholder="Pour combien de personnes faut-il réserver le vol ?">
            </div>
        </div>
    </div>

    <a href="?uc=reserver" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
    <button type="submit" class="btn btn-primary">Suivant</button>
</form>
