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
<form action="?uc=monCompte&action=voirCommandes" method="post" role="form">
    <div class="row">
        <div class="form-group">
            <label for="inputID" class="col-sm-2 control-label">Commandes :</label>
            <div class="col-sm-10">
                <select name="cde" id="inputID" class="form-control" onchange="voirCommande(this.form)">
                    <option disabled selected>-- Sélectionner une commande --</option>
                    <?php
                    if(isset($lesCommandes))
                    {
                        foreach ($lesCommandes->getCollection() as $commande)
                        { ?>
                            <option value="<?= $commande->getId() ?>"><?= "N°".$commande->getId()." le ".$commande->getUneDate() ?> - Montant : <?= $commande->getMontantTotal(); ?> €</option>
                            <?php
                        }
                    } ?>
                </select>
            </div>
        </div>
    </div>
</form>

<?php
if(isset($uneCommande))
{ ?>
    <h2>Commande n°<?= $uneCommande->getId() ?></h2>
    <table class="table table-hover table-stripped table-bordered">
        <thead>
        <tr>
            <th>Désignation</th>
            <th>Prix unitaire</th>
            <th>Quantité commandé</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($uneCommande->getLesArticles()->getCollection() as $article)
        { ?>

            <tr>
                <td><?= $article->getDesignation() ?></td>
                <td><?= $article->getPu() ?> €</td>
                <td><?= $article->getQte() ?></td>
            </tr>
            <?php
        } ?>
        </tbody>
    </table>
    <?php
}
else
{
    if(isset($lesCommandes))
    {
        if($lesCommandes->taille() == 0)
        {
            echo 'Aucune commande';
        }
        else
        {
            echo '<h5 class="text-center">Veuillez sélectionner une commande</h5>';
        }
    }
}
?>