<?php

namespace Nostromo\Classes;

/**
 * Class Commander
 * Représente un article dans une commande
 * @package Nostromo\Classes
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
