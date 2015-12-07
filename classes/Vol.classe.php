<?php
require_once ('models/m_Vols.php');

/**
 * Permet de cr�er un produit pour un ajout ultérieur dans le panier
 */
class Vol
{
    private $numVol;	// Référence du produit
    private $dateVol;   // Libellé du produit
    private $heureVol;   // Quantité du produit
    private $nbPlace;  // Prix du produit

    /**
     * Constructeur d'un produit, sa référence est passé en paramètre
     * Les autres informations sont obtenues via la base de donn�es
     */

    public function __construct()
    {

    }

    /**
     * Retourne la référence du produit
     * @return type
     */
    public function getNumVol()
    {
        return ($this->numVol);
    }

    /**
     * Retourne le libellé du produit
     * @return type
     */
    public function getDateVol()
    {
        return ($this->dateVol);
    }

    /**
     * Retourne la quantité commmandée
     * @return type
     */
    public function getHeureVol()
    {
        return ($this->heureVol);
    }

    /**
     * Retourne le prix du produit
     * @return type
     */
    public function getNbPlace()
    {
        return ($this->nbPlace);
    }
    public function __get($property)
    {
        return $this->$property;
    }

    public function __set($property, $value)
    {
        $this->$property = $value;
    }

}



?>
