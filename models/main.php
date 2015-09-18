<?php

class Main {

	private $pdo;

	public function getBdd() {
		try {
			$this->pdo = new PDO();
		}
		catch (PDOException $e) {
			echo 'Erreur inconnue lors du traitement, veuillez contacter l\'administrateur.';
		}
	}
}
