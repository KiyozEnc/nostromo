<?php

namespace Nostromo\Classes;

use Nostromo\Models\MConnexion as Connexion;

/**
 * Class Article
 * Permet de créer un Article pour un ajout ultérieur dans le panier.
 * @package Nostromo\Classes
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
    private $description;
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
     * @var string
     */
    private $url;

    /**
     * Retourne la référence de l'Article.
     *
     * @return string
     */
    public function getNumArt()
    {
        return $this->numArt;
    }

    /**
     * Retourne la désignation de l'Article.
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Retourne la quantité choisie par le client pour cet article
     *
     * @return int
     */
    public function getQte()
    {
        return $this->qte;
    }

    /**
     * Augmente de $quantite la quantité de l'article.
     *
     * @param int $quantite
     */
    public function augmenterQuantite($quantite)
    {
        try {
            if ($this->qte < $this->qteStock) {
                $this->qte += $quantite;
            } else {
                throw new \InvalidArgumentException('La quantité en stock est insuffisante.');
            }
        } catch (\InvalidArgumentException $e) {
            Connexion::setFlashMessage($e->getMessage(), 'error');
        }
    }

    /**
     * Diminue de $quantite la quantité de l'article
     *
     * @param int $quantite
     */
    public function diminuerQuantite($quantite)
    {
        $this->qte -= $quantite;
        if ($this->qte < 0) {
            $this->qte = 0;
        }
    }

    /**
     * Retourne le prix unitaire de l'Article.
     *
     * @return int
     */
    public function getPu()
    {
        return $this->pu;
    }

    /**
     * Retourne la quantité en stock de l'Article.
     *
     * @return int
     */
    public function getQteStock()
    {
        return $this->qteStock;
    }

    /**
     * Set Qte.
     *
     * @param int $qte
     *
     * @return Article
     */
    public function setQte($qte)
    {
        $this->qte = (int) $qte;

        return $this;
    }

    /**
     * Set NumArt.
     *
     * @param int $numArt
     *
     * @return Article
     */
    public function setNumArt($numArt)
    {
        $this->numArt = (int) $numArt;

        return $this;
    }

    /**
     * Set Designation.
     *
     * @param string $designation
     *
     * @return Article
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Set Pu.
     *
     * @param int $pu
     *
     * @return Article
     */
    public function setPu($pu)
    {
        $this->pu = (int) $pu;

        return $this;
    }

    /**
     * Set QteStock.
     *
     * @param int $qteStock
     *
     * @return Article
     */
    public function setQteStock($qteStock)
    {
        $this->qteStock = (int) $qteStock;

        return $this;
    }

    /**
     * Retourne le chemin d'accès à l'image de l'Article
     *
     * @return string
     */
    public function getUrl()
    {
        if ($this->url === null) {
            return 'public/Resources/img/Basket/basket.png';
        } else {
            return $this->url;
        }
    }

    /**
     * Set Url.
     *
     * @param string $url
     *
     * @return Article
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Retourne la description de l'Article
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set Description.
     *
     * @param string $description
     * @return Article
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Retourne le prix total (sans réduction) commandée par le client.
     *
     * @return int
     */
    public function getMontant()
    {
        return $this->pu*$this->qte;
    }
}
