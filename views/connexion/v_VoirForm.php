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
<form action="?uc=connexion&action=seConnecter" method="POST" role="form">
    <legend>Connexion à Nostromo</legend>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
            <div class="form-group">
                <label for="">Adresse e-mail</label>
                <input type="email" class="form-control" id="mailUser" name="mailUser" placeholder="Adresse e-mail">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
            <div class="form-group">
                <label for="">Mot de passe</label>
                <input type="password" class="form-control" id="mdpUser" name="mdpUser" placeholder="Mot de passe">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
    <a class="btn btn-default" href="?uc=inscription" role="button">Pas encore inscrit ?</a>
</form>
