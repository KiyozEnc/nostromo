<?php
require_once("classes/date.classe.php");
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
    <table class="table table-bordered table-hover table-condensed">
        <legend>Liste des vols disponible</legend>
        <thead>
        <tr>
            <th>Date</th>
            <th>Heure</th>
            <th>Nombre de place maximale</th>
            <th>Nombre de place restantes</th>
            <?php
            if(Connexion::sessionOuverte()) { ?><th>Actions</th><?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($lesVols->getCollection() as $unVol)
        { ?>
            <tr>
                <td> <?php echo DateVol::formaterDate($unVol->getDateVol()); ?> </td>
                <td> <?php echo DateVol::formaterHeure($unVol->getHeureVol()); ?> </td>
                <td><?php echo $unVol->getNbPlace(); ?></td>
                <td><?php echo MVol::getPlaceRestante($unVol) ?></td>
                <?php
                if(Connexion::sessionOuverte()) { ?>
                    <td> <?php
                    if(MVol::getPlaceRestante($unVol) == 0)
                    { ?>
                        COMPLET <?php
                    }
                    else
                    { ?>
                        <a href="?uc=reserver&action=reserverVol&vol=<?php echo $unVol->getNumVol(); ?>" title="Réserver le vol n° <?= $unVol->getNumVol(); ?>">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            Réserver
                        </a> <?php
                    } ?>
                    </td><?php
                } ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php if(isset($_SESSION['valid'])) { unset($_SESSION['valid']); } ?>
<?php if(isset($_SESSION['error'])) { unset($_SESSION['error']); } ?>
