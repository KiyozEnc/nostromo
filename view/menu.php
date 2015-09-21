<?php ob_start(); ?>

<a href="/nostromo/" class="col-lg-2 sousMenu" >Réservation de vol</a>
<a href="/nostromo/" class="col-lg-2 sousMenu" >Achat de materiels</a>
<a href="/nostromo/" class="col-lg-2 sousMenu" >A propos</a>
<?php
if(isset($_SESSION['login']))
	{ ?>
<a href="/nostromo/" class="col-lg-2 sousMenu" >Déconnexion</a>
<? }
else
	{ ?>

<a href="/nostromo/view/inscription/vue_inscription" class="col-lg-2 sousMenu" >Inscription</a>
<a href="/nostromo/view/connexion/vue_connexion" class="col-lg-2 sousMenu" >Connexion</a>

<? } ?>

<?php $menu = ob_get_clean(); ?>
