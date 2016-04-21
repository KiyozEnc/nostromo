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
    const STEP_POINTS = 25;
    const STEP_REDUCTION = 0.025;

    /**
     * Reservation constructor.
     */
    public function __construct()
    {
        $this->dateRes = new \DateTime();
        $this->lesEcheance = new Collection();
        $this->reduction = (float) 0;
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
     * Récupère le prix de la réservation (comprend la remise lié aux points)
     *
     * @return int
     */
    public function getPriceReservation()
    {
        $reduc = 1;
        for ($i = 0; $i <= $this->reduction - self::STEP_POINTS; $i += self::STEP_POINTS) {
            $reduc -= self::STEP_REDUCTION;
        }
        if ($this->reduction < self::STEP_POINTS) {
            $reduc = 1;
        }
        return ($this->unVol->getPrice()*$this->nbPers)*$reduc;
    }

    /**
     * Retourne le montant de la remise
     *
     * @return float
     */
    public function getPriceRemise()
    {
        return ($this->nbPers * $this->getUnVol()->getPrice()) - $this->getPriceReservation();
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

    public function getPercentReduction()
    {
        $percent = (float) 0;
        for ($i = 0; $i < $this->reduction; $i += self::STEP_POINTS) {
            $percent += self::STEP_REDUCTION;
        }
        return $percent * 100;
    }
}
