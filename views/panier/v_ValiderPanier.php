<?php
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
                    while($i<13) {
                        ?>
                        <option  ?><?php echo $i ?></option>
                        <?php 
                        $i=$i+1;
                    }
                    ?>
            </select> Mois

                        <select>
                    <?php 
                    $i=2014;
                    while($i<2021) {
                        ?>
                        <option  ?><?php echo $i ?></option>
                        <?php 
                        $i=$i+1;
                    }
                    ?>
            </select>
        </div>
    <a href ="?uc=monPanier&action=enregistrerPanier" class="btn btn-primary">Finaliser la commande</a>

    </div>
<?php if(isset($_SESSION['valid'])) { unset($_SESSION['valid']); } ?>
<?php if(isset($_SESSION['error'])) { unset($_SESSION['error']); } ?>
