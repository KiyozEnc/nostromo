<?php

namespace Nostromo\Models;

use Nostromo\Classes\Article;
use InvalidArgumentException;
use Nostromo\Classes\Collection;
use PDOException;

/**
 * Class MArticle.
 *
 * @category Models
 *
 * @author   Nostromo <contact@nostromo.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @link     localhost
 */
class MArticle
{
    /**
     * @param int $ref
     *
     * @return Article
     *
     * @throws InvalidArgumentException
     */
    public static function getArticle($ref)
    {
        try {
            $conn = MConnexion::getBdd();
            $reqPrepare = $conn->prepare('SELECT * FROM article WHERE numArt = ?');
            $unArt = new Article();
            $reqPrepare->execute(array($ref));
            $reqPrepare = $reqPrepare->fetch();
            $unArt
                ->setNumArt($reqPrepare['numArt'])
                ->setDesignation($reqPrepare['designation'])
                ->setPu($reqPrepare['pu'])
                ->setQteStock($reqPrepare['qteStock'])
                ->setUrl($reqPrepare['url']);
            $conn = null;

            return $unArt;
        } catch (PDOException $ex) {
            throw new InvalidArgumentException('Aucun article n\'existe sous cette référence.');
        }
    }

    /**
     * Récupère les articles.
     *
     * @return Collection
     *
     * @throws InvalidArgumentException
     */
    public static function getArticles()
    {
        $lesArticles = new Collection();
        try {
            $conn = MConnexion::getBdd();
            $reqPrepare = $conn->query('SELECT * FROM article');
            $reqPrepare = $reqPrepare->fetchAll();
            foreach ($reqPrepare as $unArticle) {
                $article = new Article();
                $article
                    ->setNumArt($unArticle['numArt'])
                    ->setDesignation($unArticle['designation'])
                    ->setPu($unArticle['pu'])
                    ->setQteStock($unArticle['qteStock'])
                    ->setUrl($unArticle['url']);
                $lesArticles->ajouter($article);
            }
            $conn = null;

            return $lesArticles;
        } catch (PDOException $ex) {
            throw new InvalidArgumentException('Aucun article trouvé.');
        }
    }
}
