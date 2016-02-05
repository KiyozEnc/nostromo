<?php
require_once "produit.classe.php";
require_once "collection.classe.php";
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
    private $CollProduit;

    /**
     *  Constructeur de la classe
     *  Initialise la collection de produit
     */

    /**
     * Panier constructor.
     */
    public function Panier()
    {
        $this->CollProduit = new Collection;
    }

    /**
     * Retourne le nombre de produit
     * @return int Retourne un entier
     */
    public function getNbProd()
    {
        return $this->CollProduit->taille();
    }

    /**
     * Augmenter le produit de référence $ref de la quantité $qte
     * @param int $ref  Reference du produit
     * @param int $qte  Nombre de produits à ajouter à la quantité
     */

    public function augmenterQuantiteProduit($ref ,$qte)
    {
        if($this->CollProduit->cleExiste($ref))
            $this->CollProduit->getElement($ref)->augmenterQuantite($qte);
    }

    /**
     * Diminuer le produit de référence $ref de la quantité $qte
     * @param int $ref  Reference du produit
     * @param int $qte  Nombre de produits à retirer à la quantité
     */
    public function diminuerQuantiteProduit($ref ,$qte)
    {
        if($this->CollProduit->cleExiste($ref))
        {
            $this->CollProduit->getElement($ref)->diminuerQuantite($qte);
            if ($this->CollProduit->getElement($ref)->getQte()==0)
            {
                $this->CollProduit->supprimer($ref);
            }
        }
    }
    /**
     * Ajoute un produit au panier s'il n'existe pas encore
     * Sinon ajoute une unité à la quantité commandée
     * @param Article $unProduit
     * @param int $qte
     */
    public function ajouterUnProduit($unProduit,$qte)
    {
        if($this->CollProduit->cleExiste($unProduit->getNumArt()))
            $this->augmenterQuantiteProduit($unProduit->getNumArt(),$qte);
        else
            $this->CollProduit->ajouter($unProduit, $unProduit->getNumArt());
    }

    /**
     * Supprime le produit du panier
     * @param int $refer  Référence du produit
     */
    public function supprimerUnProduit($refer)
    {
        if($this->CollProduit->cleExiste($refer))
        {
            $this->CollProduit->supprimer($refer);
        }
    }

    /**
     * Retourne l'ensemble des produits du panier
     * @return array tableau
     */
    public function getProduitsPanier()
    {
        return $this->CollProduit->getCollection();
    }
    /**
     * Retirer l'ensemble des produits du panier
     */
    public function videPanier()
    {
        $this->CollProduit->vider();
    }



}
