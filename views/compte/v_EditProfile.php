<ul class="nav nav-pills">
    <li role="presentation"><a href="?uc=monCompte">Accueil</a></li>
    <li role="presentation" class="active"><a href="?uc=monCompte&action=edit">Modifier mes informations</a></li>
    <li role="presentation"><a href="?uc=monCompte&action=voirCommandes">Mes commandes</a></li>
</ul>
<div class="page-header">
    <h1>Mon compte
        <small>Modifier vos informations</small>
    </h1>
</div>
<p class="text-center">Formulaire de modification</p>
<form action="?uc=monCompte&action=edit" method="post">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group text-center"><label for="">Mot de passe</label><input name="pwd" type="password" class="form-control"></div>
        </div>
        <div class="col-lg-6">
            <div class="form-group text-center"><label for="">Confirmer le mot de passe</label><input name="pwdconf" type="password" class="form-control"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group text-center"><label for="">Nom</label><input name="name" type="text" class="form-control"></div>
        </div>
        <div class="col-lg-6">
            <div class="form-group text-center"><label for="">Prénom</label><input name="firstname" type="text" class="form-control"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group text-center"><label for="">Adresse</label><input name="address" type="text" class="form-control"></div>
        </div>
        <div class="col-lg-4">
            <div class="form-group text-center"><label for="">Code postal</label><input name="cp" type="text" class="form-control"></div>
        </div>
        <div class="col-lg-4">
            <div class="form-group text-center"><label for="">Ville</label><input name="city" type="text" class="form-control"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            <div class="form-group text-center"><label for="">Mot de passe actuel</label><input type="password" class="form-control"></div>
        </div>
    </div>
    <a href="?uc=monCompte" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
    <input type="submit" class="btn btn-primary">
</form>
<small>Seulement les champs que vous renseignerez serons modifiés. Veuillez indiquer le mot de passe actuel de votre compte pour confirmer.</small>