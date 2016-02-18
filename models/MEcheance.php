<?php
/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 18/02/2016
 * Time: 18:41.
 */

namespace Nostromo\Models;

use Nostromo\Classes\Collection;
use Nostromo\Classes\Echeance;
use Nostromo\Classes\Exception\ErrorSQLException;
use Nostromo\Classes\Reservation;

class MEcheance
{
    /**
     * Permet de récupérer les échéance de la Reservation passée en paramètre
     *
     * @param Reservation $reservation
     *
     * @return Collection
     * @throws ErrorSQLException
     * @throws \InvalidArgumentException
     */
    public static function getEcheances(Reservation $reservation)
    {
        $lesEcheance = new Collection();
        try {
            $conn = MConnexion::getBdd();
            $req = $conn->prepare('SELECT * FROM echeance WHERE numRes = ?');
            $req->execute(array($reservation->getId()));
            $fetchAll = $req->fetchAll();
            foreach ($fetchAll as $fetch) {
                $echeance = new Echeance($reservation, $fetch['montant'], new \DateTime($fetch['dateEcheance']));
                $lesEcheance->ajouter($echeance);
            }
        } catch (\PDOException $e) {
            throw new ErrorSQLException($e->getMessage());
        }
        return $lesEcheance;
    }
}
