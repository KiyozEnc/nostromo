<?php

// Affichage des fleurs dans un tableau

require_once("classes/date.classe.php");

?>

<div class="jumbotron">
  <table class="table table-bordered table-hover table-condensed">
    <legend>Listes de vols disponible</legend>
    <thead>
      <tr>
        <th>Date</th>
        <th>Heure</th>
        <th>Nombre de place</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($tabVols as $vol => $unVol)
        { ?>
      <tr>
        <td> <?php echo DateVol::formaterDate($unVol->getDateVol()); ?> </td>
        <td> <?php echo DateVol::formaterHeure($unVol->getHeureVol()); ?> </td>
        <td><?php echo $unVol->getNbPlace(); ?></td>
        <td> OPTION AJOUTER PANIER </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
