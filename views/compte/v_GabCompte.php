<?php
/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 05/02/2016
 * Time: 16:18
 */

if (array_key_exists('action', $_GET)) {
    $action = $_GET['action'];
} else {
    $action = '';
    if ($_GET['uc'] === 'monCompte' && $action === '') {
        $action = 'voirMonCompte';
    }
}
?>
<ul class="nav nav-pills">
    <li id="home" <?php
    if ($action === 'voirMonCompte') {
        echo 'class="active"';
    } ?>
        role="presentation"><a href="?uc=monCompte">Accueil</a></li>
    <li id="infos" <?php
    if ($action === 'edit') {
        echo 'class="active"';
    } ?>
        role="presentation"><a href="?uc=monCompte&action=edit">Modifier mes informations</a></li>
    <li id="commandes" <?php
    if ($action === 'voirCommandes') {
        echo 'class="active"';
    } ?>
        role="presentation"><a href="?uc=monCompte&action=voirCommandes">Mes commandes</a></li>
</ul>
<div class="page-header">
    <h2>Mon compte
        <small><?= $title ?></small>
    </h2>
</div>
