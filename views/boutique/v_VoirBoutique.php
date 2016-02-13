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
    <div class="row">
        <h2 class="text-center text-info text-muted">Articles disponibles</h2>
        <?php foreach ($tabArt->getCollection() as $unArt) { ?>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <br>
                    <img width="100"
                         height="100"
                         class="img-responsive"
                         src=<?php echo $unArt->getUrl(); ?> title="Article n°<?= $unArt->getNumArt() ?>">
                    <div class="caption">
                        <!-- <h3>Article n°<?php echo $unArt->getNumArt(); ?></h3> -->
                            <?php
                            if (Connexion::sessionOuverte()) { ?>
                            <p><a href="?uc=materiel&action=voirArticle&article=<?= $unArt->getNumArt() ?>"><?php echo $unArt->getDesignation(); ?></a></p>
                            <?php
                            } else {
                                 echo '<p>'.$unArt->getDesignation().'</p>';
                            } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php if (array_key_exists('valid', $_SESSION)) {
    unset($_SESSION['valid']);
} ?>
<?php if (array_key_exists('error', $_SESSION)) {
    unset($_SESSION['error']);
}
