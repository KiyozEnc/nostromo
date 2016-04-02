<?php

require __DIR__.'/../../../vendor/autoload.php';

use Nostromo\Models\MConnexion;

function getArticle($id)
{
    $conn = MConnexion::getBdd();
    $resultats = $conn->prepare('SELECT * FROM article WHERE numArt = ?');
    $resultats->execute([$id]);
    $resultats->setFetchMode(PDO::FETCH_OBJ);
    return $resultats->fetch();
}

$article = getArticle($_GET['id']);
header('Content-Type: application/json');
echo utf8_encode(json_encode(['result' => $article]));
