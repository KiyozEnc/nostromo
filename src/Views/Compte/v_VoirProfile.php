<div class="row row-centered">
    <?php
    if (array_key_exists('Reservation', $_SESSION) && $_SESSION['Reservation']->isValid()) { ?>
        <p class="col-xs-12 col-sm-8 col-sm-offset-2 col-centered">Votre vol décolle dans
            <span id="time"></span> !</p>
        <?php
    } else { ?>
        <p class="col-xs-12 col-sm-8 col-sm-offset-2 col-centered">Vous n'avez aucune réservation. <a
                href="?page=reserver">Réserver maintenant !</a></p>
        <?php
    }
    ?>
    <p class="col-xs-12 col-sm-8 col-sm-offset-2 col-centered">
        <?php
        echo "Vous avez {$_SESSION['Utilisateur']->getPoints()} points de fidélité.";
        ?>
    </p>
</div>
