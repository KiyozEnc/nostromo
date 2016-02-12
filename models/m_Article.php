<?php
require_once 'models/m_Connexion.php';
require_once 'classes/article.classe.php';

/**
 * Class MArticle
 *
 * @category Models
 * @package  Nostromo\Models
 * @author   Nostromo <contact@nostromo.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost
 */
class MArticle
{
    /**
     * @param int $ref
     *
     * @return Article
     * @throws InvalidArgumentException
     */
    static public function getArticle($ref)
    {
        try
        {
            $conn = Connexion::getBdd();
            $reqPrepare = $conn->prepare('SELECT * FROM article WHERE numArt = ?');
            $unArt = new Article();
            $reqPrepare->execute(array($ref));
            $reqPrepare = $reqPrepare->fetch();
            $unArt
                ->setNumArt($reqPrepare['numArt'])
                ->setDesignation($reqPrepare['designation'])
                ->setPu($reqPrepare['pu'])
                ->setQteStock($reqPrepare['qteStock']);
            $conn = null;
            return $unArt;

        }
        catch(PDOException $ex)
        {
            throw new InvalidArgumentException('Aucun article n\'existe sous cette référence.');
        }
    }
    static public function getArticles()
    {
        try
        {
            $conn = Connexion::getBdd();
            $reqPrepare = $conn->prepare('SELECT * FROM article');
            $reqPrepare->exec();
            $conn = null;
            return $reqPrepare->fetchAll(PDO::FETCH_CLASS, 'Article');

        }
        catch(PDOException $ex)
        {
            throw new InvalidArgumentException('Aucun article trouvé.');
        }
    }
}
