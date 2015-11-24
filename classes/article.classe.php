<?php

require_once ('models/m_Article.php');

/**
 * Permet de créer un Article pour un ajout ultérieur dans le panier
 */
class Article
{
  private $numArt;
  private $designation;
  private $pu;
  private $qteStock;

 /**
  * Constructeur d'un Article, sa référence est passé en paramètre
  * Les autres informations sont obtenues via la base de données
  * @param type $reference
  */
 public function __construct()
 {

 }
 public function getArticles()
 {
  $numArt = $this->getNumArt();
  $designation = $this->getDesignation();
  $pu = $this->getPu();
  $qteStock = $this->getQteStock();
  $tab = array (
    "numArt" => $numArt,
    "designation" => $designation,
    "pu" => $pu,
    "qteStock" => $qteStock
    );
  return $tab;
}
  /**
   * Retourne la référence du Article
   * @return type
   */
  public function getNumArt()
  {
   return ($this->numArt);
 }

  /**
   * Retourne le libellé du Article
   * @return type
   */
  public function getDesignation()
  {
    return ($this->designation);
  }

  /**
   * Retourne la quantité commmandée
   * @return type
   */
  public function getPu()
  {
   return ($this->pu);
 }

  /**
   * Retourne le prix du Article
   * @return type
   */
  public function getQteStock()
  {
    return ($this->qteStock);
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
