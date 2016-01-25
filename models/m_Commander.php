<?php

require_once ("m_Connexion.php");
/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 25/01/2016
 * Time: 14:53
 */
class MCommander
{
    /**
     * Récupère les articles d'un commande via la commande
     * @param Commande $uneCommande numéro d'une commande
     * @return Collection
     * @throws Exception
     */
    static public function getUneCommande(Commande $uneCommande)
    {
        $lesArticles = new Collection();
        try
        {
            $conn = Connexion::getBdd();
            $req = $conn->prepare("SELECT * FROM commander WHERE numCde = ? LIMIT 3");
            $req->execute(array($uneCommande->getId()));
            $req = $req->fetchAll();
            foreach($req as $tabs)
            {
                $unArticle = MArticle::getArticle($tabs['numArt']);
                $unArticle->setQte($tabs['qte']);
                $lesArticles->ajouter($unArticle);
            }
        }
        catch(PDOException $e)
        {
            throw new Exception ("Impossible de récupérer la commande n°$uneCommande->getId(). Détails : ".$e->getMessage());
        }
        return $lesArticles;
    }
}