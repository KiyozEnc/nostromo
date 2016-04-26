<?php

namespace Nostromo\Classes;

/**
 * Class Echeance
 * @package Nostromo\Classes
 */
class Echeance
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var Reservation
     */
    protected $reservation;
    /**
     * @var int
     */
    protected $montant;
    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * Echeance constructor.
     *
     * @param Reservation    $reservation
     * @param int            $montant
     * @param \DateTime      $date
     */
    public function __construct(Reservation $reservation, $montant, \DateTime $date)
    {
        $this->reservation = $reservation;
        $this->montant = $montant;
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param int $id
     * @return Echeance
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return Reservation
     */
    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * @param Reservation $reservation
     *
     * @return Echeance
     */
    public function setReservation($reservation)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * @return int
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param int $montant
     *
     * @return Echeance
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     *
     * @return Echeance
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Récupère le temps restant avant l'échéance
     * On récupéra la date en cours et la date de la réservation.
     *
     * @return int
     */
    public function getTimeLeft()
    {
        $dateEnCours = new \DateTime();
        $dateVol = new \DateTime($this->reservation->getUnVol()->getNonFormatDate());
        return $dateVol->diff($dateEnCours)->format('%a');
    }

    /**
     * Récupère le montant au format EUR
     *
     * @return string
     */
    public function getPrice()
    {
        return 'EUR '.$this->montant;
    }
}
