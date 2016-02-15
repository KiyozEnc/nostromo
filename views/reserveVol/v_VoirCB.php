<?php
require_once 'views/v_Alert.php'; ?>
<form action="?page=reserver&action=validCB&vol=<?= $vol->getNumVol(); ?>" method="POST" role="form" autocomplete="off">
    <h2>Confirmer votre réservation</h2>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="">Nombre de personnes</label>
                <input type="text" class="form-control" id="nbPers" name="nbPers" placeholder="Pour combien de personnes faut-il réserver le vol ?">
            </div>
        </div>
    </div>

    <a href="?page=reserver" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
    <button type="submit" class="btn btn-primary">Suivant</button>
</form>
