<?php
require_once "models/m_Connexion.php";
class ConnexionSite
{
    /**
     * @param string $email
     * @return Utilisateur
     * @throws Exception
     */
    static public function getUser($email)
    {
        $unClient = new Utilisateur();
        try
        {
            $conn = Connexion::getBdd();
            $reqPrepare = $conn->prepare("SELECT * FROM client WHERE mailClt = ?");
            $reqPrepare->setFetchMode(PDO::FETCH_INTO, $unClient);
            $reqPrepare->execute(array($email));
            $reqPrepare->fetch(PDO::FETCH_INTO);
            $conn = null;
        }
        catch(PDOException $ex)
        {
            throw new Exception("L'utilisateur avec l'adresse mail '$email' n'existe pas.");
        }
        return $unClient;
    }

    /**
     * @param Utilisateur $unClient
     * @throws Exception
     */
    static public function setAjoutUser(Utilisateur $unClient)
    {
        try
        {
            $conn = Connexion::getBdd();
            $reqprepare2=$conn->prepare("INSERT INTO client (nomClt, prenomClt, adresseClt, cpClt, villeClt, mdpClt, mailClt, pointsClt) VALUES (?,?,?,?,?,?,?,?)");
            $reqprepare2->execute(array(
                    $unClient->getNom(),
                    $unClient->getPrenom(),
                    $unClient->getAdresse(),
                    $unClient->getCp(),
                    $unClient->getVille(),
                    $unClient->getMdp(),
                    $unClient->getMail(),
                    $unClient->getPoints())
            );
            $conn = null;
        }
        catch (PDOException $ex)
        {
            throw new Exception("Erreur : (User already exists), merci de contacter un administrateur.");
        }
    }
}
