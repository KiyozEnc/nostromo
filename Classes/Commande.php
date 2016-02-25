<?php

namespace Nostromo\Classes;

/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 25/01/2016
 * Time: 14:36.
 */
class Commande
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var Utilisateur
     */
    private $unClient;
    /**
     * @var string
     */
    private $uneDate;
    /**
     * @var Collection
     */
    private $lesArticles;

    /**
     * Commande constructor.
     *
     * @param int         $id
     * @param Utilisateur $unClient
     * @param string      $uneDate
     */
    public function __construct($id, Utilisateur $unClient, $uneDate)
    {
        $this->id = $id;
        $this->unClient = $unClient;
        $this->uneDate = $uneDate;
        $this->lesArticles = new Collection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Commande
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Utilisateur
     */
    public function getUnClient()
    {
        return $this->unClient;
    }

    /**
     * @param Utilisateur $unClient
     *
     * @return Commande
     */
    public function setUnClient($unClient)
    {
        $this->unClient = $unClient;

        return $this;
    }

    /**
     * @return string
     */
    public function getUneDate()
    {
        return Build::formaterDateEtHeure($this->uneDate);
    }

    /**
     * @param string $uneDate
     *
     * @return Commande
     */
    public function setUneDate($uneDate)
    {
        $this->uneDate = $uneDate;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getLesArticles()
    {
        return $this->lesArticles;
    }

    /**
     * @param Collection $lesArticles
     *
     * @return Commande
     */
    public function setLesArticles($lesArticles)
    {
        $this->lesArticles = $lesArticles;

        return $this;
    }

    /**
     * @return int
     */
    public function getMontantTotal()
    {
        $montant = 0;
        foreach ($this->getLesArticles()->getCollection() as $article) {
            $montant += $article->getPu() * $article->getQte();
        }

        return $montant;
    }
}
