<?php

/**
 * Est une réservation d'un vol
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
     * @var boolean
     */
    private $valid = false;

    public function __construct()
    {
        $this->dateRes = new \DateTime();
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
     * @return Reservation
     */
    public function setNbPers($nbPers)
    {
        $this->nbPers = (int) $nbPers;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isValid()
    {
        return $this->valid;
    }

    /**
     * @param boolean $valid
     * @return Reservation
     */
    public function setValid($valid)
    {
        $this->valid = (boolean) $valid;

        return $this;
    }

    public function flushValid()
    {
        MVol::validReservation($this->unClient,$this->unVol,$this);
    }

}