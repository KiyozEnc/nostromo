<?php
require_once "models/m_Connexion.php";
require_once "classes/Vol.classe.php";

class MVol
{
    static public function getVols()
    {
        $lesVols = new Collection();
        try
        {
            $conn = Connexion::getBdd();
            $reqPrepare = $conn->query("SELECT * FROM vol");
            $conn = null;
            $reqPrepare = $reqPrepare->fetchAll();
            foreach ($reqPrepare as $tabVol)
            {
                $unVol = new Vol();
                $unVol
                    ->setNumVol($tabVol['numVol'])
                    ->setDateVol($tabVol['dateVol'])
                    ->setHeureVol($tabVol['heureVol'])
                    ->setNbPlace($tabVol['nbPlace'])
                ;
                $lesVols->ajouter($unVol);
            }
        }
        catch(PDOException $ex)
        {
            throw new Exception("Aucun vol n'est disponible");
        }
        return $lesVols;
    }
    static public function getUnVol($numVol)
    {
        $unVol = new Vol();
        try
        {
            $conn = Connexion::getBdd();
            $reqPrepare = $conn->prepare("SELECT * FROM vol WHERE numVol = ?");
            $reqPrepare->execute(array($numVol));
            $reqPrepare = $reqPrepare->fetch();
            $unVol
                ->setNumVol($reqPrepare['numVol'])
                ->setDateVol($reqPrepare['dateVol'])
                ->setHeureVol($reqPrepare['heureVol'])
                ->setNbPlace($reqPrepare['nbPlace'])
            ;
            $conn = null;
        }
        catch (PDOException $e)
        {
            throw new Exception("Le vol $numVol n'existe pas.");
        }
        return $unVol;
    }
    static public function validReservation(Utilisateur $unClient, Vol $unVol, Reservation $uneReservation)
    {
        try
        {
            $conn = Connexion::getBdd();
            $reqPrepare = $conn->prepare("INSERT INTO reservation (numClt,numVol,dateRes,nbPers) VALUES (?,?,?,?)");
            $reqPrepare->execute(array($unClient->getId(),$unVol->getNumVol(),$uneReservation->getDateRes()->format('Y-m-d H:i:s'),$uneReservation->getNbPers()));
            $conn = null;
        }
        catch (PDOException $e)
        {
            throw new Exception("Vous avez d�j� une r�servation. Veuillez contacter Nostromo pour annuler votre r�servation.");
        }
    }
    static public function reservationExistante(Utilisateur $unClient)
    {
        $uneReservation = new Reservation();
        try
        {
            $conn = Connexion::getBdd();
            $reqPrepare = $conn->prepare("SELECT * FROM reservation WHERE NumClt = ?");
            $reqPrepare->execute(array($unClient->getId()));
            $reqPrepare = $reqPrepare->fetch();
            $unVol = MVol::getUnVol($reqPrepare['numVol']);
            $uneReservation
                ->setId($reqPrepare['numRes'])
                ->setUnVol($unVol)
                ->setUnClient($unClient)
                ->setDateRes($reqPrepare['dateRes'])
                ->setNbPers($reqPrepare['nbPers'])
                ->setValid(true)
            ;
            $conn = null;
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
            throw new Exception("Impossible de récupérer la réservation de $unClient->getMail(), Détails : ".$e->getMessage());
        }
        return $uneReservation;
    }
    static public function getPlaceRestante(Vol $unVol)
    {
        $nbPlace = $unVol->getNbPlace();
        try
        {
            $conn = Connexion::getBdd();
            $reqPrepare = $conn->prepare("SELECT * FROM reservation WHERE numVol = ?");
            $reqPrepare->execute(array($unVol->getNumVol()));
            $reqPrepare = $reqPrepare->fetchAll();
            foreach ($reqPrepare as $tabVol)
            {
                $nbPlace = $nbPlace - $tabVol['nbPers'];
            }
        }
        catch (PDOException $e)
        {
            throw new Exception("Le vol n'existe pas");
        }

        return $nbPlace;
    }
}
