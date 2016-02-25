<?php

namespace Nostromo\Classes;

/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 25/01/2016
 * Time: 14:39.
 */
class Commander
{
    /**
     * @var Article
     */
    private $unArticle;
    /**
     * @var Commande
     */
    private $uneCommande;
    /**
     * @var int
     */
    private $qte;

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
        return $this->unArticle;
    }

    /**
     * @param Article $unArticle
     *
     * @return Commander
     */
    public function setUnArticle(Article $unArticle)
    {
        $this->unArticle = $unArticle;

        return $this;
    }

    /**
     * @return Commande
     */
    public function getUneCommande()
    {
        return $this->uneCommande;
    }

    /**
     * @param Commande $uneCommande
     *
     * @return Commander
     */
    public function setUneCommande($uneCommande)
    {
        $this->uneCommande = $uneCommande;

        return $this;
    }

    /**
     * @return int
     */
    public function getQte()
    {
        return $this->qte;
    }

    /**
     * @param int $qte
     *
     * @return Commander
     */
    public function setQte($qte)
    {
        $this->qte = $qte;

        return $this;
    }
}
