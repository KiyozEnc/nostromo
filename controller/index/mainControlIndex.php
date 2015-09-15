<?php

// require_once '../../../model/???.php'

class Index
{

	public function afficheAccueil() {
		$titre = "Accueil";
		require_once '../../../view/gabarit.php';
		require_once '../../../view/vue_index.php';
	}
}
