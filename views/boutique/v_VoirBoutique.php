<?php

use Nostromo\Models\MConnexion as Connexion;

if (array_key_exists('valid', $_SESSION)) { ?>
    <div class="alert alert-success" role="alert">
        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
        <?php echo $_SESSION['valid'] ?>
    </div>
<?php } ?>
<?php
if (array_key_exists('error', $_SESSION)) { ?>
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        <?php echo $_SESSION['error'] ?>
    </div>
<?php } ?>
<table class="table table-bordered table-hover table-condensed">
    <h2>Articles disponibles</h2>
    <thead>
    <tr>
        <th>Numéro de l'article</th>
        <th>Désignation</th>
        <th>Prix unitaire</th>
        <?php
        if (Connexion::sessionOuverte()) { ?>
            <th>Actions</th>
        <?php
        } ?>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($tabArt->getCollection() as $art => $unArt) { ?>
        <tr>
            <td><?php echo $unArt->getNumArt(); ?></td>
            <td><?php echo $unArt->getDesignation(); ?></td>
            <td><?php echo $unArt->getPu(); ?> €</td>
            <?php
            if (Connexion::sessionOuverte()) { ?>
                <th>
                    <a href="?uc=materiel&action=voirArticle&article=<?php echo $unArt->getNumArt(); ?>"
                       type="button"
                       class="btn btn-default">Détails
                    </a>
                </th>
            <?php
            } ?>
        </tr>
    <?php
    } ?>
    </tbody>
</table>
<?php if (array_key_exists('valid', $_SESSION)) {
    unset($_SESSION['valid']);
} ?>
<?php if (array_key_exists('error', $_SESSION)) {
    unset($_SESSION['error']);
}
