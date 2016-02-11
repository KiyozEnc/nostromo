<?php

require_once ('models/m_Article.php');


/**
 * Permet de créer un Article pour un ajout ultérieur dans le panier
 *
 * @category Classes
 * @package Nostromo\Classes
 * @author Nostromo <contact@nostromo.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link classes/article.classe.php
 */
class Article
{
    /**
     * @var int
     */
    private $_numArt;
    /**
     * @var string
     */
    private $_designation;
    /**
     * @var int
     */
    private $_pu;
    /**
     * @var int
     */
    private $_qteStock;
    /**
     * @var int
     */
    private $_qte;

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
            'numArt' => $numArt,
            'designatio' => $designation,
            'pu' => $pu,
            'qteStock' => $qteStock
        );
        return $tab;
    }
    /**
     * Retourne la référence du Article
     * @return string
     */
    public function getNumArt()
    {
        return $this->_numArt;
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
        return $this->_designation;
    }
    public function getQte()
    {
        return $this->_qte;
    }
    public function augmenterQuantite($quantite)
    {
        try
        {
            if ($this->_qte < $this->_qteStock) {
                $this->_qte += $quantite;
            } else {
                throw new LogicException('La quantité en stock est insuffisante.');
            }
        }
        catch (Exception $e)
        {
            Connexion::setFlashMessage($e->getMessage(), 'error');
        }

    }
    public function diminuerQuantite($quantite)
    {
        $this->_qte -= $quantite;
        if ($this->_qte < 0) {
            $this->_qte = 0;
        }
    }
    /**
     * Retourne la quantité commmandée
     * @return int
     */
    public function getPu()
    {
        return $this->_pu;
    }

    /**
     * Retourne le prix du Article
     * @return int
     */
    public function getQteStock()
    {
        return $this->_qteStock;
    }

    /**
     * @param int $qte
     * @return Article
     */
    public function setQte($qte)
    {
        $this->_qte = (int) $qte;
        return $this;
    }

    /**
     * @param int $numArt
     * @return Article
     */
    public function setNumArt($numArt)
    {
        $this->_numArt = (int) $numArt;
        return $this;
    }

    /**
     * @param string $designation
     * @return Article
     */
    public function setDesignation($designation)
    {
        $this->_designation = $designation;
        return $this;
    }

    /**
     * @param int $pu
     * @return Article
     */
    public function setPu($pu)
    {
        $this->_pu = (int) $pu;
        return $this;
    }

    /**
     * @param int $qteStock
     * @return Article
     */
    public function setQteStock($qteStock)
    {
        $this->_qteStock = (int) $qteStock;
        return $this;
    }


}
