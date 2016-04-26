<?php

namespace Nostromo\Classes;

use InvalidArgumentException;

/**
 * Class Panier
 * @package Nostromo\Classes
 */
class Panier
{
    /**
     * Collection de produits.
     *
     * @var Collection
     */
    private $collProduit;

    /**
     * @var int
     */
    private $pointsUtilise;

    /**
     * Panier constructor.
     */
    public function __construct()
    {
        $this->collProduit = new Collection();
    }

    /**
     * Retourne le nombre d'article dans le panier.
     *
     * @return int
     */
    public function getNbProd()
    {
        return $this->collProduit->taille();
    }

    /**
     * Augmente à l'article de numéro $ref $qte à sa quantité.
     *
     * @param int $ref Numéro de l'article
     * @param int $qte Quantité à ajouter
     *
     * @throws \InvalidArgumentException
     */
    public function augmenterQuantiteProduit($ref, $qte)
    {
        if ($this->collProduit->cleExiste($ref)) {
            $this->collProduit->getElement($ref)->augmenterQuantite($qte);
        }
    }

    /**
     * Change la quantité de l'article $ref en $qte.
     *
     * @param int $ref
     * @param int $qte
     *
     * @throws \InvalidArgumentException
     */
    public function setQteProduit($ref, $qte)
    {
        if ($this->collProduit->cleExiste($ref)) {
            $this->collProduit->getElement($ref)->setQte($qte);
        }
    }

    /**
     * Diminue à l'article de numéro $ref $qte à sa quantité ou supprime l'article si qte = 0.
     *
     * @param int $ref Numéro de l'article
     * @param int $qte Quantité à ajouter
     *
     * @throws \InvalidArgumentException
     */
    public function diminuerQuantiteProduit($ref, $qte)
    {
        if ($this->collProduit->cleExiste($ref)) {
            $this->collProduit->getElement($ref)->diminuerQuantite($qte);
            if ($this->collProduit->getElement($ref)->getQte() === 0) {
                $this->collProduit->supprimer($ref);
            }
        }
    }

    /**
     * Ajoute un article au panier ou augmente de 1 sa quantité s'il est déjà dans le panier
     *
     * @param Article $unProduit
     * @param int     $qte
     *
     * @throws InvalidArgumentException
     */
    public function ajouterUnProduit(Article $unProduit, $qte)
    {
        if ($this->collProduit->cleExiste($unProduit->getNumArt())) {
            $produitPanier = $this->collProduit->getElement($unProduit->getNumArt());
            if (($unProduit->getQte() + $produitPanier->getQte()) > $unProduit->getQteStock()) {
                throw new InvalidArgumentException('Quantité en stock insuffisante');
            }
            $this->augmenterQuantiteProduit($unProduit->getNumArt(), $qte);
        } else {
            $this->collProduit->ajouter($unProduit, $unProduit->getNumArt());
        }
    }

    /**
     * Supprime un produit du panier.
     *
     * @param int $numArt
     *
     * @throws InvalidArgumentException
     */
    public function supprimerUnProduit($numArt)
    {
        if ($this->collProduit->cleExiste($numArt)) {
            $this->collProduit->supprimer($numArt);
        }
    }

    /**
     * Retourne l'ensemble des articles du panier.
     *
     * @return array
     */
    public function getProduitsPanier()
    {
        return $this->collProduit->getCollection();
    }

    /**
     * @return Collection
     */
    public function getCollProduit()
    {
        return $this->collProduit;
    }

    /**
     * @param Collection $collProduit
     *
     * @return Panier
     */
    public function setCollProduit($collProduit)
    {
        $this->collProduit = $collProduit;

        return $this;
    }
    /**
     * Retourne le prix total sans remise du contenu du panier
     *
     * @return float
     */
    public function getPrixTotal()
    {
        $prix = (float) 0;
        foreach ($this->collProduit->getCollection() as $unArticle) {
            /** @var Article $unArticle */
            $prix += $unArticle->getMontant();
        }
        return $prix;
    }

    /**
     * Retourne le prix total avec remise du contenu du panier
     *
     * @return float
     */
    public function getPrixTotalWithRemise()
    {
        $prix = (float) 0;
        foreach ($this->collProduit->getCollection() as $unArticle) {
            /** @var Article $unArticle */
            $prix += $unArticle->getMontant();
        }
        return $prix * $this->getMultiplicateurRemise();
    }

    /**
     * Retourne le multiplicateur à appliqué au prix à remiser
     *
     * @return float
     */
    public function getMultiplicateurRemise()
    {
        $reduc = 1;
        for ($i = 0; $i <= $this->pointsUtilise - Reservation::STEP_POINTS; $i += Reservation::STEP_POINTS) {
            $reduc -= Reservation::STEP_REDUCTION * 1.5;
        }
        if ($this->pointsUtilise < Reservation::STEP_POINTS) {
            $reduc = 1;
        }
        return $reduc;
    }

    /**
     * Retourne le montant de la remise
     *
     * @return float
     */
    public function getMontantRemise()
    {
        return $this->getPrixTotal() - $this->getPrixTotalWithRemise();
    }

    /**
     * @return int
     */
    public function getPointsUtilise()
    {
        return $this->pointsUtilise;
    }

    /**
     * @param int $pointsUtilise
     * @return Panier
     */
    public function setPointsUtilise($pointsUtilise)
    {
        $this->pointsUtilise = $pointsUtilise;
        return $this;
    }
}
