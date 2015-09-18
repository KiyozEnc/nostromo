<?php

require_once 'main.php';

class Vol extends Main {

	public function getVol($numVol)
	{
		try
		{
			return $this->getBdd()->prepare()->execute()->fetch();
		}
		catch (PDOException $e)
		{
			$error = "Le vol $numVol n'existe pas.";
			return false;
		}
	}

	public function getVols()
	{
		try
		{
			return $this->getBdd()->prepare()->execute();
		}
		catch (PDOException $e)
		{
			$error = "Il y a actuellement aucun vol de prévu.";
			return false;
		}
	}
}
