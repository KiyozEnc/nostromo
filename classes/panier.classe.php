<?php
require_once 'produit.classe.php';
require_once 'collection.classe.php';

/**
 * Classe Panier
 * Permet de gérer un panier d'objets Produit
 * Nécéssite la classe produit.classe.php
 */
class Panier
{

    /**
     * Collection de produits
     * @var Collection
     */
    private $_collProduit;

    /**
     *  Constructeur de la classe
     *  Initialise la collection de produit
     */

    /**
     * Panier constructor.
     */
    public function __construct()
    {
        $this->_collProduit = new Collection;
    }

    /**
     * Retourne le nombre de produit
     * @return int Retourne un entier
     */
    public function getNbProd()
    {
        return $this->_collProduit->taille();
    }

    /**
     * Augmenter le produit de référence $ref de la quantité $qte
     * @param int $ref  Reference du produit
     * @param int $qte  Nombre de produits à ajouter à la quantité
     */

    public function augmenterQuantiteProduit($ref ,$qte)
    {
        if($this->_collProduit->cleExiste($ref))
            $this->_collProduit->getElement($ref)->augmenterQuantite($qte);
    }

    /**
     * Diminuer le produit de référence $ref de la quantité $qte
     * @param int $ref  Reference du produit
     * @param int $qte  Nombre de produits à retirer à la quantité
     */
    public function diminuerQuantiteProduit($ref ,$qte)
    {
        if ($this->_collProduit->cleExiste($ref)) {
            $this->_collProduit->getElement($ref)->diminuerQuantite($qte);
            if ($this->_collProduit->getElement($ref)->getQte() === 0) {
                $this->_collProduit->supprimer($ref);
            }
        }
    }

    /**
     * @param Article $unProduit
     * @param int     $qte
     *
     * @throws KeyHasUseException
     */
    public function ajouterUnProduit(Article $unProduit, $qte)
    {
        if ($this->_collProduit->cleExiste($unProduit->getNumArt()))
            $this->augmenterQuantiteProduit($unProduit->getNumArt(), $qte);
        else
            $this->_collProduit->ajouter($unProduit, $unProduit->getNumArt());
    }

    /**
     * Supprime un produit
     *
     * @param int $refer
     *
     * @throws KeyInvalidException
     */
    public function supprimerUnProduit($refer)
    {
        if ($this->_collProduit->cleExiste($refer)) {
            $this->_collProduit->supprimer($refer);
        }
    }

    /**
     * Retourne l'ensemble des produits du panier
     * @return array
     */
    public function getProduitsPanier()
    {
        return $this->_collProduit->getCollection();
    }

    /**
     * Retirer l'ensemble des produits du panier
     */
    public function videPanier()
    {
        $this->_collProduit->vider();
    }



}
