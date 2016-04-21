<?php

namespace Nostromo\Classes;

use InvalidArgumentException;

/**
 * Classe Panier
 * Permet de gérer un panier d'objets Produit
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
     *  Constructeur de la classe
     *  Initialise la collection de produit.
     */

    /**
     * Panier constructor.
     */
    public function __construct()
    {
        $this->collProduit = new Collection();
    }

    /**
     * Retourne le nombre de produit.
     *
     * @return int Retourne un entier
     */
    public function getNbProd()
    {
        return $this->collProduit->taille();
    }

    /**
     * Augmenter le produit de référence $ref de la quantité $qte.
     *
     * @param int $ref Reference du produit
     * @param int $qte Nombre de produits à ajouter à la quantité
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
     * Diminuer le produit de référence $ref de la quantité $qte.
     *
     * @param int $ref Reference du produit
     * @param int $qte Nombre de produits à retirer à la quantité
     *
     * @throws InvalidArgumentException
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
     * Supprime un produit.
     *
     * @param int $refer
     *
     * @throws InvalidArgumentException
     */
    public function supprimerUnProduit($refer)
    {
        if ($this->collProduit->cleExiste($refer)) {
            $this->collProduit->supprimer($refer);
        }
    }

    /**
     * Retourne l'ensemble des produits du panier.
     *
     * @return array
     */
    public function getProduitsPanier()
    {
        return $this->collProduit->getCollection();
    }

    /**
     * Retirer l'ensemble des produits du panier.
     */
    public function videPanier()
    {
        $this->collProduit->vider();
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
     * @return float
     */
    public function getMontantRemise()
    {
        $montant = 0;
        foreach ($this->collProduit->getCollection() as $article) {
            $montant += ($article->getPu() * $article->getQte()) - ($article->getPu() * $article->getQte())*$this->getMultiplicateurRemise();
        }

        return $montant;
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
