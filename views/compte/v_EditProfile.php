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
<p class="text-center">Formulaire de modification</p>
<form action="?uc=monCompte&action=edit" method="post">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group text-center"><label for="pwd">Mot de passe</label><input name="pwd" type="password" class="form-control"></div>
        </div>
        <div class="col-lg-6">
            <div class="form-group text-center"><label for="pwdconf">Confirmer le mot de passe</label><input name="pwdconf" type="password" class="form-control"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group text-center"><label for="name">Nom</label><input name="name" type="text" class="form-control"></div>
        </div>
        <div class="col-lg-6">
            <div class="form-group text-center"><label for="firstname">Prénom</label><input name="firstname" type="text" class="form-control"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group text-center"><label for="address">Adresse</label><input name="address" type="text" class="form-control"></div>
        </div>
        <div class="col-lg-4">
            <div class="form-group text-center"><label for="cp">Code postal</label><input name="cp" type="text" class="form-control"></div>
        </div>
        <div class="col-lg-4">
            <div class="form-group text-center"><label for="city">Ville</label><input name="city" type="text" class="form-control"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            <div class="form-group text-center"><label for="actualpwd">Mot de passe actuel</label><input name="actualpwd" type="password" class="form-control" required></div>
        </div>
    </div>
    <a href="?uc=monCompte" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
    <input type="submit" class="btn btn-primary" name="submit" value="Envoyer">
</form>
<small>Seulement les champs que vous renseignerez serons modifiés. Veuillez indiquer le mot de passe actuel de votre compte pour confirmer.</small>
<?php
if(isset($_SESSION['error']))
    unset($_SESSION['error']);
if(isset($_SESSION['valid']))
    unset($_SESSION['valid']);
?>