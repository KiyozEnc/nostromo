<?php

/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 25/01/2016
 * Time: 14:39
 */
class Commander
{
    /**
     * @var Article
     */
    private $_unArticle;
    /**
     * @var Commande
     */
    private $_uneCommande;
    /**
     * @var int
     */
    private $_qte;
    
    /**
     * Commander constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return Article
     */
    public function getUnArticle()
    {
        return $this->_unArticle;
    }

    /**
     * @param Article $unArticle
     * @return Commander
     */
    public function setUnArticle($unArticle)
    {
        $this->_unArticle = $unArticle;
        return $this;
    }

    /**
     * @return Commande
     */
    public function getUneCommande()
    {
        return $this->_uneCommande;
    }

    /**
     * @param Commande $uneCommande
     * @return Commander
     */
    public function setUneCommande($uneCommande)
    {
        $this->_uneCommande = $uneCommande;
        return $this;
    }

    /**
     * @return int
     */
    public function getQte()
    {
        return $this->_qte;
    }

    /**
     * @param int $qte
     * @return Commander
     */
    public function setQte($qte)
    {
        $this->_qte = $qte;
        return $this;
    }
}