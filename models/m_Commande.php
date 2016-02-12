<?php
require_once 'm_Connexion.php';
require_once 'm_ConnexionSite.php';

/**
 * Class MCommande
 *
 * @category Models
 * @package  Nostromo\Models
 * @author   Nostromo <contact@nostromo.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost
 */
class MCommande
{

    /**
     * Récupère la commande dont le numéro est passé en paramètre
     * @param int $id numéro d'une commande
     * @return Commande $uneCommande
     * @throws InvalidArgumentException
     */
    static public function getUneCommande($id)
    {
        try
        {
            $conn = Connexion::getBdd();
            $req = $conn->prepare('SELECT * FROM commande WHERE numCde = ?');
            $req->execute(array($id));
            $req = $req->fetch();
            $unClient = ConnexionSite::getUnUser($req['numClt']);
            $uneCommande = new Commande($id, $unClient, $req['date']);
            $uneCommande->setLesArticles(MCommander::getUneCommande($uneCommande));
            return $uneCommande;
        }
        catch(PDOException $e)
        {
            throw new InvalidArgumentException($e->getMessage());
        }
    }
    /**
     * Récupère les commandes dont l'utilisateur est passé en paramètre
     * @param Utilisateur $unClient
     * @return Collection $lesCommandes
     * @throws InvalidArgumentException
     */
    static public function getCommandes(Utilisateur $unClient)
    {
        $lesCommandes = new Collection();
        try
        {
            $conn = Connexion::getBdd();
            $req = $conn->prepare('SELECT * FROM commande WHERE numClt = ?');
            $req->execute(array($unClient->getId()));
            $req = $req->fetchAll();
            foreach ($req as $tabs) {
                $uneCommande = new Commande($tabs['numCde'], $unClient, $tabs['date']);
                $uneCommande->setLesArticles(MCommander::getUneCommande($uneCommande));
                $lesCommandes->ajouter($uneCommande);
            }
        }
        catch(PDOException $e)
        {
            throw new InvalidArgumentException($e->getMessage());
        }
        return $lesCommandes;
    }
}