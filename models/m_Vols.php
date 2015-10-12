<?php require_once "models/m_Connexion.php";
require_once "classes/Vol.classe.php";

class MVol
{

	static public function getVols()
	{
		try
		{
			$conn = Connexion::getBdd();
			$reqPrepare = $conn->query("SELECT * FROM vol");
			$conn = null;
			return $reqPrepare->fetchAll(PDO::FETCH_CLASS, "Vol");

		}
		catch(PDOException $ex)
		{
			echo "Aucun vol n'est disponible";
		}
	}
	static public function getUnVol($numVol)
	{
		$conn = Connexion::getBdd();
		$reqPrepare = $conn->prepare("SELECT * FROM vol WHERE numVol = ?");
		$unVol = new Vol();
		$reqPrepare->setFetchMode(PDO::FETCH_INTO, $unVol);
		$reqPrepare->execute(array($numVol));
		$reqPrepare->fetch(PDO::FETCH_INTO);
		$conn = null;
		return $unVol;
	}
}
