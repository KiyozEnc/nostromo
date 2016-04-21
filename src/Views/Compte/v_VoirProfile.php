<div class="row row-centered">
    <?php
    if (array_key_exists('Reservation', $_SESSION) && $_SESSION['Reservation']->isValid()) { ?>
        <p class="col-xs-12 col-md-8 col-md-offset-2 col-centered">Votre vol décolle dans
            <span id="time"></span> !</p>
        <?php
    } else { ?>
        <p class="col-xs-12 col-md-8 col-md-offset-2 col-centered">Vous n'avez aucune réservation. <a
                href="?page=reserver">Réserver maintenant !</a></p>
        <?php
    }
    ?>
    <p class="col-xs-12 col-md-8 col-md-offset-2 col-centered">
        <?php
        echo "Vous avez {$_SESSION['Utilisateur']->getPoints()} points de fidélité.";
        ?>
    </p>
    <h3 class="col-xs-12 col-md-8 col-md-offset-2 col-centered">
        <small>
            Calcul de vos points de fidélité (+10 points à votre inscription)
            <ul>
                <li>10% du prix transformé en points pour les commandes</li>
                <li>1 point = <?= \Nostromo\Classes\Build::TYPE_RESERVATION ?> € pour les réservations de vols</li>
            </ul>
        </small>
    </h3>
</div>
