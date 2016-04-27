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
use Nostromo\Classes\Exception\CollectionException;
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
     *
     * @throws ErrorSQLException
     * @throws CollectionException
     */
    public static function getEcheances(Reservation $reservation)
    {
        $lesEcheance = new Collection();
        try {
            $conn = MConnexion::getBdd();
            $req = $conn->prepare('SELECT * FROM echeance WHERE numRes = ?');
            $req->execute([$reservation->getId()]);
            $fetchAll = $req->fetchAll();
            foreach ($fetchAll as $fetch) {
                $echeance = new Echeance($reservation, $fetch['montant'], new \DateTime($fetch['dateEcheance']));
                $echeance->setId($fetch['id']);
                $lesEcheance->ajouter($echeance);
            }
        } catch (\PDOException $e) {
            throw new ErrorSQLException($e->getMessage());
        }
        return $lesEcheance;
    }

    /**
     * Ajoute une échéance à la réservation de l'échéance
     *
     * @param Echeance $echeance
     * @throws ErrorSQLException
     */
    public static function addEcheance(Echeance $echeance)
    {
        $conn = MConnexion::getBdd();
        try {
            $conn->beginTransaction();
            $req = $conn->prepare('INSERT INTO echeance (numRes, montant, dateEcheance) VALUES (?,?,?)');
            $req->execute([
                $echeance->getReservation()->getId(),
                $echeance->getMontant(),
                $echeance->getDate()->format('Y-m-d H:i:s')])
            ;
            $conn->commit();
        } catch (\PDOException $e) {
            $conn->rollBack();
            throw new ErrorSQLException($e->getMessage());
        }
    }
}
