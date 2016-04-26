<?php

namespace Nostromo\Classes;

/**
 * Class Commande
 * @package Nostromo\Classes
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
     * Retourne le montant de la commande avec remise
     *
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
     * Retourne le montant de la commande sans remise.
     *
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
     * Retourne le montant de la remise
     *
     * @return float
     */
    public function getMontantRemise()
    {
        return $this->getMontantTotalNoRemise() - $this->getMontantTotal();
    }

    /**
     * Get PointsUtilise.
     *
     * @return int
     */
    public function getPointsUtilise()
    {
        return $this->pointsUtilise;
    }

    /**
     * Set PointsUtilise.
     *
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
