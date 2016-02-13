<?php
namespace Nostromo\Models;

use Nostromo\Classes\Commande;
use Nostromo\Classes\Collection;
use InvalidArgumentException;
use PDOException;

/**
 * Class MCommander
 *
 * @category Models
 * @package  Nostromo\Models
 * @author   Nostromo <contact@nostromo.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost
 */
class MCommander
{
    /**
     * Récupère les articles d'un commande via la commande
     * @param Commande $uneCommande numéro d'une commande
     * @return Collection
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
}
