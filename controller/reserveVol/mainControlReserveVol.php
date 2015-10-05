<?php

// require_once '../../../model/???.php'

class ReserveVol
{

	public function afficheAccueil() {
		$titre = "Accueil";
		require_once '../../../view/gabarit.php';
		require_once '../../../view/connexion/vue_reserveVol.php';
	}
}
