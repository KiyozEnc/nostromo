<?php

class DateVol
{

	static public function formaterDate($dateDuVol)
	{
		$Year = substr($dateDuVol, 0, -6);
		$Month = substr($dateDuVol, 5, -3);
		$Day = substr($dateDuVol, 8);
		$dateDuVol = $Day.'/'.$Month.'/'.$Year;
		return $dateDuVol;
	}
	static public function formaterHeure($heureDuVol)
	{
		$Heure = substr($heureDuVol, 0, -3);
		return $Heure;
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
