<?php

use Nostromo\Models\MConnexion as Connexion;

require_once ROOT.'src/Views/v_Alert.php'; ?>
<div class="row row-centered">
    <h2 class="text-center text-info text-muted">Articles disponibles</h2>
    <?php
    foreach ($tabArt->getCollection() as $unArt) {
        ?>
        <div class="col-xs-12 col-sm-3 col-centered">
            <div class="thumbnail">
                <br>
                <img width="20%"
                     height="20%"
                     class="img-responsive"
                     src=<?php echo $unArt->getUrl(); ?>
                     title="Article n°<?= $unArt->getNumArt() ?>">
                <div class="caption">
                    <?php
                    if (Connexion::sessionOuverte()) {
                        ?>
                        <p class="text-center">
                            <a href="?page=materiel&action=voirArticle&article=<?= $unArt->getNumArt() ?>">
                                <?php echo $unArt->getDesignation();
                                ?>
                            </a>
                        </p>
                        <?php

                    } else {
                        echo '<p class="text-center">'.$unArt->getDesignation().'</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    } ?>
</div>