<?php
use Nostromo\Classes\Build;

require_once ROOT.'views/v_Alert.php'; ?>

    <h2>Mode de paiement</h2>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <ul class="nav nav-pills">
                <li <?php
                if (array_key_exists('type', $_GET)) {
                    if ($_GET['type'] === 'comptant') {
                        echo 'class="active"';
                    }
                }
                ?>><a href="?page=maReservation&action=payment&type=comptant">Paiement comptant</a></li>
                <li <?php
                if (array_key_exists('type', $_GET)) {
                    if ($_GET['type'] === '3fois') {
                        echo 'class="active"';
                    }
                }
                ?>><a href="?page=maReservation&action=payment&type=3fois">Paiement en trois fois</a></li>
            </ul>
        </div>
    </div>
<?php
if (!array_key_exists('type', $_GET)) { ?>
    <div class="row">
        <div class="col-xs-12 col-sm-6"><small>Veuillez choisir un mode de paiement.</small></div>
    </div>
    <?php
} ?>
<?php
if (array_key_exists('type', $_GET)) {
    if ($_GET['type'] === 'comptant') { ?>
        <br>
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <form action="?page=maReservation&action=payment&type=comptant" method="post" role="form" autocomplete="off">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <label>Nom du titulaire de la carte</label>
                                <input type="text" class="form-control" name="CBName" placeholder="Nom du titulaire" maxlength="50" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <label>Numéro de carte (16 chiffres)</label>
                                <input type="text" class="form-control" name="CBNumber" placeholder="16 chiffres de votre carte bancaire" maxlength="16" required>
                            </div>
                        </div>
                    </div>
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
                            <div class="col-xs-12 col-sm-4">
                                <label>CVC</label>
                                <input name="CBSecret" type="number" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
            </div>
            <div class="col-xs-12 col-sm-4">
                <h2>Total TTC <small>paiement comptant</small></h2>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <?php echo
                            number_format($_SESSION['Reservation']->getPriceReservation(), 2, ',', ' ').' €'; ?>
                        - le jour de la réservation
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else { ?>
        <br>
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <form action="?page=maReservation&action=payment&type=3fois" method="post" role="form" autocomplete="off">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <label>Nom du titulaire de la carte</label>
                                <input type="text" class="form-control" name="CBName" placeholder="Nom du titulaire" maxlength="50" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <label>Numéro de carte (16 chiffres)</label>
                                <input type="text" class="form-control" name="CBNumber" placeholder="16 chiffres de votre carte bancaire" maxlength="16" required>
                            </div>
                        </div>
                    </div>
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
                            <div class="col-xs-12 col-sm-4">
                                <label>CVC</label>
                                <input name="CBSecret" type="number" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
            </div>
            <div class="col-xs-12 col-sm-4">
                <h2>Échéances <small>paiement en plusieurs fois</small></h2>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <?php echo
                                Build::formaterEuro($_SESSION['Reservation']->getFirstEcheancePrice()); ?>
                        - aujourd'hui (<?php echo $_SESSION['Reservation']->getInteret().' supplémentaires'; ?>)
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <?php echo
                                Build::formaterEuro($_SESSION['Reservation']->getOtherEcheancePrice()); ?>
                        - le <?php echo Build::formaterDateTimeWithDate($_SESSION['Reservation']->getDateEcheance(1)); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <?php echo
                                Build::formaterEuro($_SESSION['Reservation']->getOtherEcheancePrice()); ?>
                        - le <?php echo Build::formaterDateTimeWithDate($_SESSION['Reservation']->getDateEcheance(2)); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}