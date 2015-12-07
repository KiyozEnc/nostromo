<?php
require_once("models/m_Connexion.php");
?>


<div class="jumbotron">
    <!-- Alerte valid -->
    <?php if(isset($_SESSION['valid'])) { ?>
        <div class="alert alert-success" role="alert">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            <?= $_SESSION['valid'] ?>
        </div>
    <?php } ?>
    <!-- Alerte error -->
    <?php if(isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            <?= $_SESSION['error'] ?>
        </div>
    <?php }
    if(isset($_SESSION['Panier'])){ ?>
        <table class="table table-bordered table-hover table-condensed">
            <legend>Votre Panier</legend>
            <thead>
            <th>N° de l'article</th>
            <th>Désignation</th>
            <th>Prix</th>
            <?php if(Connexion::sessionOuverte()) { ?> <th>Actions</th> <?php } ?>
            <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $total = 0;
            foreach ($_SESSION['Panier']->getProduitsPanier() as $art => $Panier)
            { ?>
                <tr>
                    <td> <?php echo $Panier->getNumArt(); ?></td>
                    <td> <?php echo $Panier->getDesignation(); ?> </td>
                    <td><?php echo $Panier->getPu(); ?> €</td>
                    <td>
                        <a href="?uc=monPanier&action=diminuerProduit&article=<?php echo $Panier->getNumArt(); ?>" title="Enlever une quantité">
                            <img src="img/moins.png" height="17">
                        </a>
                        <?php echo " ".$Panier->getQte()." "; ?>
                        <a href="?uc=monPanier&action=augmenterProduit&article=<?php echo $Panier->getNumArt(); ?>" title="Ajouter une quantité">
                            <img src="img/plus.png" height="17">
                        </a>
                        <a href="?uc=monPanier&action=supprimerProduit&article=<?php echo $Panier->getNumArt(); ?>" title="Supprimer de la liste">
                            <img src="img/croix.png" height="17">
                        </a>
                    </td>
                    <td>
                        <?php echo $Panier->getPu()*$Panier->getQte(); ?> €
                    </td>
                    <?php $total = $total + $Panier->getPu() * $Panier->getQte(); ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <h4>Total à payer : <?= $total ?> €</h4>
        <a href ="?uc=monPanier&action=viderPanier" class="btn btn-primary">Vider le Panier</a>
        <a href ="?uc=monPanier&action=validerPanier" class="btn btn-primary">Valider la commande</a>
        <?php
    }
    else
    {
        ?>
        <p>Vous n'avez rien sélectionné pour le moment.</p>
    <?php } ?>
</div>
<?php if(isset($_SESSION['valid'])) { unset($_SESSION['valid']); } ?>
<?php if(isset($_SESSION['error'])) { unset($_SESSION['error']); } ?>
