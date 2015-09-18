<?php

require_once 'main.php';

class Client extends Main {

	public function getClient($numClt)
	{
		try
		{
			return $this->getBdd()->prepare()->execute()->fetch();
		}
		catch (PDOException $e)
		{
			$error = "Le client $numClt n'est pas";
			return false;
		}
	}

	public function getClients()
	{
		try
		{
			return $this->getBdd()->prepare()->execute();
		}
		catch (PDOException $e)
		{
			$error = "Il y a actuellement aucun client.";
			return false;
		}
	}
}
