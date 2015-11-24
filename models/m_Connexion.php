<?php

class Connexion {

	static public function getBdd() {
		try {
			/*$host = "192.168.1.17";
			$dbname = "2014-nostromo_base";
			$user = "2014-nostromo";
			$mdp = "123456";*/
			$host = "localhost";
			$dbname = "2014-nostromo_base";
			$user = "2014-nostromo";
			$mdp = "123456";
			/*$host = "btsinfo-rousseau53.fr:33017";
			$dbname = "2014-nostromo_base";
			$user = "2014-nostromo";
			$mdp = "123456";*/
			$pdo = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8',
				$user, $mdp, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			return $pdo;
		}
		catch (PDOException $ex) {
			echo $ex->getMessage();
		}
	}
	static public function sessionOuverte()
	{
		if(isset($_SESSION['login']))
			return true;
		else
			return false;
	}
	static public function etreAdministrateur()
	{
		if(sessionOuverte())
		{
			if(isset($_SESSION['statut']))
			{
				if($_SESSION['statut'] == 'admin')
					return true;
				else
					return false;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
}
