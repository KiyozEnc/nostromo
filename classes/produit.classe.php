<?php
//Chargement du modèle contenant les appels à la base de données
require_once ('models/m_Vols.php');

/**
 * Permet de créer un produit pour un ajout ultérieur dans le panier
 */
class Produit
{
  private $ref;	// Référence du produit
	private $date;   // Libellé du produit
	private $heure;   // Quantité du produit
	private $nbPlace;  // Prix du produit

 /**
  * Constructeur d'un produit, sa référence est passé en paramètre
  * Les autres informations sont obtenues via la base de données
  * @param type $reference
  */
  public function Produit ($reference) // Constructeur
  {
    $this->ref = $reference;
    $tab = MVol::getUnVol($reference);
    $this->date = $tab->getDateVol();
    $this->heure = $tab->getHeureVol();
    $this->nbPlace = $tab->getNbPlace();
  }
  /**
   * Retourne la référence du produit
   * @return type
   */
  public function getRef()
  {
   return ($this->ref);
 }

  /**
   * Retourne le libellé du produit
   * @return type
   */
  public function getDate()
  {
   return ($this->date);
 }

  /**
   * Retourne la quantité commmandée
   * @return type
   */
  public function getHeure()
  {
   return ($this->heure);
 }

  /**
   * Retourne le prix du produit
   * @return type
   */
  public function getNbPlace()
  {
   return ($this->nbPlace);
 }


}



?>
