<?php


require_once 'Views/v_Alert.php';

if (array_key_exists('Panier', $_SESSION)) {
    ?>
    <h2 class="text-center text-info">Votre Panier</h2>
    <?php
    $total = 0;
    foreach ($_SESSION['Panier']->getProduitsPanier() as $art) {
        ?>
        <div class="row">
            <div class="col-xs-12 col-sm-3">
                <?php echo '<span class="text-uppercase"><a href="?page=materiel&action=voirArticle&article='.$art->getNumArt().'&target=panier">'.$art->getDesignation().'</a></span>';
                ?>
            </div>
            <div class="col-xs-12 col-sm-3">
                <?php
                echo 'EUR '.number_format($art->getPu(), 2, ',', '');
                ?>
            </div>
            <div class="col-xs-12 col-sm-3">
                <?php
                if ($art->getQteStock() !== 0 && $art->getQte() <= $art->getQteStock()) {
                    echo '<span class="text-success">En stock</span>';
                } else {
                    echo '<span class="text-danger">Rupture de stock !</span>';
                }
                ?>
            </div>
            <div class="col-xs-12 col-sm-3">
                <span class="sr-only" data-attr="<?php echo $art->getNumArt();
                ?>"></span>
                <select name="qte" id="qte" class="form-control" onchange="setQte(<?php echo $art->getNumArt();
                ?>, <?php echo $art->getQte();
                ?>)">
                    <?php
                    for ($i = 0; $i <= $art->getQteStock(); ++$i) {
                        ?>
                        <option
                                <?php
                                if ($art->getQte() === $i) {
                                    echo 'selected=\'\'';
                                }
                                ?>
                                value="<?php echo $i;
                                ?>">
                            <?php
                            if ($i === 0) {
                                echo 'Supprimer';
                            } else {
                                echo $i;
                            }
                            ?>
                        </option>
                        <?php

                    }
                    ?>
                </select>
            </div>
            <br><br>
        </div>
        <?php
        $total += $art->getPu() * $art->getQte();
    }
    ?>
    <h4>Total à payer : <?php echo 'EUR '.number_format($total, 2, ',', ' ');
        ?></h4>
    <div class="row">
        <div class="col-xs-12">
            <a href ="?page=monPanier&action=viderPanier" onclick="return etesVousSur('Voulez-vous vider le panier ?')" class="btn btn-primary">Vider</a>
            <a href ="?page=monPanier&action=validerPanier" class="btn btn-primary">Passer la commande</a>
        </div>
    </div>
    <?php

} else {
    ?>
    <p class="text-muted text-center">Votre panier est vide. <a href="?page=materiel">Commandez maintenant !</a></p>
    <?php
} ?>