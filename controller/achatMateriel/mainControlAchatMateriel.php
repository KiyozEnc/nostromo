<?php

// require_once '../../../model/???.php'

class AchatMateriel
{

	public function afficheAccueil() {
		$titre = "Accueil";
		require_once '../../../view/gabarit.php';
		require_once '../../../view/achatMateriel/vue_achatMateriel.php';
	}
}
