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
     * @var int
     */
    private $pointsUtilise;

    /**
     * Commande constructor.
     *
     * @param int         $id
     * @param Utilisateur $unClient
     * @param string      $uneDate
     * @param int         $pointsUtilise
     */
    public function __construct($id, Utilisateur $unClient, $uneDate, $pointsUtilise = 0)
    {
        $this->id = $id;
        $this->unClient = $unClient;
        $this->uneDate = $uneDate;
        $this->lesArticles = new Collection();
        $this->pointsUtilise = $pointsUtilise;
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
        return $this->uneDate;
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
     * @return float
     */
    public function getMontantTotal()
    {
        $montant = 0;
        foreach ($this->getLesArticles()->getCollection() as $article) {
            $montant += $article->getPu() * $article->getQte();
        }

        return $montant * $this->calculPourcentRemise();
    }

    /**
     * @return float
     */
    public function getMontantTotalNoRemise()
    {
        $montant = 0;
        foreach ($this->getLesArticles()->getCollection() as $article) {
            $montant += $article->getPu() * $article->getQte();
        }

        return $montant;
    }

    /**
     * @return float
     */
    public function getMontantRemise()
    {
        $montant = 0;
        foreach ($this->getLesArticles()->getCollection() as $article) {
            $montant += ($article->getPu() * $article->getQte()) - ($article->getPu() * $article->getQte())*$this->calculPourcentRemise();
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
     * @return Commande
     */
    public function setPointsUtilise($pointsUtilise)
    {
        $this->pointsUtilise = $pointsUtilise;
        return $this;
    }

    /**
     * Donne le multiplicateur à appliquer au prix à remiser
     *
     * @return float
     */
    public function calculPourcentRemise()
    {
        $reduc = 1;
        for ($i = 0; $i < $this->pointsUtilise; $i += Reservation::STEP_POINTS) {
            $reduc -= round(Reservation::STEP_REDUCTION * 1.5, 2);
        }
        if ($this->pointsUtilise < Reservation::STEP_POINTS) {
            $reduc = 1;
        }
        return (float) $reduc;
    }
}
