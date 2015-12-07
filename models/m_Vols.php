<?php
require_once "models/m_Connexion.php";
require_once "classes/Vol.classe.php";
require_once "classes/produit.classe.php";

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
            throw new Exception("Aucun vol n'est disponible");
        }
    }
    static public function getUnVol($numVol)
    {
        $unVol = new Vol();
        try
        {
            $conn = Connexion::getBdd();
            $reqPrepare = $conn->prepare("SELECT * FROM vol WHERE numVol = ?");
            $reqPrepare->setFetchMode(PDO::FETCH_INTO, $unVol);
            $reqPrepare->execute(array($numVol));
            $reqPrepare->fetch(PDO::FETCH_INTO);
            $conn = null;
        }
        catch (PDOException $e)
        {
            throw new Exception("Le vol $numVol n'existe pas.");
        }
        return $unVol;
    }
    static public function validReservation(Utilisateur $unClient,Vol $unVol, Reservation $uneReservation)
    {
        try
        {
            $conn = Connexion::getBdd();
            $reqPrepare = $conn->prepare("INSERT INTO reservation (numClt,numVol,dateRes,nbPers) VALUES (?,?,?,?)");
            $reqPrepare->execute(array($unClient->getId(),$unVol->getNumVol(),$uneReservation->getDateRes(),$uneReservation->getNbPers()));
            $conn = null;
        }
        catch (PDOException $e)
        {
            throw new Exception("Vous avez déjà une réservation. Veuillez contacter Nostromo pour annuler votre réservation.");
        }
    }
    static public function reservationExistante(Utilisateur $unClient)
    {
        $uneReservation = new Reservation();
        try
        {
            $conn = Connexion::getBdd();
            $reqPrepare = $conn->prepare("SELECT * FROM reservation WHERE NumClt = ?");
            $reqPrepare->setFetchMode(PDO::FETCH_INTO, $uneReservation);
            $reqPrepare->execute(array($unClient->getId()));
            $reqPrepare->fetch(PDO::FETCH_INTO);
            $uneReservation->setValid(true);
            $uneReservation->setUnClient($unClient);
            $unVol = MVol::getUnVol($reqPrepare['numVol']);
            $uneReservation->setUnVol($unVol);
            $conn = null;
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
            //throw new Exception("L'utilisateur $unClient->getId() n'a pas de réservation");
        }
        return $uneReservation;
    }
}
