<?php

namespace Nostromo\Classes;

use \DateTime;
use Nostromo\Models\MVol;

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

    const INTERET = 0.0674;

    /**
     * Reservation constructor.
     */
    public function __construct()
    {
        $this->dateRes = new \DateTime();
        $this->lesEcheance = new Collection();
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

    public function flushValid()
    {
        MVol::validReservation(
            $this->unClient,
            $this->unVol,
            $this
        );
    }

    public function getPriceReservation()
    {
        return $this->unVol->getPrice()*$this->nbPers;
    }

    public function getDateEcheance($months)
    {
        return new \DateTime('+'.$months.' months +1 day');
    }

    public function getPercentInteret()
    {
        return round(self::INTERET, 2).'%';
    }
}
