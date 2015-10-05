<?php

// require_once '../../../model/???.php'

class Connexion
{

	public function afficheAccueil() {
		$titre = "Accueil";
		require_once '../../../view/gabarit.php';
		require_once '../../../view/connexion/vue_connexion.php';
	}
}
