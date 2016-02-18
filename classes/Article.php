<?php

namespace Nostromo\Classes;

use Nostromo\Models\MConnexion as Connexion;

/**
 * Permet de créer un Article pour un ajout ultérieur dans le panier.
 *
 * @category Classes
 *
 * @author Nostromo <contact@nostromo.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @link classes/Article.php
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
     * @var string
     */
    private $url;

    /**
     * Constructeur d'un Article, sa référence est passé en paramètre
     * Les autres informations sont obtenues via la base de données.
     */
    public function __construct()
    {
    }

    /**
     * Récupère l'article sous forme de tableau.
     *
     * @return array
     */
    public function getArticles()
    {
        $numArt = $this->getNumArt();
        $designation = $this->getDesignation();
        $pu = $this->getPu();
        $qteStock = $this->getQteStock();
        $tab = array(
            'numArt' => $numArt,
            'designatio' => $designation,
            'pu' => $pu,
            'qteStock' => $qteStock,
        );

        return $tab;
    }
    /**
     * Retourne la référence du Article.
     *
     * @return string
     */
    public function getNumArt()
    {
        return $this->numArt;
    }
    public function vider()
    {
    }

    /**
     * Retourne le libellé du Article.
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Get Qte.
     *
     * @return int
     */
    public function getQte()
    {
        return $this->qte;
    }

    /**
     * Augment de $quantite la quantité de l'article.
     *
     * @param int $quantite
     *
     * @throws \UnexpectedValueException
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
     * Retourne la quantité commmandée.
     *
     * @return int
     */
    public function getPu()
    {
        return $this->pu;
    }

    /**
     * Retourne le prix du Article.
     *
     * @return int
     */
    public function getQteStock()
    {
        return $this->qteStock;
    }

    /**
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
     * @return string
     */
    public function getUrl()
    {
        if ($this->url === null) {
            return 'img/Basket/basket.png';
        } else {
            return $this->url;
        }
    }

    /**
     * @param string $url
     *
     * @return Article
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }
}
