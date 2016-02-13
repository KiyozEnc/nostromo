<?php
namespace Nostromo\Classes;

/**
 * Permet de créer un vol pour un ajout ultérieur dans une réservation
 */
class Vol
{
    /**
     * Numéro du vol
     * @var int $numVol
     */
    private $numVol;
    /**
     * Date du vol
     * @var string $dateVol
     */
    private $dateVol;
    /**
     * Heure du vol
     * @var string $dateVol
     */
    private $heureVol;
    /**
     * Nombre de place du vol
     * @var int $nbPlace
     */
    private $nbPlace;

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
        return $this->numVol;
    }

    /**
     * @param int $numVol
     * @return Vol
     */
    public function setNumVol($numVol)
    {
        $this->numVol = (int) $numVol;

        return $this;
    }

    /**
     * @return string
     */
    public function getDateVol()
    {
        return DateBuilder::formaterDate($this->dateVol);
    }

    /**
     * @param string $dateVol
     * @return Vol
     */
    public function setDateVol($dateVol)
    {
        $this->dateVol = $dateVol;

        return $this;
    }

    /**
     * @return string
     */
    public function getHeureVol()
    {
        return DateBuilder::formaterHeure($this->heureVol);
    }

    /**
     * @param string $heureVol
     * @return Vol
     */
    public function setHeureVol($heureVol)
    {
        $this->heureVol = $heureVol;

        return $this;
    }

    /**
     * @return int
     */
    public function getNbPlace()
    {
        return $this->nbPlace;
    }

    /**
     * @param int $nbPlace
     * @return Vol
     */
    public function setNbPlace($nbPlace)
    {
        $this->nbPlace = (int) $nbPlace;

        return $this;
    }
}
