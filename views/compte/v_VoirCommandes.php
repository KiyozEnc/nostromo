<ul class="nav nav-pills">
    <li role="presentation"><a href="?uc=monCompte">Accueil</a></li>
    <li role="presentation"><a href="?uc=monCompte&action=edit">Modifier mes informations</a></li>
    <li role="presentation" class="active"><a href="?uc=monCompte&action=voirCommandes">Mes commandes</a></li>
</ul>
<div class="page-header">
    <h1>Mon compte
        <small>Mes commandes</small>
    </h1>
</div>
<div class="form-group">
    <label for="inputID" class="col-sm-2 control-label">Label:</label>
    <div class="col-sm-10">
        <select name="name" id="inputID" class="form-control">
            <option disabled selected>-- Sélectionner une commande --</option>
            <?php foreach ($lesCommandes->getCollection() as $commande)
            {

            } ?>
        </select>
    </div>
</div>