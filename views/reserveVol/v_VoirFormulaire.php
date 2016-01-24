<div class="jumbotron">
    <?php if(isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            <?= $_SESSION['error'] ?>
        </div>
    <?php } ?>
    <form action="?uc=reserver&action=validReserverVol&vol=<?= $vol->getNumVol(); ?>" method="POST" role="form" autocomplete="off">
        <h2>Réserver le vol n° <?= $vol->getNumVol(); ?> — Nombre de place restantes pour ce vol : <?= $nbPlaceRestante ?> places</h2>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="">Nombre de personnes</label>
                    <input type="text" class="form-control" id="nbPers" name="nbPers" placeholder="Pour combien de personnes faut-il réserver le vol ?">
                </div>
            </div>
        </div>

        <a href="?uc=reserver" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
</div>
<?php if(isset($_SESSION['error'])) { unset($_SESSION['error']); } ?>
