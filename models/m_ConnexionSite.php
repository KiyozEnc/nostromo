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
            $reqPrepare->execute(array($email));
            $reqPrepare = $reqPrepare->fetch();
            $unClient
                ->setId($reqPrepare['numClt'])
                ->setNom($reqPrepare['nomClt'])
                ->setPrenom($reqPrepare['prenomClt'])
                ->setAdresse($reqPrepare['adresseClt'])
                ->setCp($reqPrepare['cpClt'])
                ->setVille($reqPrepare['villeClt'])
                ->setMdp($reqPrepare['mdpClt'])
                ->setMail($reqPrepare['mailClt'])
                ->setPoints($reqPrepare['pointsClt'])
            ;
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
            throw new Exception("Erreur interne (Error code 1) :  merci de contacter un administrateur.");
        }
    }
}
