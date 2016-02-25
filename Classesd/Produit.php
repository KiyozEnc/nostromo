<?php

namespace Nostromo\Classes;

use Nostromo\Models\MVol;

/**
 * Permet de créer un produit pour un ajout ultérieur dans une réservation.
 */
class Produit
{
    /**
     * Référence du vol.
     *
     * @var int
     */
    private $ref;
    /**
     * Date du vol.
     *
     * @var string
     */
    private $date;
    /**
     * Heure du vol.
     *
     * @var string
     */
    private $heure;
    /**
     * Nombre de place du vol.
     *
     * @var int
     */
    private $nbPlace;
    /**
     * Est validé ou non.
     *
     * @var bool
     */
    private $valid = false;

    /**
     * Produit constructor.
     *
     * @param int $ref
     * @param int $personnes
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($ref, $personnes)
    {
        $this->ref = $ref;
        $tab = MVol::getUnVol($ref);
        $this->date = $tab->getDateVol();
        $this->heure = $tab->getHeureVol();
        $this->nbPlace = $personnes;
    }

    /**
     * Retourne la référence du vol.
     *
     * @return int
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Retourne la date du vol.
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Retourne l'heure du vol.
     *
     * @return string
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * Retourne le nombre de place du vol.
     *
     * @return int
     */
    public function getNbPlace()
    {
        return $this->nbPlace;
    }

    /**
     * Retourne l'objet en forme de tableau.
     *
     * @return array
     */
    public function getProduit()
    {
        return array(
            'ref' => $this->ref,
            'date' => $this->date,
            'heure' => $this->heure,
            'nbPlace' => $this->nbPlace,
            'valid' => $this->valid,
        );
    }

    /**
     * Retourne est valid.
     *
     * @return bool
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * Setter de valid.
     *
     * @param bool $valid
     */
    public function setValider($valid)
    {
        $this->valid = $valid;
    }
}
