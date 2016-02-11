<?php
require_once ('models/m_Vols.php');

/**
 * Permet de créer un vol pour un ajout ultérieur dans une réservation
 */
class Vol
{
    /**
     * Numéro du vol
     * @var int $_numVol
     */
    private $_numVol;
    /**
     * Date du vol
     * @var string $dateVol
     */
    private $_dateVol;
    /**
     * Heure du vol
     * @var string $_dateVol
     */
    private $_heureVol;
    /**
     * Nombre de place du vol
     * @var int $nbPlace
     */
    private $_nbPlace;

    /**
     * Constructeur du vol
     */
    public function __construct()
    {

    }

    /**
     * @return int
     */
    public function getNumVol()
    {
        return $this->_numVol;
    }

    /**
     * @param int $_numVol
     * @return Vol
     */
    public function setNumVol($_numVol)
    {
        $this->_numVol = (int) $_numVol;

        return $this;
    }

    /**
     * @return string
     */
    public function getDateVol()
    {
        return DateVol::formaterDate($this->_dateVol);
    }

    /**
     * @param string $_dateVol
     * @return Vol
     */
    public function setDateVol($_dateVol)
    {
        $this->_dateVol = $_dateVol;

        return $this;
    }

    /**
     * @return string
     */
    public function getHeureVol()
    {
        return DateVol::formaterHeure($this->_heureVol);
    }

    /**
     * @param string $_heureVol
     * @return Vol
     */
    public function setHeureVol($_heureVol)
    {
        $this->_heureVol = $_heureVol;

        return $this;
    }

    /**
     * @return int
     */
    public function getNbPlace()
    {
        return $this->_nbPlace;
    }

    /**
     * @param int $_nbPlace
     * @return Vol
     */
    public function setNbPlace($_nbPlace)
    {
        $this->_nbPlace = (int) $_nbPlace;

        return $this;
    }



}