<!-- Alerte valid -->
<?php
require_once ROOT.'src/Views/v_Alert.php'; ?>
<form action="?page=inscription&action=inscrire" method="POST" role="form">
    <div class="row row-centered">
        <h2 class="text-center text-muted">Inscription</h2>
        <div class="col-xs-6 col-md-3 col-centered">
            <div class="form-group">
                <label for="nomUser">Nom</label>
                <input type="text" class="form-control" id="nomUser" name="nomUser" placeholder="Nom" required>
            </div>
        </div>
        <div class="col-xs-6 col-md-3 col-centered">
            <div class="form-group">
                <label for="prenUser">Prénom</label>
                <input type="text" class="form-control" id="prenUser" name="prenUser" placeholder="Prénom" required>
            </div>
        </div>
    </div>
    <div class="row row-centered">
        <div class="col-xs-7 col-md-3 col-centered">
            <div class="form-group">
                <label for="adrUser">Adresse (n° et rue)</label>
                <input type="text" class="form-control" id="adrUser" name="adrUser" placeholder="Adresse (n° et rue)" required>
            </div>
        </div>
        <div class="col-xs-5 col-md-3 col-centered">
            <div class="form-group">
                <label for="villeUser">Ville</label>
                <input type="text" class="form-control" id="villeUser" name="villeUser" placeholder="Ville" required>
            </div>
        </div>
    </div>
    <div class="row row-centered">
        <div class="col-xs-5 col-md-2 col-centered">
            <div class="form-group">
                <label for="cpUser">Code postal</label>
                <input type="number" min="10000" max="99999" class="form-control" id="cpUser" name="cpUser" placeholder="Code postal" required>
            </div>
        </div>
        <div class="col-xs-7 col-md-4 col-centered">
            <div class="form-group">
                <label for="mailUser">Adresse e-mail</label>
                <input type="email" class="form-control" id="mailUser" name="mailUser" placeholder="Adresse e-mail" required>
            </div>
        </div>
    </div>
    <div class="row row-centered">
        <div class="col-xs-6 col-md-3 col-centered">
            <div class="form-group">
                <label for="mdpUser">Mot de passe</label>
                <input type="password" class="form-control" id="mdpUser" name="mdpUser" placeholder="Mot de passe" required>
            </div>
        </div>
        <div class="col-xs-6 col-md-3 col-centered">
            <div class="form-group">
                <label for="mdpConfUser">Confirmation <span class="hidden-xs">du mot de passe</span></label>
                <input type="password" class="form-control" id="mdpConfUser" name="mdpConfUser" placeholder="Confirmation du mot de passe" required>
            </div>
        </div>
        <div class="col-xs-12 col-md-12">
            <button type="submit" class="btn btn-primary">Valider</button>
            <a class="btn btn-default" href="?page=connexion" role="button">Déjà inscrit ?</a>
        </div>
    </div>
</form>
