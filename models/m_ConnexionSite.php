<?php require_once "models/m_Connexion.php";


class ConnexionSite
{

	static public function getUser($email)
	{
		try
		{
			$conn = Connexion::getBdd();
			$reqPrepare = $conn->prepare("SELECT * FROM client WHERE mailClt = ?");
			$reqPrepare->execute(array($email));
			$conn = null;
			return $reqPrepare->fetch();

		}
		catch(PDOException $ex)
		{
			echo "Aucun utilisateur n'existe sous cette adresse e-mail.";
		}
	}
	static public function setAjoutUser($nom,$pren,$adr,$cp,$ville,$mdp,$mail)
	{
		try
		{
			$mdp = sha1($mdp);
			$conn = Connexion::getBdd();
			$reqprepare2=$conn->prepare("INSERT INTO client (nomClt, prenomClt, adresseClt, cpClt, villeClt, mdpClt, mailClt, pointsClt) VALUES (?,?,?,?,?,?,?,?)");
			$reqprepare2->execute(array($nom,$pren,$adr,$cp,$ville,$mdp,$mail,0));
			$conn = null;
			return true;
		}
		catch (PDOException $ex)
		{
			echo "Erreur : (User already exists), merci de contacter un administrateur.";
		}
	}
}
