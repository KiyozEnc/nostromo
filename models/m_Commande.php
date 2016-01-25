<?php
require_once 'm_Connexion.php';
/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 25/01/2016
 * Time: 14:42
 */
class MCommande
{
    /**
     * Récupère la commande dont le numéro est passé en paramètre
     * @param int $id numéro d'une commande
     * @throws Exception
     */
    static public function getUneCommande($id)
    {
        try
        {
            $conn = Connexion::getBdd();
            $req = $conn->prepare("SELECT * FROM commande WHERE numCde = ?");
            $req->execute(array($id));
            $req = $req->fetch();
            $unClient = ConnexionSite::getUnUser($req['numClt']);
            $uneCommande = new Commande($id,$unClient,$req["date"]);
            $uneCommande->setLesArticles(MCommander::getUneCommande($uneCommande));
        }
        catch(PDOException $e)
        {
            throw new Exception ($e->getMessage());
        }
    }
    /**
     * Récupère les commandes dont l'utilisateur est passé en paramètre
     * @param Utilisateur $unClient
     * @return Collection $lesCommandes
     * @throws Exception
     */
    static public function getCommandes(Utilisateur $unClient)
    {
        $lesCommandes = new Collection();
        try
        {
            $conn = Connexion::getBdd();
            $req = $conn->prepare("SELECT * FROM commande WHERE numClt = ?");
            $req->execute(array($unClient->getId()));
            $req = $req->fetchAll();
            foreach ($req as $tabs)
            {
                $uneCommande = new Commande($tabs['numCde'],$unClient,$tabs["date"]);
                $uneCommande->setLesArticles(MCommander::getUneCommande($uneCommande));
                $lesCommandes->ajouter($uneCommande);
            }
        }
        catch(PDOException $e)
        {
            throw new Exception ($e->getMessage());
        }
        return $lesCommandes;
    }
}