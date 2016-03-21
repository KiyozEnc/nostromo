<?php

require __DIR__.'/../../../vendor/autoload.php';

use Nostromo\Models\MConnexion;

function getVols()
{
    $conn = MConnexion::getBdd();
    $resultats = $conn->query('SELECT * FROM vol
                                        WHERE DATE_ADD(CURDATE(), INTERVAL -1 DAY) < dateVol
                                        ORDER BY dateVol');
    $resultats->setFetchMode(PDO::FETCH_OBJ);
    return $resultats->fetchAll();
}

$vols = getVols();
header('Content-Type: application/json');
echo utf8_encode(json_encode(['result' => $vols]));
