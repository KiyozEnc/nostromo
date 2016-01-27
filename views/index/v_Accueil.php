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
<?php if(isset($_SESSION['Utilisateur'])) { ?>
    <div class="row">
        <div class="rectangle col-lg-4">
            <h4 class="text-center"><a href="?uc=maReservation">Réservation</a></h4>
            <?php if(isset($reservation))
            { ?>
                <p class="text-justify"><?php echo "Vol n°".$reservation->getUnVol()->getNumVol()." - ".$reservation->getNbPers()."/".$reservation->getUnVol()->getNbPlace()." personnes" ?>, pour le <?php echo $reservation->getUnVol()->getDateVol()." à ".$reservation->getUnVol()->getHeureVol() ?></p>
                <?php
            }
            else
            {
                echo '<p class="text-justify">Aucune réservation</p>';
            } ?>
        </div>
        <div class="rectangle col-lg-4 col-lg-offset-4">
            <h4 class="text-center"><a href="?uc=monCompte&action=voirCommandes">Vos dernières commandes</a></h4>
            <p class="text-justify">
                <?php if(isset($commandes))
                { ?>
                    <?php foreach ($commandes->getCollection() as $commande)
                {
                    echo 'N°'.$commande->getId().' - le '.$commande->getUnedate();
                    echo '<p class="margin">';
                    foreach ($commande->getLesArticles()->getCollection() as $article)
                    {
                        echo 'Article n°: '.$article->getNumArt().' - '.$article->getDesignation().' - Quantité : '.$article->getQte().'<br>';
                    }
                    echo '</p>';
                } ?>
                <?php }
                else
                {
                    echo 'Aucune commande';
                } ?>
            </p>
        </div>
    </div>
    <br>
<?php } ?>
<div class="jumbotron">
    Test index
</div>
<?php if(isset($_SESSION['valid'])) { unset($_SESSION['valid']); } ?>
<?php if(isset($_SESSION['error'])) { unset($_SESSION['error']); } ?>
