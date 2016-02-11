<?php
require_once('models/m_Vols.php');

/**
 * Permet de créer un produit pour un ajout ultérieur dans une réservation
 */
class Produit
{
    /**
     * Référence du vol
     * @var int $_ref
     */
    private $_ref;
    /**
     * Date du vol
     * @var string $_date
     */
    private $_date;
    /**
     * Heure du vol
     * @var string $_heure
     */
    private $_heure;
    /**
     * Nombre de place du vol
     * @var int $_nbPlace
     */
    private $_nbPlace;
    /**
     * Est validé ou non
     * @var bool $_valid
     */
    private $_valid = false;

    /**
     * @param int $_reference
     * @param int $personnes
     */
    public function __construct ($_reference,$personnes) // Constructeur
    {
        $this->_ref = $_reference;
        $tab = MVol::getUnVol($_reference);
        $this->_date = $tab->getDateVol();
        $this->_heure = $tab->getHeureVol();
        $this->_nbPlace = $personnes;
    }

    /**
     * Retourne la référence du vol
     * @return int
     */
    public function getRef()
    {
        return $this->_ref;
    }

    /**
     * Retourne la date du vol
     * @return string
     */
    public function getDate()
    {
        return $this->_date;
    }

    /**
     * Retourne l'heure du vol
     * @return string
     */
    public function getHeure()
    {
        return $this->_heure;
    }

    /**
     * Retourne le nombre de place du vol
     * @return int
     */
    public function getNbPlace()
    {
        return $this->_nbPlace;
    }

    /**
     * Retourne l'objet en forme de tableau
     * @return array
     */
    public function getProduit()
    {
        return array (
            'ref' => $this->_ref,
            'date' => $this->_date,
            'heure' => $this->_heure,
            'nbPlace' => $this->_nbPlace,
            'valid' => $this->_valid
        );
    }

    /**
     * Retourne est valid
     * @return bool
     */
    public function getValid()
    {
        return $this->_valid;
    }

    /**
     * Setter de valid
     * @param bool $_valid
     */
    public function setValider($_valid)
    {
        $this->_valid = $_valid;
    }

    /**
     * Persiste le vol et flush
     */
    public function enregistrerValid()
    {
        $_dateRes = date('Y-m-d H:i:s');
        MVol::validReservation(
            $_SESSION['numClt'],
            $this->getRef(),
            $_dateRes,
            $this->getNbPlace()
        );
    }
}
