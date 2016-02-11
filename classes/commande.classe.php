<?php

/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 25/01/2016
 * Time: 14:36
 */
class Commande
{
    /**
     * @var int
     */
    private $_id;
    /**
     * @var Utilisateur
     */
    private $_unClient;
    /**
     * @var string
     */
    private $_uneDate;
    /**
     * @var Collection
     */
    private $_lesArticles;

    /**
     * Commande constructor.
     *
     * @param int         $id
     * @param Utilisateur $unClient
     * @param string      $uneDate
     */
    public function __construct($id, Utilisateur $unClient, $uneDate)
    {
        $this->_id = $id;
        $this->_unClient = $unClient;
        $this->_uneDate = $uneDate;
        $this->_lesArticles = new Collection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param int $id
     *
     * @return Commande
     */
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * @return Utilisateur
     */
    public function getUnClient()
    {
        return $this->_unClient;
    }

    /**
     * @param Utilisateur $unClient
     * @return Commande
     */
    public function setUnClient($unClient)
    {
        $this->_unClient = $unClient;
        return $this;
    }

    /**
     * @return string
     */
    public function getUneDate()
    {
        return DateVol::formaterDateEtHeure($this->_uneDate);
    }

    /**
     * @param string $uneDate
     * @return Commande
     */
    public function setUneDate($uneDate)
    {
        $this->_uneDate = $uneDate;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getLesArticles()
    {
        return $this->_lesArticles;
    }

    /**
     * @param Collection $lesArticles
     * @return Commande
     */
    public function setLesArticles($lesArticles)
    {
        $this->_lesArticles = $lesArticles;
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