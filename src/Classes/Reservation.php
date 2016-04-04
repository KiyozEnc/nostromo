<?php

namespace Nostromo\Classes;

use \DateTime;
use Nostromo\Models\MReservation;
use Nostromo\Classes\Exception\ErrorSQLException;

/**
 * Est une réservation d'un vol.
 *
 * Class Reservation
 */
class Reservation
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var Utilisateur
     */
    private $unClient;
    /**
     * @var Vol
     */
    private $unVol;
    /**
     * @var \DateTime
     */
    private $dateRes;
    /**
     * @var int
     */
    private $nbPers;
    /**
     * @var bool
     */
    private $valid = false;
    /**
     * @var Collection
     */
    private $lesEcheance;
    /**
     * @var float
     */
    private $reduction;

    const INTERET = 0.0140;

    /**
     * Reservation constructor.
     */
    public function __construct()
    {
        $this->dateRes = new \DateTime();
        $this->lesEcheance = new Collection();
        $this->reduction = 0;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Reservation
     */
    public function setId($id)
    {
        $this->id = (int) $id;

        return $this;
    }

    /**
     * @return Vol
     */
    public function getUnVol()
    {
        return $this->unVol;
    }

    /**
     * @param Vol $unVol
     *
     * @return Reservation
     */
    public function setUnVol($unVol)
    {
        $this->unVol = $unVol;

        return $this;
    }

    /**
     * @return Utilisateur
     */
    public function getUnClient()
    {
        return $this->unClient;
    }

    /**
     * @param Utilisateur $unClient
     *
     * @return Reservation
     */
    public function setUnClient($unClient)
    {
        $this->unClient = $unClient;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateRes()
    {
        return $this->dateRes;
    }

    /**
     * @param \DateTime $dateRes
     *
     * @return Reservation
     */
    public function setDateRes($dateRes)
    {
        $this->dateRes = DateTime::createFromFormat('Y-m-d H:i:s', $dateRes);

        return $this;
    }

    /**
     * @return int
     */
    public function getNbPers()
    {
        return $this->nbPers;
    }

    /**
     * @param int $nbPers
     *
     * @return Reservation
     */
    public function setNbPers($nbPers)
    {
        $this->nbPers = (int) $nbPers;

        return $this;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->valid;
    }

    /**
     * @param bool $valid
     *
     * @return Reservation
     */
    public function setValid($valid)
    {
        $this->valid = (boolean) $valid;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getLesEcheance()
    {
        return $this->lesEcheance;
    }

    /**
     * @param Collection $lesEcheance
     *
     * @return Reservation
     */
    public function setLesEcheance($lesEcheance)
    {
        $this->lesEcheance = $lesEcheance;

        return $this;
    }

    /**
     * Valide la réservation en l'enregistrant dans la base de données
     *
     * @throws ErrorSQLException
     * @throws \InvalidArgumentException
     */
    public function flushValid()
    {
        MReservation::validerReservation(
            $this->unClient,
            $this->unVol,
            $this
        );
    }

    /**
     * Récupère le prix de la réservation
     *
     * @return int
     */
    public function getPriceReservation()
    {
        $reduc = 1;
        for ($i = 0; $i <= $this->reduction - 75; $i += 75) {
            $reduc -= 0.025;
        }
        if ($this->reduction < 75) {
            $reduc = 1;
        }
        return ($this->unVol->getPrice()*$this->nbPers)*$reduc;
    }

    /**
     * Récupère la date des échéances en + $months
     *
     * @param $months
     * @return DateTime
     */
    public function getDateEcheance($months)
    {
        return new \DateTime('+'.$months.' months +1 day');
    }

    /**
     * Récupère les intérêts du paiement en plusieurs fois en pourcentage
     *
     * @return string
     */
    public function getInteret()
    {
        return round(self::INTERET*100, 2).'%';
    }

    /**
     * Récupère le prix de la première échéance
     *
     * @return float
     */
    public function getFirstEcheancePrice()
    {
        return ($this->getPriceReservation()/3)*(1+self::INTERET);
    }

    /**
     * Récupère le prix des autres échéances que la première
     *
     * @return float
     */
    public function getOtherEcheancePrice()
    {
        return $this->getPriceReservation()/3;
    }

    /**
     * Récupère le nombre d'échéances de la réservation
     *
     * @return int
     */
    public function getNbEcheance()
    {
        return $this->lesEcheance->taille();
    }

    /**
     * @return float
     */
    public function getReduction()
    {
        return $this->reduction;
    }

    /**
     * @param float $reduction
     * @return Reservation
     */
    public function setReduction($reduction)
    {
        $this->reduction = $reduction;
        return $this;
    }
}
