<?php
require_once ROOT.'src/Views/v_Alert.php'; ?>
<h3>Validation de Votre Commande</h3>
<form action="?page=monPanier&action=enregistrerPanier" autocomplete="off" method="post">
    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            <label for="nomTitulaire">Nom du titulaire de la carte</label>
            <input
                type="nomTitulaire"
                class="form-control"
                id="nomTitulaire"
                name="nomTitulaire"
                placeholder="M. François Dupont"
                minlength="5"
                required>
        </div>
        <div class="form-group">
            <label for="numCarte">Numéro de votre carte</label>
            <input
                type="number"
                class="form-control"
                id="numCarte"
                name="numCarte"
                placeholder="16 numéros"
                maxlength="16"
                minlength="16"
                min="1000000000000000"
                max="9999999999999999"
                required>
        </div>
        <div class="form-group">
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-4 col-md-4">
                        <label for="CBMonth">Mois</label>
                        <select name="CBMonth" class="form-control" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <label for="CBYear">Année</label>
                        <select name="CBYear" class="form-control" required>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2022</option>
                            <option value="2023">2023</option>
                        </select>
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <label for="CBSecret">Code CVC</label>
                        <input
                            type="number"
                            class="form-control"
                            name="CBSecret"
                            min="100"
                            max="999"
                            maxlength="3"
                            required
                            placeholder="ex : 845">
                    </div>
                </div>
            </div>
        </div>
        <a href="?page=monPanier" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
        <button type="submit" class="btn btn-primary">Finaliser la commande</button>
    </div>
</form>
<div class="col-xs-12 col-md-4">
    <h3>Montant TTC à payer aujourd'hui : </h3>
    <h4><?php echo \Nostromo\Classes\Build::formaterEuro($_SESSION['Panier']->getPrixTotalWithRemise()); ?></h4>
    <h5>Dont <?= round((1 - $_SESSION['Panier']->getMultiplicateurRemise()) * 100, 2) ?>% de remise immédiate liée aux points de fidélité.</h5>
</div>
