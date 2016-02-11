<?php

class DateVol
{
    static public function formaterDate($dateDuVol)
    {
        $year = substr($dateDuVol, 0, -6);
        $month = substr($dateDuVol, 5, -3);
        $day = substr($dateDuVol, 8);
        $dateDuVol = $day.'/'.$month.'/'.$year;
        return $dateDuVol;
    }
    static public function formaterHeure($heureDuVol)
    {
        $heure = substr($heureDuVol, 0, -3);
        return $heure;
    }
    static public function formaterDateEtHeure($var)
    {
        $year = substr($var, 0, -15);
        $month = substr($var, 5, -12);
        $day = substr($var, 8, -9);
        $hour = substr($var, 10, -6);
        $min = substr($var, 14, -3);
        return $day.'/'.$month.'/'.$year.' à '.$hour.':'.$min;
    }
}
