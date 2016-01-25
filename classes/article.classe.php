<?php

require_once ('models/m_Article.php');

/**
 * Permet de créer un Article pour un ajout ultérieur dans le panier
 */
class Article
{
    /**
     * @var int
     */
    private $numArt;
    /**
     * @var string
     */
    private $designation;
    /**
     * @var int
     */
    private $pu;
    /**
     * @var int
     */
    private $qteStock;
    /**
     * @var int
     */
    private $qte;

    /**
     * Constructeur d'un Article, sa référence est passé en paramètre
     * Les autres informations sont obtenues via la base de données
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
     * @return string
     */
    public function getNumArt()
    {
        return ($this->numArt);
    }
    public function vider()
    {

    }

    /**
     * Retourne le libellé du Article
     * @return string
     */
    public function getDesignation()
    {
        return ($this->designation);
    }
    public function getQte()
    {
        return ($this->qte);
    }
    public function augmenterQuantite($quantite)
    {
        try
        {
            if($this->qte < $this->qteStock)
                $this->qte = $this->qte + $quantite;
            else
                throw new Exception("La quantité en stock est insuffisante.");
        }
        catch (Exception $e)
        {
            Connexion::setFlashMessage($e->getMessage(), "error");
        }

    }
    public function diminuerQuantite($quantite)
    {
        $this->qte=$this->qte-$quantite;
        if($this->qte<0){$this->qte=0;}
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

    /**
     * @param int $qte
     * @return Article
     */
    public function setQte($qte)
    {
        $this->qte = (int) $qte;
        return $this;
    }

    /**
     * @param int $numArt
     * @return Article
     */
    public function setNumArt($numArt)
    {
        $this->numArt = (int) $numArt;
        return $this;
    }

    /**
     * @param string $designation
     * @return Article
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;
        return $this;
    }

    /**
     * @param int $pu
     * @return Article
     */
    public function setPu($pu)
    {
        $this->pu = (int) $pu;
        return $this;
    }

    /**
     * @param int $qteStock
     * @return Article
     */
    public function setQteStock($qteStock)
    {
        $this->qteStock = (int) $qteStock;
        return $this;
    }


}
