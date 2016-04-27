<?php
// Vue de l'édition de compte (Partie Kevin C)
?>
<div class="row">
    <div class="col-xs-12 col-md-12 col-md-offset-1">
        <p class="text-center">Formulaire de modification</p>
        <form action="?page=monCompte&action=edit" method="post">
            <div class="row row-centered">
                <div class="col-xs-12 col-md-4 col-centered">
                    <div class="form-group text-center"><label for="name">Nom</label><input name="name" type="text" class="form-control"></div>
                </div>
                <div class="col-xs-12 col-md-4 col-centered">
                    <div class="form-group text-center"><label for="firstname">Prénom</label><input name="firstname" type="text" class="form-control"></div>
                </div>
            </div>
            <div class="row row-centered">
                <div class="col-xs-12 col-md-4 col-centered">
                    <div class="form-group text-center"><label for="pwd">Mot de passe</label><input name="pwd" type="password" class="form-control"></div>
                </div>
                <div class="col-xs-12 col-md-4 col-centered">
                    <div class="form-group text-center"><label for="pwdconf">Confirmer le mot de passe</label><input name="pwdconf" type="password" class="form-control"></div>
                </div>
            </div>
            <div class="row row-centered">
                <div class="col-xs-12 col-md-4 col-centered">
                    <div class="form-group text-center"><label for="address">Adresse</label><input name="address" type="text" class="form-control"></div>
                </div>
                <div class="col-xs-12 col-md-2 col-centered">
                    <div class="form-group text-center"><label for="cp">Code postal</label><input name="cp" type="text" class="form-control"></div>
                </div>
                <div class="col-xs-12 col-md-2 col-centered">
                    <div class="form-group text-center"><label for="city">Ville</label><input name="city" type="text" class="form-control"></div>
                </div>
            </div>
            <div class="row row-centered">
                <div class="col-xs-12 col-md-4 col-centered">
                    <div class="form-group text-center"><label for="actualpwd">Mot de passe actuel</label><input name="actualpwd" type="password" class="form-control" required></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6 col-md-offset-2">
                    <a href="?page=monCompte" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    <input type="submit" class="btn btn-primary" name="submit" value="Envoyer">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <small class="text-justify">Seulement les champs que vous renseignerez serons modifiés. Veuillez indiquer le mot de passe actuel de votre compte pour confirmer. Il vous est impossible de modifier votre adresse e-mail.</small>
                </div>
            </div>
        </form>
    </div>
</div>
