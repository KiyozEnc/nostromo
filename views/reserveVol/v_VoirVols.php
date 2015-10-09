<?php

// Affichage des fleurs dans un tableau
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
        <!--<th>Actions</th>-->
      </tr>
    </thead>
    <tbody>
      <?php

      foreach ($tabVols as $vol)
        { ?>
      <tr>
       <td><?php echo $vol['dateVol']; ?></td>
       <td> <?php echo $vol['heureVol']; ?> </td>
       <td> <?php echo $vol['nbPlace']; ?> </td>
       <td> OPTION AJOUTER PANIER </td>
       <!--<td><a href='?uc=gestionVols&action=modifierVol&numVol=<?php echo $vol['numVol'];?>'><img border=0 src='Public/Images/Divers/Modifier.png'></a><a href='?uc=gestionVols&action=supprimerVol&numVol=<?php echo $vol['numVol'];?>'><img border=0 src='Public/Images/Divers/Poubelle.png'></a></td>-->
     </tr>
     <?php } ?>
   </tbody>
 </table>
</div>
