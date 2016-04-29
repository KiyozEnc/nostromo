<?php

namespace Nostromo\Models;

use Nostromo\Classes\Exception\CollectionException;
use Nostromo\Classes\Exception\ErrorSQLException;
use Nostromo\Classes\Vol;
use Nostromo\Classes\Collection;
use PDOException;

/**
 * Class MVol
 * @package Nostromo\Models
 */
class MVol
{
    /**
     * Récupère tous les vols disponibles (non partis)
     *
     * @return Collection
     *
     * @throws ErrorSQLException
     * @throws CollectionException
     */
    public static function getVols()
    {
        $lesVols = new Collection();
        try {
            $conn = MConnexion::getBdd();
            $reqPrepare = $conn->query('SELECT * FROM vol
                                        WHERE DATE_ADD(CURDATE(), INTERVAL -1 DAY) < dateVol
                                        ORDER BY dateVol')
            ;
            $conn = null;
            $reqPrepare = $reqPrepare->fetchAll();
            foreach ($reqPrepare as $tabVol) {
                $unVol = new Vol();
                $unVol
                    ->setNumVol($tabVol['numVol'])
                    ->setPrice($tabVol['prix'])
                    ->setDateVol($tabVol['dateVol'])
                    ->setHeureVol($tabVol['heureVol'])
                    ->setNbPlace($tabVol['nbPlace']);
                $lesVols->ajouter($unVol);
            }
        } catch (PDOException $ex) {
            throw new ErrorSQLException('Aucun vol n\'est disponible');
        }

        return $lesVols;
    }

    /**
     * Récupère un vol via son numéro $numVol
     *
     * @param $numVol
     *
     * @return Vol
     *
     * @throws ErrorSQLException
     */
    public static function getUnVol($numVol)
    {
        $unVol = new Vol();
        try {
            $conn = MConnexion::getBdd();
            $reqPrepare = $conn->prepare('SELECT * FROM vol WHERE numVol = ?');
            $reqPrepare->execute(array($numVol));
            $reqPrepare = $reqPrepare->fetch();
            $unVol
                ->setNumVol($reqPrepare['numVol'])
                ->setDateVol($reqPrepare['dateVol'])
                ->setHeureVol($reqPrepare['heureVol'])
                ->setNbPlace($reqPrepare['nbPlace'])
                ->setPrice($reqPrepare['prix']);
            $conn = null;
        } catch (PDOException $e) {
            throw new ErrorSQLException("Le vol $numVol n'existe pas.");
        }

        return $unVol;
    }


    /**
     * Récupère le nombre de place restante d'un vol
     *
     * @param Vol $unVol
     *
     * @return int
     *
     * @throws ErrorSQLException
     */
    public static function getPlaceRestante(Vol $unVol)
    {
        $nbPlace = $unVol->getNbPlace();
        try {
            $conn = MConnexion::getBdd();
            $reqPrepare = $conn->prepare('SELECT * FROM reservation WHERE numVol = ?');
            $reqPrepare->execute(array($unVol->getNumVol()));
            $reqPrepare = $reqPrepare->fetchAll();
            foreach ($reqPrepare as $tabVol) {
                $nbPlace -= $tabVol['nbPers'];
            }
        } catch (PDOException $e) {
            throw new ErrorSQLException('Le vol n\'existe pas');
        }

        return $nbPlace;
    }

    /**
     * Récupère le temps avant qu'un vol ne parte
     *
     * @param Vol $unVol
     *
     * @return string
     *
     * @throws ErrorSQLException
     * @throws InvalidArgumentException
     */
    public static function getTimer(Vol $unVol)
    {
        if (null === $unVol) {
            throw new InvalidArgumentException('Le vol ne peut pas être null');
        }
        try {
            $conn = MConnexion::getBdd();
            $req = $conn->prepare('SELECT * FROM vol WHERE dateVol = ?');
            $req->execute([$unVol->getNonFormatDate()]);
            $fetch = $req->fetch();
            $tmp = new \DateTime($fetch['dateVol'].' '.$fetch['heureVol']);
            $tmp->modify('-1 months');
            return $tmp->format('Y, m, d, H, i, s');
        } catch (PDOException $e) {
            throw new ErrorSQLException($e->getMessage());
        }
    }
}
