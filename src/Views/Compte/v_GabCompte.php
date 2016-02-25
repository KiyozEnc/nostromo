<?php
/**
 * Created by Kiyoz.
 * User : Kiyoz
 * Date : 05/02/2016
 * Time : 16:18.
 */
require_once ROOT.'src/Views/v_Alert.php';

if (array_key_exists('action', $_GET)) {
    $action = $_GET['action'];
} else {
    $action = '';
    if ($action === '' && $_GET['page'] === 'monCompte') {
        $action = 'voirMonCompte';
    }
}
?>
<div class="row row-centered">
    <div class="col-xs-12 col-sm-6 col-centered">
        <ul class="nav nav-pills">
            <li id="home" <?php
            if ($action === 'voirMonCompte') {
                echo 'class="active"';
            } ?>
                role="presentation"><a href="?page=monCompte">Accueil</a></li>
            <li id="infos" <?php
            if ($action === 'edit') {
                echo 'class="active"';
            } ?>
                role="presentation"><a href="?page=monCompte&action=edit">Modifier mes informations</a></li>
            <li id="commandes" <?php
            if ($action === 'voirCommandes') {
                echo 'class="active"';
            } ?>
                role="presentation"><a href="?page=monCompte&action=voirCommandes">Mes commandes</a></li>
        </ul>
        <div class="page-header">
            <h2>Mon compte
                <small><?= $title ?></small>
            </h2>
        </div>
    </div>
</div>