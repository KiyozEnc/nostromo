<?php

namespace Nostromo\Models;

use InvalidArgumentException;
use Nostromo\Classes\Commande;
use Nostromo\Classes\Exception\ErrorSQLException;
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
     * @throws \InvalidArgumentException
     * @throws ErrorSQLException
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
            throw new ErrorSQLException($e->getMessage());
        }
    }
    /**
     * Récupère les commandes dont l'utilisateur est passé en paramètre.
     *
     * @param Utilisateur $unClient
     * @param bool $index
     *
     * @return Collection $lesCommandes
     *
     * @throws \InvalidArgumentException
     * @throws ErrorSQLException
     */
    public static function getCommandes(Utilisateur $unClient, $index = false)
    {
        $lesCommandes = new Collection();
        try {
            $conn = MConnexion::getBdd();
            $req = !$index ?
                $conn->prepare('SELECT * FROM commande WHERE numClt = ? ORDER BY date DESC') :
                $conn->prepare('SELECT * FROM commande WHERE numClt = ? ORDER BY date DESC LIMIT 2');
            $req->execute(array($unClient->getId()));
            $req = $req->fetchAll();
            foreach ($req as $tabs) {
                $uneCommande = new Commande($tabs['numCde'], $unClient, $tabs['date']);
                $uneCommande->setLesArticles(MCommander::getUneCommande($uneCommande));
                $lesCommandes->ajouter($uneCommande);
            }
        } catch (PDOException $e) {
            throw new ErrorSQLException($e->getMessage());
        }

        return $lesCommandes;
    }

    public static function ajouterCommande(Commande $uneCommande)
    {
        try {
            $conn = MConnexion::getBdd();
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare(
                'INSERT INTO commande
                (numClt,date)
                VALUES (?,?)'
            );
            $reqPrepare->execute([$uneCommande->getUnClient()->getId(), $uneCommande->getUneDate()]);
            $conn->commit();
            $conn = null;
        } catch (PDOException $ex) {
            $conn->rollBack();
            throw new ErrorSQLException('Impossible de continuer la validation de la commande. Détails : '.$ex->getMessage());
        }
    }
}
