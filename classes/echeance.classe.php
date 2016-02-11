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
    protected $oReservation;
    /**
     * @var int
     */
    protected $iMontant;
    /**
     * @var string
     */
    protected $sDate;

    /**
     * Echeance constructor.
     * @param Reservation $oReservation
     * @param int $iMontant
     * @param string $sDate
     */
    public function __construct(Reservation $oReservation, $iMontant, $sDate)
    {
        $this->oReservation = $oReservation;
        $this->iMontant = $iMontant;
        $this->sDate = $sDate;
    }

    /**
     * @return Reservation
     */
    public function getOReservation()
    {
        return $this->oReservation;
    }

    /**
     * @param Reservation $oReservation
     * @return Echeance
     */
    public function setOReservation($oReservation)
    {
        $this->oReservation = $oReservation;
        return $this;
    }

    /**
     * @return int
     */
    public function getIMontant()
    {
        return $this->iMontant;
    }

    /**
     * @param int $iMontant
     * @return Echeance
     */
    public function setIMontant($iMontant)
    {
        $this->iMontant = $iMontant;
        return $this;
    }

    /**
     * @return string
     */
    public function getSDate()
    {
        return DateVol::formaterDateEtHeure($this->sDate);
    }

    /**
     * @param string $sDate
     * @return Echeance
     */
    public function setSDate($sDate)
    {
        $this->sDate = $sDate;
        return $this;
    }

    /**
     * Récupère le temps restant avant l'échéance
     *
     * On récupéra la date en cours et la date de la réservation
     */
    public function getTimeLeft()
    {

    }

}