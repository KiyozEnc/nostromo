<?php
require_once("models/m_Connexion.php");
?>
    <div class="jumbotron">
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
        <h2><?php echo $article->getDesignation(); ?> — Référence : <?= $article->getNumArt() ?></h2>
        <p>Prix unitaire : <?php echo $article->getPu(); ?> € TTC</p>
        <form action="?uc=monPanier&action=ajouterArticle&ref=<?php echo $article->getNumArt(); ?>" method="POST" role="form" autocomplete="off">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="">Quantité voulue</label>
                        <input name="qte" type="text" class="form-control" id="" placeholder="Quantité">
                    </div>
                </div>
            </div>
            <a href="?uc=materiel" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            <button type="submit" class="btn btn-primary">Ajouter au panier</button>
        </form>
    </div>
<?php if(isset($_SESSION['valid'])) { unset($_SESSION['valid']); } ?>
<?php if(isset($_SESSION['error'])) { unset($_SESSION['error']); } ?>
