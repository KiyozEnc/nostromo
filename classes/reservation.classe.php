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
     * @var DateTime
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

    public function Vol()
    {
        $this->dateRes = new DateTime();
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
     */
    public function setId($id)
    {
        $this->id = $id;
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
     */
    public function setUnVol($unVol)
    {
        $this->unVol = $unVol;
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
     */
    public function setUnClient($unClient)
    {
        $this->unClient = $unClient;
    }

    /**
     * @return DateTime
     */
    public function getDateRes()
    {
        return $this->dateRes;
    }

    /**
     * @param DateTime $dateRes
     */
    public function setDateRes($dateRes)
    {
        $this->dateRes = $dateRes;
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
     */
    public function setNbPers($nbPers)
    {
        $this->nbPers = $nbPers;
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
     */
    public function setValid($valid)
    {
        $this->valid = $valid;
    }

    public function flushValid()
    {
        MVol::validReservation($this->unClient,$this->unVol,$this);
    }

}