<?php

namespace Nostromo\Models;

use Nostromo\Classes\Exception\ErrorSQLException;
use Nostromo\Classes\Utilisateur;
use PDOException;

/**
 * Class MUtilisateur.
 *
 * @category Models
 *
 * @author   Nostromo <contact@nostromo.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @link     localhost
 */
class MUtilisateur
{
    /**
     * @param string $email
     *
     * @return Utilisateur
     *
     * @throws ErrorSQLException
     */
    public static function getUser($email)
    {
        $unClient = new Utilisateur();
        try {
            $conn = MConnexion::getBdd();
            $result = $conn->prepare('SELECT * FROM client WHERE mailClt = ?');
            $result->execute([$email]);
            $result = $result->fetch();
            $unClient
                ->setId($result['numClt'])
                ->setNom($result['nomClt'])
                ->setPrenom($result['prenomClt'])
                ->setAdresse($result['adresseClt'])
                ->setCp($result['cpClt'])
                ->setVille($result['villeClt'])
                ->setMdp($result['mdpClt'])
                ->setMail($result['mailClt'])
                ->setPoints($result['pointsClt']);
            $conn = null;
        } catch (PDOException $ex) {
            throw new ErrorSQLException("L'utilisateur avec l'adresse mail $email n'existe pas.");
        }

        return $unClient;
    }

    /**
     * @param Utilisateur $unClient
     *
     * @throws ErrorSQLException
     */
    public static function setAjoutUser(Utilisateur $unClient)
    {
        try {
            $conn = MConnexion::getBdd();
            $reqPrepare = $conn->prepare(
                'INSERT INTO client
                (nomClt, prenomClt, adresseClt, cpClt, villeClt, mdpClt, mailClt, pointsClt)
                VALUES (?,?,?,?,?,?,?,?)'
            );
            $reqPrepare->execute(
                array(
                    $unClient->getNom(),
                    $unClient->getPrenom(),
                    $unClient->getAdresse(),
                    $unClient->getCp(),
                    $unClient->getVille(),
                    $unClient->getMdp(),
                    $unClient->getMail(),
                    $unClient->getPoints(), )
            );
            $conn = null;
        } catch (PDOException $ex) {
            throw new ErrorSQLException('Impossible de continuer l\'inscription. Détails : '.$ex->getMessage());
        }
    }

    /**
     * @param int $id
     *
     * @return Utilisateur
     *
     * @throws ErrorSQLException
     */
    public static function getUnUser($id)
    {
        $unClient = new Utilisateur();
        try {
            $conn = MConnexion::getBdd();
            $reqPrepare = $conn->prepare('SELECT * FROM client WHERE numClt = ?');
            $reqPrepare->execute([$id]);
            $reqPrepare = $reqPrepare->fetch();
            $unClient
                ->setId($reqPrepare['numClt'])
                ->setNom($reqPrepare['nomClt'])
                ->setPrenom($reqPrepare['prenomClt'])
                ->setAdresse($reqPrepare['adresseClt'])
                ->setCp($reqPrepare['cpClt'])
                ->setVille($reqPrepare['villeClt'])
                ->setMdp($reqPrepare['mdpClt'])
                ->setMail($reqPrepare['mailClt'])
                ->setPoints($reqPrepare['pointsClt']);
            $conn = null;
        } catch (PDOException $ex) {
            throw new ErrorSQLException("L'utilisateur n°$id n'existe pas.");
        }

        return $unClient;
    }

    /**
     * Met à jour un utilisateur dans la base de données dont l'utilisateur est passé en paramètre.
     *
     * @param Utilisateur $user
     *
     * @throws ErrorSQLException
     */
    public static function updateUser(Utilisateur $user)
    {
        try {
            $conn = MConnexion::getBdd();
            $result = $conn->prepare(
                'UPDATE client
                SET nomClt = ?,
                prenomClt = ?,
                adresseClt = ?,
                cpClt = ?,
                villeClt = ?,
                mdpClt = ?,
                mailClt = ?,
                pointsClt = ?
                WHERE numClt = ?;'
            );
            $result->execute(
                [
                    $user->getNom(),
                    $user->getPrenom(),
                    $user->getAdresse(),
                    $user->getCp(),
                    $user->getVille(),
                    $user->getMdp(),
                    $user->getMail(),
                    $user->getPoints(),
                    $user->getId(),
                ]
            );
            $conn = null;
        } catch (PDOException $e) {
            throw new ErrorSQLException($e->getMessage());
        }
    }
    public static function getPoints(Utilisateur $user)
    {
        $points = 0;
        try {
            $conn = MConnexion::getBdd();
            $reqPrepare = $conn->prepare('SELECT pointsClt FROM client WHERE numClt = ?');
            $reqPrepare->execute([$user->getId()]);
            $reqPrepare = $reqPrepare->fetch();
            $points = $reqPrepare['pointsClt'];
            $conn = null;
        } catch (PDOException $ex) {
            throw new ErrorSQLException("L'utilisateur n°{$user->getId()} n'existe pas.");
        }

        return $points;
    }

    /**
     * @param Utilisateur $user
     * @param int $points
     *
     * @throws ErrorSQLException
     */
    public static function setPoints(Utilisateur $user, $points)
    {
        try {
            $conn = MConnexion::getBdd();
            $reqPrepare = $conn->prepare('UPDATE client SET pointsClt = ? WHERE numClt = ?');
            $reqPrepare->execute([$points, $user->getId()]);
            $user->setPoints($points);
            $conn = null;
        } catch (PDOException $ex) {
            throw new ErrorSQLException("L'utilisateur n°{$user->getId()} n'existe pas.");
        }
    }
}
