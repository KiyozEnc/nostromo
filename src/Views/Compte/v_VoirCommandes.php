<div class="row row-centered">
    <div class="col-xs-12 col-sm-6 col-centered">
        <form class="form-horizontal" action="?page=monCompte&action=voirCommandes" method="post" role="form">
            <div class="form-group">
                <label for="inputID" class="col-sm-2 control-label">Commandes</label>
                <div class="col-xs-12 col-sm-10 col-centered">
                    <select name="cde" id="inputID" class="form-control" onchange="voirCommande(this.form)">
                        <option disabled selected>-- Sélectionner une commande --</option>
                        <?php
                        if (isset($lesCommandes)) {
                            foreach ($lesCommandes->getCollection() as $commande) {
                                ?>
                                <option value="<?= $commande->getId() ?>"><?= 'N°'.$commande->getId().' le '.$commande->getUneDate() ?> - Montant : <?= $commande->getMontantTotal();
                                    ?> €</option>
                                <?php

                            }
                        } ?>
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row row-centered">
    <div class="col-xs-12 col-sm-6 col-sm-offset-3">
        <?php
        if (isset($uneCommande)) {
            ?>
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
                foreach ($uneCommande->getLesArticles()->getCollection() as $article) {
                    ?>

                    <tr>
                        <td><?= $article->getDesignation() ?></td>
                        <td><?= $article->getPu() ?> €</td>
                        <td><?= $article->getQte() ?></td>
                    </tr>
                    <?php

                }
                ?>
                </tbody>
            </table>
            <?php

        } else {
            if (isset($lesCommandes)) {
                if ($lesCommandes->taille() === 0) {
                    echo '<p class="text-center text-info">Vous n\'avez aucune commande.</p>';
                } else {
                    echo '<h5 class="text-center">Veuillez sélectionner une commande</h5>';
                }
            }
        }
        ?>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-3 col-sm-offset-3">
        <a href="?page=monCompte" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
    </div>
</div>
