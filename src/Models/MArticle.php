<?php

namespace Nostromo\Models;

use Nostromo\Classes\Article;
use Nostromo\Classes\Collection;
use Nostromo\Classes\Exception\CollectionException;
use Nostromo\Classes\Exception\ErrorSQLException;
use PDOException;

/**
 * Class MArticle
 * @package Nostromo\Models
 */
class MArticle
{
    /**
     * Récupère un article numéro $ref
     *
     * @param int $ref
     *
     * @return Article
     *
     * @throws ErrorSQLException
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
                ->setDescription($reqPrepare['description'])
                ->setPu($reqPrepare['pu'])
                ->setQteStock($reqPrepare['qteStock'])
                ->setUrl($reqPrepare['url']);
            $conn = null;

            return $unArt;
        } catch (PDOException $ex) {
            throw new ErrorSQLException('Aucun article n\'existe sous cette référence.');
        }
    }

    /**
     * Récupère les articles.
     *
     * @return Collection
     *
     * @throws ErrorSQLException
     * @throws CollectionException
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
                    ->setDescription($unArticle['description'])
                    ->setPu($unArticle['pu'])
                    ->setQteStock($unArticle['qteStock'])
                    ->setUrl($unArticle['url']);
                $lesArticles->ajouter($article);
            }
            $conn = null;

            return $lesArticles;
        } catch (PDOException $ex) {
            throw new ErrorSQLException('Aucun article trouvé.');
        }
    }

    /**
     * Met à jour le stock de l'article passé en paramètre
     * lorsqu'un client finalise sa commande
     *
     * @param Article $article
     * @param int $qteCommande
     * @throws ErrorSQLException
     */
    public static function updateQteStock(Article $article, $qteCommande)
    {
        $conn = MConnexion::getBdd();
        try {
            $conn->beginTransaction();
            $req = $conn->prepare('UPDATE article SET qteStock = ? WHERE numArt = ?');
            $qte = ($article->getQteStock() - $qteCommande) < 0 ? 0 : $article->getQteStock() - $qteCommande;
            $req->execute([$qte, $article->getNumArt()]);
            $conn->commit();
            $conn = null;
        } catch (PDOException $e) {
            $conn->rollBack();
            throw new ErrorSQLException($e->getMessage());
        }
    }
}
