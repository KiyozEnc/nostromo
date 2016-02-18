<?php

namespace Nostromo\Classes;

/**
 * Permet de créer un vol pour un ajout ultérieur dans une réservation.
 */
class Vol
{
    /**
     * Numéro du vol.
     *
     * @var int
     */
    private $numVol;
    /**
     * Date du vol.
     *
     * @var string
     */
    private $dateVol;
    /**
     * Heure du vol.
     *
     * @var string
     */
    private $heureVol;
    /**
     * Nombre de place du vol.
     *
     * @var int
     */
    private $nbPlace;
    /**
     * Prix d'un vol
     *
     * @var int
     */
    private $price;

    /**
     * @var bool
     */
    private $paye = false;

    /**
     * Constructeur du vol.
     */
    public function __construct($price = 0)
    {
        $this->price = $price;
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
     *
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
     *
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
     *
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
     *
     * @return Vol
     */
    public function setNbPlace($nbPlace)
    {
        $this->nbPlace = (int) $nbPlace;

        return $this;
    }

    public function getNonFormatDate()
    {
        return $this->dateVol;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $price
     *
     * @return Vol
     */
    public function setPrice($price)
    {
        $this->price = (int) $price;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isPaye()
    {
        return $this->paye;
    }

    /**
     * @param boolean $paye
     *
     * @return Vol
     */
    public function setPaye($paye)
    {
        $this->paye = $paye;

        return $this;
    }

    /**
     * Récupère le prix au format EURO
     *
     * @return string
     */
    public function getFormattedPrice()
    {
        return $this->price.' €';
    }
}
