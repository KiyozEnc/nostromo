<?php
require_once ('models/m_Vols.php');

/**
 * Permet de créer un produit pour un ajout ultérieur dans une réservation
 */
class Produit
{
    /**
     * Référence du vol
     * @var int $ref
     */
    private $ref;
    /**
     * Date du vol
     * @var string $date
     */
    private $date;
    /**
     * Heure du vol
     * @var string $heure
     */
    private $heure;
    /**
     * Nombre de place du vol
     * @var int $nbPlace
     */
    private $nbPlace;
    /**
     * Est validé ou non
     * @var bool $valid
     */
    private $valid = false;

    /**
     * @param int $reference
     * @param int $personnes
     */
    public function Produit ($reference,$personnes) // Constructeur
    {
        $this->ref = $reference;
        $tab = MVol::getUnVol($reference);
        $this->date = $tab->getDateVol();
        $this->heure = $tab->getHeureVol();
        $this->nbPlace = $personnes;
    }

    /**
     * Retourne la référence du vol
     * @return int
     */
    public function getRef()
    {
        return ($this->ref);
    }

    /**
     * Retourne la date du vol
     * @return string
     */
    public function getDate()
    {
        return ($this->date);
    }

    /**
     * Retourne l'heure du vol
     * @return string
     */
    public function getHeure()
    {
        return ($this->heure);
    }

    /**
     * Retourne le nombre de place du vol
     * @return int
     */
    public function getNbPlace()
    {
        return ($this->nbPlace);
    }

    /**
     * Retourne l'objet en forme de tableau
     * @return array
     */
    public function getProduit()
    {
        return array (
            "ref" => $this->ref,
            "date" => $this->date,
            "heure" => $this->heure,
            "nbPlace" => $this->nbPlace,
            "valid" => $this->valid
        );
    }

    /**
     * Retourne est valid
     * @return bool
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * Setter de valid
     * @param bool $valid
     */
    public function setValider($valid)
    {
        $this->valid = $valid;
    }

    /**
     * Persiste le vol et flush
     */
    public function enregistrerValid()
    {
        $dateRes = date('Y-m-d H:i:s');
        MVol::validReservation($_SESSION['numClt'],$this->getRef(),$dateRes,$this->getNbPlace());
    }
}
