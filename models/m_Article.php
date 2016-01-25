<?php
require_once "models/m_Connexion.php";
require_once "classes/article.classe.php";
class MArticle
{
    static public function getArticle($ref)
    {
        try
        {
            $conn = Connexion::getBdd();
            $reqPrepare = $conn->prepare("SELECT * FROM article WHERE numArt = ?");
            $unArt = new Article();
            $reqPrepare->execute(array($ref));
            $reqPrepare = $reqPrepare->fetch();
            $unArt
                ->setNumArt($reqPrepare['numArt'])
                ->setDesignation($reqPrepare["designation"])
                ->setPu($reqPrepare['pu'])
                ->setQteStock($reqPrepare['qteStock'])
            ;
            $conn = null;
            return $unArt;

        }
        catch(PDOException $ex)
        {
            echo "Aucun article n'existe sous cette référence.";
        }
    }
    static public function getArticles()
    {
        try
        {
            $conn = Connexion::getBdd();
            $reqPrepare = $conn->prepare("SELECT * FROM article");
            $reqPrepare->execute();
            $conn = null;
            return $reqPrepare->fetchAll(PDO::FETCH_CLASS, "Article");

        }
        catch(PDOException $ex)
        {
            echo "Aucun article trouvé.";
        }
    }
}
