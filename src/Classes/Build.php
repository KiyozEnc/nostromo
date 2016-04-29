<?php

namespace Nostromo\Classes;

/**
 * Class Build
 * Classe statique qui permet divers actions en communs sur toutes les pages.
 * @package Nostromo\Classes
 */
class Build
{
    /**
     * Interval de gain de points de fidélité pour les réservations.
     */
    const TYPE_RESERVATION = 1200;

    /**
     * Interval de gain de points de fidélité pour les commandes (actuellement 10% du montant de la commande).
     */
    const TYPE_COMMANDE = 'Commande';

    /**
     * Formate une chaîne de caractère de type Time en format français.
     *
     * @param string $dateDuVol
     *
     * @return string
     */
    public static function fDate($dateDuVol)
    {
        $year = substr($dateDuVol, 0, -6);
        $month = substr($dateDuVol, 5, -3);
        $day = substr($dateDuVol, 8);

        return $day.'/'.$month.'/'.$year;
    }

    /**
     * Formate une chaine de caractères de type date en format français.
     *
     * @param string $heureDuVol
     *
     * @return string
     */
    public static function fHeure($heureDuVol)
    {
        return substr($heureDuVol, 0, -3);
    }

    /**
     * Formate une chaine de caractères de type DateTime en format français.
     *
     * @param string $var
     *
     * @return string
     */
    public static function fDateHeure($var)
    {
        $year = substr($var, 0, -15);
        $month = substr($var, 5, -12);
        $day = substr($var, 8, -9);
        $hour = substr($var, 10, -6);
        $min = substr($var, 14, -3);

        return $day.'/'.$month.'/'.$year.' à '.$hour.':'.$min;
    }

    /**
     * Formate une chaîne de caractères de type Number en format Euro français.
     *
     * @param double $arg
     *
     * @return string
     */
    public static function fEuro($arg)
    {
        return number_format($arg, 2, ',', ' ').' €';
    }

    /**
     * Formate un objet de type \DateTime en extrayant seulement la date sans l'heure
     *
     * @param \DateTime $arg
     * @return string
     */
    public static function fDateTimeDate(\DateTime $arg)
    {
        return $arg->format('d/m/Y');
    }

    /**
     * Formate un objet de type \DateTime en extrayant la date avec l'heure
     *
     * @param \DateTime $arg
     * @return string
     */
    public static function fDateTimeTime(\DateTime $arg)
    {
        return $arg->format('d/m/Y H:i:s');
    }

    /**
     * Permet de récupérer le nombre de points qui sera attribués suite à cette commande
     *
     * @param float $price
     * @param int $type
     *
     * @return int
     */
    public static function newPoints($price, $type = self::TYPE_RESERVATION)
    {
        $points = 0;
        if ($type === self::TYPE_COMMANDE) {
            $points = (int) $price / 100;
        } else {
            for ($i = 0; $i < $price; $i += $type) {
                $points++;
            }
        }
        return $points;
    }

    /**
     * Génère l'Url d'accès à l'image des vols.
     *
     * @return string
     */
    public static function genererUrlImgAvion()
    {
        return 'public/Resources/img/avion.png';
    }
}
