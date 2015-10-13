<?php

// Affichage des fleurs dans un tableau


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
  <?php
  if(isset($_SESSION['Reservation']))
    { ?>
  <table class="table table-bordered table-hover table-condensed">
    <legend>Vol réservé</legend>
    <thead>
      <tr>
        <th>Code</th>
        <th>Date</th>
        <th>Heure</th>
        <th>Nombre de place</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php var_dump($_SESSION['Reservation']); ?>
        <td><?php echo DateVol::formaterDate($_SESSION['Reservation']->getDateVol()); ?> </td>
        <td><?php echo DateVol::formaterHeure($_SESSION['Reservation']->getHeureVol()); ?> </td>
        <td><?php echo $_SESSION['Reservation']->getNbPlace(); ?></td>
      </tr>
    </tbody>
  </table>
  <?php }
  else
  {
    echo "Aucun vol actuellement réservé.<br><br>"; ?>

    <a class="btn btn-default" href="?uc=index" role="button">Revenir à l'accueil</a>
    <?php } ?>
  </div>

  <?php if(isset($_SESSION['valid'])) { unset($_SESSION['valid']); } ?>
  <?php if(isset($_SESSION['error'])) { unset($_SESSION['error']); } ?>
  <?php unset($_SESSION['Reservation']); ?>
