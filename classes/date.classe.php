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
}
