<?php
require_once ROOT.'src/Views/v_Alert.php'; ?>
<p>Validation de Votre Commande</p>

            <div class="col-xs-12 col-sm-4">

<div class="form-group">
    <label for="">Nom du titulaire de la carte</label>
    <input type="nomTitulaire" class="form-control" id="nomTitulaire" name="nomTitulaire" placeholder="François Dupont" required>

</div>

<div class="form-group">
    <label for="">Numéro de votre carte</label>
    <input type="numCarte" class="form-control" id="numCarte" name="numCarte" placeholder="0000000000000000" maxlength="16" required>

</div>

<div class="form-group">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6 col-sm-4">
                                <label>Mois</label>
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
                            <div class="col-xs-6 col-sm-4">
                                <label>Année</label>
                                <select name="CBYear" class="form-control" required>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                </select>
                            </div>
                        </div>
                    </div>
    <label for="">Date d'expiration</label><br>
</div>
<a href ="?page=monPanier&action=enregistrerPanier" class="btn btn-primary">Finaliser la commande</a>
<a href="?page=monPanier" class="btn btn-primary">Retour</a>
</div>
