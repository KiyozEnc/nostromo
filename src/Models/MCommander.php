<?php

namespace Nostromo\Models;

use Nostromo\Classes\Commande;
use Nostromo\Classes\Collection;
use InvalidArgumentException;
use PDOException;

/**
 * Class MCommander.
 *
 * @category Models
 *
 * @author   Nostromo <contact@nostromo.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 */
class MCommander
{
    /**
     * Récupère les articles d'un commande via la commande.
     *
     * @param Commande $uneCommande numéro d'une commande
     *
     * @return Collection
     *
     * @throws InvalidArgumentException
     */
    public static function getUneCommande(Commande $uneCommande)
    {
        $lesArticles = new Collection();
        try {
            $conn = MConnexion::getBdd();
            $conn->beginTransaction();
            $req = $conn->prepare('SELECT * FROM commander WHERE numCde = ? ORDER BY numArt DESC LIMIT 2');
            $req->execute(array($uneCommande->getId()));
            $req = $req->fetchAll();
            foreach ($req as $tabs) {
                $unArticle = MArticle::getArticle($tabs['numArt']);
                $unArticle->setQte($tabs['qte']);
                $lesArticles->ajouter($unArticle);
            }
            $conn->commit();
        } catch (PDOException $e) {
            throw new InvalidArgumentException(
                'Impossible de récupérer la commande n°'.$uneCommande->getId().' Détails : '.$e->getMessage()
            );
        }

        return $lesArticles;
    }

    public static function setAjoutCommander(Commander $commander)
    {
        try {
            $conn = MConnexion::getBdd();
            $reqPrepare = $conn->prepare(
                'INSERT INTO commander
                (numArt,numCde,qte)
                VALUES (?,?,?)'
            );
            $reqPrepare->execute(
                array(
                    $commander->getUnArticle(),
                    $commander->getUneCommande(),
                    $commander->getQte()
                    )
            );
            $conn = null;
        } catch (PDOException $ex) {
            throw new ErrorSQLException('Impossible de continuer la validation de la commande. Détails : '.$ex->getMessage());
        }
    }
}
