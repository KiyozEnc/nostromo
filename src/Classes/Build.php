<?php

namespace Nostromo\Classes;

class Build
{
    const TYPE_RESERVATION = 1200;
    const TYPE_COMMANDE = 'Commande';
    /**
     * Formate une chaîne de caractère de type Time en format français.
     *
     * @param string $dateDuVol
     *
     * @return string
     */
    public static function formaterDate($dateDuVol)
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
    public static function formaterHeure($heureDuVol)
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
    public static function formaterDateEtHeure($var)
    {
        $year = substr($var, 0, -15);
        $month = substr($var, 5, -12);
        $day = substr($var, 8, -9);
        $hour = substr($var, 10, -6);
        $min = substr($var, 14, -3);

        return $day.'/'.$month.'/'.$year.' à '.$hour.':'.$min;
    }

    public static function formaterEuro($arg)
    {
        return number_format($arg, 2, ',', ' ').' €';
    }
    public static function formaterDateTimeWithDate(\DateTime $arg)
    {
        return $arg->format('d/m/Y');
    }
    public static function formaterDateTimeWithTime(\DateTime $arg)
    {
        return $arg->format('d/m/Y H:i:s');
    }

    /**
     * @param float $price
     * @param int $type
     *
     * @return int
     */
    public static function getNewPoints($price, $type = self::TYPE_RESERVATION)
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

    public static function genererUrlImgAvion()
    {
        return 'public/Resources/img/avion.png';
    }

    /**
     * Retourne le mois au format string de la date (en string) passée en paramètre (format Y-m-d)
     *
     * @param $dateString
     * @return string
     */
    public static function formaterFr($dateString)
    {
        $lesMois = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        $mois = substr($dateString, 5, -3);
        if (substr($mois, 0, 1) === '0') {
            $mois = substr($mois, 1, 2);
        }
        return $lesMois[$mois - 1];
    }
}
