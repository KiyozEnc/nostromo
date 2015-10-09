<?php require_once "models/m_Connexion.php";


class Vol
{

	static public function getVols()
	{
		try
		{
			$conn = Connexion::getBdd();
			$reqPrepare = $conn->query("SELECT * FROM vol");
			$conn = null;
			return $reqPrepare->fetchAll();

		}
		catch(PDOException $ex)
		{
			echo "Aucun vol n'est disponible";
		}
	}
	static public function getUnVol($codeVol)
	{
		$conn = Connexion::getBdd();
		$reqPrepare = $conn->prepare("SELECT * FROM vol WHERE codeVol = ?");
		$reqPrepare->execute(array($codeVol));
		$conn = null;
		return $reqPrepare->fetch();
	}
	static public function setAjoutVol($code, $date, $heure, $nbPlace)
	{
		$conn = Connexion::getBdd();
		$reqprepare2=$conn->prepare("INSERT INTO vol (codeVol, dateVol, heureVol, nbPlace) VALUES (?,?,?,?)");
		$reqprepare2->execute(array($code,$date,$heure,$nbPlace));
		$conn = null;
		return true;
	}
}
