<?php

namespace Nostromo\Models;

use InvalidArgumentException;
use Nostromo\Classes\Commande;
use PDOException;
use Nostromo\Classes\Utilisateur;
use Nostromo\Classes\Collection;

/**
 * Class MCommande.
 *
 * @category Models
 *
 * @author   Nostromo <contact@nostromo.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 */
class MCommande
{
    /**
     * Récupère la commande dont le numéro est passé en paramètre.
     *
     * @param int $id numéro d'une commande
     *
     * @return Commande $uneCommande
     *
     * @throws InvalidArgumentException
     */
    public static function getUneCommande($id)
    {
        try {
            $conn = MConnexion::getBdd();
            $req = $conn->prepare('SELECT * FROM commande WHERE numCde = ?');
            $req->execute(array($id));
            $req = $req->fetch();
            $unClient = MUtilisateur::getUnUser($req['numClt']);
            $uneCommande = new Commande($id, $unClient, $req['date']);
            $uneCommande->setLesArticles(MCommander::getUneCommande($uneCommande));

            return $uneCommande;
        } catch (PDOException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }
    /**
     * Récupère les commandes dont l'utilisateur est passé en paramètre.
     *
     * @param Utilisateur $unClient
     *
     * @return Collection $lesCommandes
     *
     * @throws InvalidArgumentException
     */
    public static function getCommandes(Utilisateur $unClient)
    {
        $lesCommandes = new Collection();
        try {
            $conn = MConnexion::getBdd();
            $req = $conn->prepare('SELECT * FROM commande WHERE numClt = ? ORDER BY numCde DESC LIMIT 2');
            $req->execute(array($unClient->getId()));
            $req = $req->fetchAll();
            foreach ($req as $tabs) {
                $uneCommande = new Commande($tabs['numCde'], $unClient, $tabs['date']);
                $uneCommande->setLesArticles(MCommander::getUneCommande($uneCommande));
                $lesCommandes->ajouter($uneCommande);
            }
        } catch (PDOException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }

        return $lesCommandes;
    }

    public static function setAjoutCommande(Commande $uneCommande)
    {
        try {
            $conn = MConnexion::getBdd();
            $reqPrepare = $conn->prepare(
                'INSERT INTO commander
                (numClt,date)
                VALUES (?,?)'
            );
            $reqPrepare->execute(
                array(
                    $uneCommande->getUneClient(),
                    $uneCommande->getUneDate()
                    )
            );
            $conn = null;
        } catch (PDOException $ex) {
            throw new ErrorSQLException('Impossible de continuer la validation de la commande. Détails : '.$ex->getMessage());
        }
    }
}
