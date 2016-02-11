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
    private $_id;
    /**
     * @var Utilisateur
     */
    private $_unClient;
    /**
     * @var Vol
     */
    private $_unVol;
    /**
     * @var \DateTime
     */
    private $_dateRes;
    /**
     * @var int
     */
    private $_nbPers;
    /**
     * @var boolean
     */
    private $_valid = false;

    public function __construct()
    {
        $this->_dateRes = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param int $_id
     * @return Reservation
     */
    public function setId($_id)
    {
        $this->_id = (int) $_id;

        return $this;
    }

    /**
     * @return Vol
     */
    public function getUnVol()
    {
        return $this->_unVol;
    }

    /**
     * @param Vol $_unVol
     * @return Reservation
     */
    public function setUnVol($_unVol)
    {
        $this->_unVol = $_unVol;

        return $this;
    }

    /**
     * @return Utilisateur
     */
    public function getUnClient()
    {
        return $this->_unClient;
    }

    /**
     * @param Utilisateur $_unClient
     * @return Reservation
     */
    public function setUnClient($_unClient)
    {
        $this->_unClient = $_unClient;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateRes()
    {
        return $this->_dateRes;
    }

    /**
     * @param \DateTime $_dateRes
     * @return Reservation
     */
    public function setDateRes($_dateRes)
    {
        $this->_dateRes = DateTime::createFromFormat('Y-m-d H:i:s', $_dateRes);

        return $this;
    }

    /**
     * @return int
     */
    public function getNbPers()
    {
        return $this->_nbPers;
    }

    /**
     * @param int $_nbPers
     * @return Reservation
     */
    public function setNbPers($_nbPers)
    {
        $this->_nbPers = (int) $_nbPers;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isValid()
    {
        return $this->_valid;
    }

    /**
     * @param boolean $_valid
     * @return Reservation
     */
    public function setValid($_valid)
    {
        $this->_valid = (boolean) $_valid;

        return $this;
    }

    public function flushValid()
    {
        MVol::validReservation(
            $this->_unClient,
            $this->_unVol,
            $this
        );
    }

}