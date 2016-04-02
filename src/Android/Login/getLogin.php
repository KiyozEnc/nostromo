<?php

require __DIR__.'/../../../vendor/autoload.php';

use Nostromo\Models\MConnexion;

function getLogin($email, $pwd)
{
    $conn = MConnexion::getBdd();
    $resultats = $conn->prepare('SELECT * FROM client WHERE mailClt = ? AND mdpClt = ?');
    $resultats->execute([$email, sha1($pwd)]);
    $resultats->setFetchMode(PDO::FETCH_OBJ);
    return $resultats->fetch();
}

$user = getLogin($_GET['email'], $_GET['pwd']);
header('Content-Type: application/json');
echo utf8_encode(json_encode(['result' => $user]));
