<?php

require __DIR__.'/../../../vendor/autoload.php';

use Nostromo\Models\MConnexion;

function getArticles()
{
    $conn = MConnexion::getBdd();
    $resultats = $conn->query('SELECT * FROM article');
    $resultats->setFetchMode(PDO::FETCH_OBJ);
    return $resultats->fetchAll();
}

$articles = getArticles();
header('Content-Type: application/json');
echo utf8_encode(json_encode(['result' => $articles]));
