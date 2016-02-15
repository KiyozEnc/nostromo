<?php
require_once 'views/v_Alert.php'; ?>
<p>Validation de Votre Commande</p>


<div class="form-group">
    <label for="">Nom du titulaire de la carte</label>
    <input type="nomTitulaire" class="form-control" id="nomTitulaire" name="nomTitulaire" placeholder="François Dupont">
</div>

<div class="form-group">
    <label for="">Numéro de votre carte</label>
    <input type="numCarte" class="form-control" id="numCarte" name="numCarte" placeholder="0000 0000 0000 0000">
</div>

<div class="form-group">
    <label for="">Date d'expiration</label><br>
    <select>
        <?php
        $i=1;
        while ($i < 13) {
            ?>
            <option  ?><?php echo $i ?></option>
            <?php
            $i++;
        }
        ?>
    </select> Mois

    <select>
        <?php
        $i=2014;
        while ($i < 2021) {
            ?>
            <option><?php echo $i ?></option>
            <?php
            $i++;
        }
        ?>
    </select>
</div>
<a href ="?page=monPanier&action=enregistrerPanier" class="btn btn-primary">Finaliser la commande</a>
