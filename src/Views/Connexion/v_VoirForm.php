<?php
require_once ROOT.'src/Views/v_Alert.php'; ?>
<form action="?page=connexion&action=seConnecter" method="POST" role="form">
    <div class="row row-centered">
        <h2 class="text-center text-muted">Connexion</h2>
        <div class="col-xs-12 col-sm-2 col-centered">
            <div class="form-group">
                <label for="">Adresse e-mail</label>
                <input type="email" class="form-control" id="mailUser" name="mailUser" placeholder="Adresse e-mail">
            </div>
        </div>
        <div class="col-xs-12 col-sm-2 col-centered">
            <div class="form-group">
                <label for="">Mot de passe</label>
                <input type="password" class="form-control" id="mdpUser" name="mdpUser" placeholder="Mot de passe">
            </div>
        </div>
        <div class="col-sm-12">
            <button type="submit" class="btn btn-primary">Valider</button>
            <a class="btn btn-default" href="?page=inscription" role="button">Pas encore inscrit ?</a>
        </div>
    </div>
</form>
