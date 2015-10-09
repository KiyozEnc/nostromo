<?php

require_once 'main.php';

class Client {

	public function getClient($numClt)
	{
		try
		{
			$req = getBdd()->prepare("SELECT * FROM client WHERE numClt = ?");
			$req->bindParam(":numClt", $numClt);
			$req->execute();
		}
		catch (PDOException $e)
		{
			$error = "Le client $numClt n'existe pas";
			return false;
		}
	}

	public function getClients()
	{
		try
		{
			return getBdd()->prepare("SELECT * FROM client")->execute();
		}
		catch (PDOException $e)
		{
			$error = "Il y a actuellement aucun client.";
			return false;
		}
	}
}
