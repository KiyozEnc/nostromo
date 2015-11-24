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
  private $valid;

 /**
  * Constructeur d'un produit, sa référence est passé en paramètre
  * Les autres informations sont obtenues via la base de données
  * @param type $reference
  */
  public function Produit ($reference,$personnes) // Constructeur
  {
    $this->ref = $reference;
    $tab = MVol::getUnVol($reference);
    $this->date = $tab->getDateVol();
    $this->heure = $tab->getHeureVol();
    $this->nbPlace = $personnes;
    $this->valid = false;
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
 public function getProduit()
 {
  $ref = $this->getRef();
  $date = $this->getDate();
  $heure = $this->getHeure();
  $nbPlace = $this->getNbPlace();
  $tab = array (
    "ref" => $ref,
    "date" => $date,
    "heure" => $heure,
    "nbPlace" => $nbPlace
    );
  return $tab;
}
public function getValid()
{
  return $this->valid;
}
public function setValider()
{
  $this->valid = true;
}
public function enregistrerValid()
{
  $dateRes = date('Y-m-d H:i:s');
  MVol::validReservation($_SESSION['numClt'],$this->getRef(),$dateRes,$this->getNbPlace());
}
public function setNonValid()
{
  $this->valid = false;
}
}



?>
