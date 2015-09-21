<?php

// require_once '../../../model/???.php'

class Index
{
	private $dir;

	public function __construct() {
		if(file_exists(getcwd().'/models/main.php'))
		{
			$this->dir = getcwd().'/';
		}
		elseif(file_exists(getcwd().'../models/main.php'))
		{
			$this->dir = getcwd().'../';
		}
		elseif(file_exists(getcwd().'../../models/main.php'))
		{
			$this->dir = getcwd().'../../';
		}
		elseif(file_exists(getcwd().'../../../models/main.php'))
		{
			$this->dir = getcwd().'../../../';
		}
	}
	public function afficheAccueil() {
		$titre = "Accueil";
		require_once $this->dir.'view/menu.php';
		require_once $this->dir.'view/vue_index.php';
		require_once $this->dir.'view/gabarit.php';
	}
}
