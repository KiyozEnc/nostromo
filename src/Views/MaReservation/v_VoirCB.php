<?php
use Nostromo\Classes\Build;

require_once ROOT.'src/Views/v_Alert.php'; ?>

    <h2>Mode de paiement</h2>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <ul class="nav nav-pills">
                <li <?php
                if (array_key_exists('type', $_GET) && $_GET['type'] === 'comptant') {
                    echo 'class="active"';
                }
                ?>><a href="?page=maReservation&action=payment&type=comptant">Paiement comptant</a></li>
                <li <?php
                if (array_key_exists('type', $_GET) && $_GET['type'] === '3fois') {
                    echo 'class="active"';
                }
                ?>><a href="?page=maReservation&action=payment&type=3fois">Paiement en trois fois</a></li>
            </ul>
        </div>
    </div>
<?php
if ($_SESSION['Reservation']->getReduction() === 0 || $_SESSION['Reservation']->getReduction() === null) {
    echo '<br><p>Vous avez choisi de ne pas appliquer vos points de fidélité</p>';
} else {
    echo '<br>
            <p>Vous avez  choisi d\'utiliser '.$_SESSION['Reservation']->getReduction().'
                points de fidélité (soit '.$_SESSION['Reservation']->getPercentReduction().'% de réduction)
            </p>';
}
if (!array_key_exists('type', $_GET)) { ?>
    <div class="row">
        <div class="col-xs-12 col-md-6"><small>Veuillez choisir un mode de paiement.</small></div>
    </div>
    <?php
}

if (array_key_exists('type', $_GET)) {
    if ($_GET['type'] === 'comptant') { ?>
        <br>
        <div class="row">
            <div class="col-xs-12 col-md-4">
                <form action="?page=maReservation&action=payment&type=comptant" method="post" role="form" autocomplete="off">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <label>Nom du titulaire de la carte</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="CBName"
                                    placeholder="Nom du titulaire"
                                    maxlength="50"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <label>Numéro de carte (16 chiffres)</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="CBNumber"
                                    placeholder="16 chiffres de votre carte bancaire"
                                    maxlength="16"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6 col-md-4">
                                <label for="CBMonth">Mois d'expiration</label>
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
                            <div class="col-xs-6 col-md-4">
                                <label for="CBYear">et Année</label>
                                <select name="CBYear" class="form-control" required>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                </select>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <label for="CBSecret">CVC</label>
                                <input
                                    placeholder="Ex : 486"
                                    maxlength="3"
                                    name="CBSecret"
                                    type="text"
                                    class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
            </div>
            <div class="col-xs-12 col-md-4">
                <h2>Total TTC <small>paiement comptant</small></h2>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <?php echo
                            Build::formaterEuro($_SESSION['Reservation']->getPriceReservation()); ?>
                        - aujourd'hui
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        Dont <?= Build::formaterEuro($_SESSION['Reservation']->getPriceRemise()); ?> de remise lié aux points de fidélité.
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else { ?>
        <br>
        <div class="row">
            <div class="col-xs-12 col-md-4">
                <form action="?page=maReservation&action=payment&type=3fois" method="post" role="form" autocomplete="off">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <label>Nom du titulaire de la carte</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="CBName"
                                    placeholder="Nom du titulaire"
                                    maxlength="50"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <label>Numéro de carte (16 chiffres)</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="CBNumber"
                                    placeholder="16 chiffres de votre carte bancaire"
                                    maxlength="16"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6 col-md-4">
                                <label for="CBMonth">Mois d'expiration</label>
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
                            <div class="col-xs-6 col-md-4">
                                <label for="CBYear">et Année</label>
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
                            <div class="col-xs-12 col-md-4">
                                <label for="CBSecret">CVC</label>
                                <input
                                    placeholder="Ex : 486"
                                    name="CBSecret"
                                    maxlength="3"
                                    type="text"
                                    class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
                <h5 class="text-center">
                    <small>
                        Votre carte devra être valide au
                        moins pendant 3 mois pour le paiement en plusieurs fois.
                    </small>
                </h5>
            </div>
            <div class="col-xs-12 col-md-4">
                <h2>Échéances <small>paiement en plusieurs fois</small></h2>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <?php echo
                                Build::formaterEuro($_SESSION['Reservation']->getFirstEcheancePrice()); ?>
                        - aujourd'hui (<?php echo $_SESSION['Reservation']->getInteret().' supplémentaires'; ?>)
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <?php echo
                                Build::formaterEuro($_SESSION['Reservation']->getOtherEcheancePrice()); ?>
                        - le <?php echo Build::formaterDateTimeWithDate($_SESSION['Reservation']->getDateEcheance(1)); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <?php echo
                                Build::formaterEuro($_SESSION['Reservation']->getOtherEcheancePrice()); ?>
                        - le <?php echo Build::formaterDateTimeWithDate($_SESSION['Reservation']->getDateEcheance(2)); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        Dont <?= Build::formaterEuro($_SESSION['Reservation']->getPriceRemise()); ?> de remise lié aux points de fidélité.
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
