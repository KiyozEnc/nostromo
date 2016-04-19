<?php

namespace Nostromo\Models;

use Nostromo\Classes\Commande;
use Nostromo\Classes\Commander;
use Nostromo\Classes\Collection;
use InvalidArgumentException;
use Nostromo\Classes\Exception\ErrorSQLException;
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
     * @param bool $index
     *
     * @return Collection
     *
     * @throws InvalidArgumentException
     * @throws ErrorSQLException
     */
    public static function getUneCommande(Commande $uneCommande, $index = false)
    {
        $lesArticles = new Collection();
        try {
            $conn = MConnexion::getBdd();
            $conn->beginTransaction();
            $req = !$index ?
                $conn->prepare('SELECT * FROM commander INNER JOIN article ON commander.numArt = article.numArt WHERE numCde = ? ORDER BY pu DESC') :
                $conn->prepare('SELECT * FROM commander INNER JOIN article ON commander.numArt = article.numArt WHERE numCde = ? ORDER BY pu DESC LIMIT 2');
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

    public static function ajouterArticleCommande(Commander $unCommander)
    {
        try {
            $conn = MConnexion::getBdd();
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare(
                'INSERT INTO commander
                (numArt, numCde, qte)
                VALUES (?,?,?)'
            );
            $reqPrepare->execute(
                [
                    $unCommander->getUnArticle()->getNumArt(),
                    $unCommander->getUneCommande()->getId(),
                    $unCommander->getQte()
                ]
            );
            $conn->commit();
            $conn = null;
        } catch (PDOException $ex) {
            $conn->rollBack();
            throw new ErrorSQLException('Impossible de continuer la validation de la commande. Détails : '.$ex->getMessage());
        }
    }
}
