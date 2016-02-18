<?php

namespace Nostromo\classes;

use InvalidArgumentException;

/**
 * Classe Panier
 * Permet de gérer un panier d'objets Produit
 * Nécéssite la classe Produit.php.
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
}
