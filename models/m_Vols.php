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
    static public function validReservation($numClt,$numVol,$dateRes,$nbPers)
    {
        try
        {
            $conn = Connexion::getBdd();
            $reqPrepare = $conn->prepare("INSERT INTO reservation (numClt,numVol,dateRes,nbPers) VALUES (?,?,?,?)");
            $reqPrepare->execute(array($numClt,$numVol,$dateRes,$nbPers));
            $conn = null;
            return true;
        }
        catch (PDOException $e)
        {
            return false;
        }
    }
    static public function reservationExistante($numClt)
    {
        $conn = Connexion::getBdd();
        $reqPrepare = $conn->prepare("SELECT * FROM reservation WHERE NumClt = ?");
        $reqPrepare->execute(array($numClt));
        $reqPrepare = $reqPrepare->fetch();
        $uneReservation = new Produit($reqPrepare['numVol'],$reqPrepare['nbPers']);
        return $uneReservation;
        $conn = null;
    }
}
