<?php
/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 21/02/2016
 * Time: 12:02
 */
namespace Nostromo\Models;

use InvalidArgumentException;
use Nostromo\Classes\Collection;
use Nostromo\Classes\Echeance;
use Nostromo\Classes\Exception\ErrorSQLException;
use Nostromo\Classes\Reservation;
use Nostromo\Classes\Utilisateur;
use Nostromo\Classes\Vol;
use PDOException;

class MReservation
{
    /**
     * @param Utilisateur $unClient
     * @param Vol         $unVol
     * @param Reservation $uneReservation
     *
     * @throws \InvalidArgumentException
     * @throws ErrorSQLException
     */
    public static function validerReservation(Utilisateur $unClient, Vol $unVol, Reservation $uneReservation)
    {
        $conn = MConnexion::getBdd();
        try {
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare('INSERT INTO reservation (numClt,numVol,dateRes,nbPers) VALUES (?,?,?,?)');
            $reqPrepare->execute(
                array(
                    $unClient->getId(),
                    $unVol->getNumVol(),
                    $uneReservation->getDateRes()->format('Y-m-d H:i:s'),
                    $uneReservation->getNbPers(),)
            );
            $conn->commit();
            $uneReservation->setValid(true);
            $conn->beginTransaction();
            $lesEcheances = new Collection();
            $uneAutreReservation = self::getReservationClient($unClient);
            if (array_key_exists('type', $_GET)) {
                if ($_GET['type'] === '3fois') {
                    $echeance = new Echeance(
                        $uneAutreReservation,
                        $uneAutreReservation->getFirstEcheancePrice(),
                        new \DateTime()
                    );
                    MEcheance::addEcheance($echeance);
                    $lesEcheances->ajouter($echeance);
                    $echeance = new Echeance(
                        $uneAutreReservation,
                        $uneAutreReservation->getOtherEcheancePrice(),
                        new \DateTime('+1 months +1 days')
                    );
                    MEcheance::addEcheance($echeance);
                    $lesEcheances->ajouter($echeance);
                    $echeance = new Echeance(
                        $uneAutreReservation,
                        $uneAutreReservation->getOtherEcheancePrice(),
                        new \DateTime('+2 months +1 days')
                    );
                    MEcheance::addEcheance($echeance);
                    $lesEcheances->ajouter($echeance);
                } else {
                    $echeance = new Echeance(
                        $uneAutreReservation,
                        $uneAutreReservation->getPriceReservation(),
                        new \DateTime()
                    );
                    MEcheance::addEcheance($echeance);
                    $lesEcheances->ajouter($echeance);
                }
            }
            $conn->commit();
            $uneReservation->setLesEcheance($lesEcheances);
            $conn = null;
        } catch (PDOException $e) {
            $conn->rollBack();
            $uneReservation->setValid(false);
            throw new ErrorSQLException(
                'Vous avez déjà une réservation.
                Veuillez contacter Nostromo pour annuler votre réservation.'
            );
        }
    }

    /**
     * @param Utilisateur $unClient
     *
     * @return Reservation
     *
     * @throws InvalidArgumentException
     * @throws ErrorSQLException
     */
    public static function getReservationClient(Utilisateur $unClient)
    {
        $uneReservation = new Reservation();
        try {
            $conn = MConnexion::getBdd();
            $reqPrepare = $conn->prepare('SELECT numVol, reservation.numRes, dateRes, nbPers, montant, dateEcheance FROM reservation LEFT JOIN echeance ON reservation.numRes = echeance.numRes WHERE NumClt = ?');
            $reqPrepare->execute(array($unClient->getId()));
            $reqPrepare = $reqPrepare->fetch();
            $unVol = MVol::getUnVol($reqPrepare['numVol']);
            $uneReservation
                ->setId($reqPrepare['numRes'])
                ->setUnVol($unVol)
                ->setUnClient($unClient)
                ->setDateRes($reqPrepare['dateRes'])
                ->setNbPers($reqPrepare['nbPers'])
                ->setValid(true);
            $lesEcheances = MEcheance::getEcheances($uneReservation);
            $uneReservation->setLesEcheance($lesEcheances);
            $conn = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
            throw new ErrorSQLException(
                'Impossible de récupérer la réservation de ' . $unClient->getMail()
                . ' Détails : ' . $e->getMessage()
            );
        }
        return $uneReservation;
    }
}