<?php

/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 11/02/2016
 * Time: 01:46
 */
class Echeance
{
    /**
     * @var Reservation
     */
    protected $_reservation;
    /**
     * @var int
     */
    protected $_montant;
    /**
     * @var string
     */
    protected $_date;

    /**
     * Echeance constructor.
     * @param Reservation $_reservation
     * @param int $_montant
     * @param string $_date
     */
    public function __construct(Reservation $_reservation, $_montant, $_date)
    {
        $this->_reservation = $_reservation;
        $this->_montant = $_montant;
        $this->_date = $_date;
    }

    /**
     * @return Reservation
     */
    public function getReservation()
    {
        return $this->_reservation;
    }

    /**
     * @param Reservation $reservation
     *
     * @return Echeance
     */
    public function setReservation($reservation)
    {
        $this->_reservation = $reservation;

        return $this;
    }

    /**
     * @return int
     */
    public function getMontant()
    {
        return $this->_montant;
    }

    /**
     * @param int $montant
     *
     * @return Echeance
     */
    public function setMontant($montant)
    {
        $this->_montant = $montant;

        return $this;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->_date;
    }

    /**
     * @param string $date
     *
     * @return Echeance
     */
    public function setDate($date)
    {
        $this->_date = $date;

        return $this;
    }

    /**
     * Récupère le temps restant avant l'échéance
     * On récupéra la date en cours et la date de la réservation
     */
    public function getTimeLeft()
    {

    }

}