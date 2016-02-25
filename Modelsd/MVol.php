<?php

namespace Nostromo\Models;

use Nostromo\Classes\Echeance;
use Nostromo\Classes\Exception\ErrorSQLException;
use Nostromo\Classes\Vol;
use Nostromo\Classes\Collection;
use Nostromo\Classes\Utilisateur;
use Nostromo\Classes\Reservation;
use InvalidArgumentException;
use PDOException;

/**
 * Class MVol.
 *
 * @category Models
 *
 * @author   Nostromo <contact@nostromo.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @link     localhost
 */
class MVol
{
    /**
     * @return Collection
     *
     * @throws InvalidArgumentException
     */
    public static function getVols()
    {
        $lesVols = new Collection();
        try {
            $conn = MConnexion::getBdd();
            $reqPrepare = $conn->query('SELECT * FROM vol
                                        WHERE DATE_ADD(CURDATE(), INTERVAL -1 DAY) < dateVol
                                        ORDER BY dateVol DESC')
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
            throw new InvalidArgumentException('Aucun vol n\'est disponible');
        }

        return $lesVols;
    }

    /**
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
     * @param Vol $unVol
     *
     * @return int
     *
     * @throws InvalidArgumentException
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
            throw new InvalidArgumentException('Le vol n\'existe pas');
        }

        return $nbPlace;
    }
}
