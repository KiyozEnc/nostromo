<?php
use Nostromo\Models\MConnexion as Connexion;

require_once ROOT.'src/Views/v_Alert.php'; ?>
<div class="row row-centered">
    <h2 class="text-center text-info text-muted">Articles disponibles</h2>
    <?php
    foreach ($tabArt->getCollection() as $unArt) {
        /** @var \Nostromo\Classes\Article $unArt */
        ?>
        <div class="col-md-4 col-lg-3 col-centered">
            <div class="thumbnail">
                <br>
                <?php
                if ($unArt->getQteStock() === 0) { ?>
                    <img width="60%"
                         height="60%"
                         class="img-responsive"
                         src="<?php echo $unArt->getUrl(); ?>"
                         title="Article n°<?= $unArt->getNumArt() ?>">
                    <?php
                } else { ?>
                    <a href="?page=materiel&action=voirArticle&article=<?= $unArt->getNumArt() ?>">
                        <img width="60%"
                             height="60%"
                             class="img-responsive"
                             src="<?php echo $unArt->getUrl(); ?>"
                             title="Article n°<?= $unArt->getNumArt() ?>">
                    </a>
                <?php
                }
                ?>

                <div class="caption">
                    <?php
                    if (Connexion::sessionOuverte() && $unArt->getQteStock() > 0) {
                        ?>
                        <h4 class="text-center">
                            <a href="?page=materiel&action=voirArticle&article=<?= $unArt->getNumArt() ?>">
                                <?php echo $unArt->getDesignation();
                                ?>
                            </a>
                        </h4>
                        <?php

                    } else {
                        echo '<h4 class="text-center">'.$unArt->getDesignation();
                        if ($unArt->getQteStock() === 0) {
                            echo ' <small class="text-danger">PLUS EN STOCK</small>';
                        }
                        echo '</h4>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    } ?>
</div>
