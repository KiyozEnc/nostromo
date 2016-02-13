<?php
namespace Nostromo\Models;

use Nostromo\Classes\Utilisateur;
use InvalidArgumentException;
use PDOException;

/**
 * Class MConnexionSite
 *
 * @category Models
 * @package  Nostromo\Models
 * @author   Nostromo <contact@nostromo.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost
 */
class MConnexionSite
{
    /**
     * @param string $email
     * @return Utilisateur
     * @throws InvalidArgumentException
     */
    public static function getUser($email)
    {
        $unClient = new Utilisateur();
        try {
            $conn = MConnexion::getBdd();
            $reqPrepare = $conn->prepare('SELECT * FROM client WHERE mailClt = ?');
            $reqPrepare->execute(array($email));
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
            throw new InvalidArgumentException("L'utilisateur avec l'adresse mail $email n'existe pas.");
        }
        return $unClient;
    }

    /**
     * @param Utilisateur $unClient
     * @throws InvalidArgumentException
     */
    public static function setAjoutUser(Utilisateur $unClient)
    {
        try {
            $conn = MConnexion::getBdd();
            $reqprepare = $conn->prepare(
                'INSERT INTO client
                (nomClt, prenomClt, adresseClt, cpClt, villeClt, mdpClt, mailClt, pointsClt)
                VALUES (?,?,?,?,?,?,?,?)'
            );
            $reqprepare->execute(
                array(
                    $unClient->getNom(),
                    $unClient->getPrenom(),
                    $unClient->getAdresse(),
                    $unClient->getCp(),
                    $unClient->getVille(),
                    $unClient->getMdp(),
                    $unClient->getMail(),
                    $unClient->getPoints())
            );
            $conn = null;
        } catch (PDOException $ex) {
            throw new InvalidArgumentException('Impossible de continuer l\'inscription. Détails : '.$ex->getMessage());
        }
    }

    /**
     * @param int $id
     * @return Utilisateur
     * @throws InvalidArgumentException
     */
    public static function getUnUser($id)
    {
        $unClient = new Utilisateur();
        try {
            $conn = MConnexion::getBdd();
            $reqPrepare = $conn->prepare('SELECT * FROM client WHERE numClt = ?');
            $reqPrepare->execute(array($id));
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
            throw new InvalidArgumentException("L'utilisateur n°$id n'existe pas.");
        }
        return $unClient;
    }

    /**
     * Met à jour un utilisateur dans la base de données dont l'utilisateur est passé en paramètre
     * @param Utilisateur $user
     * @throws InvalidArgumentException
     */
    public static function updateUser(Utilisateur $user)
    {
        try {
            $conn = MConnexion::getBdd();
            $reqprepare = $conn->prepare(
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
            $reqprepare->execute(
                array(
                    $user->getNom(),
                    $user->getPrenom(),
                    $user->getAdresse(),
                    $user->getCp(),
                    $user->getVille(),
                    $user->getMdp(),
                    $user->getMail(),
                    $user->getPoints(),
                    $user->getId())
            );
            $conn = null;
        } catch (PDOException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }
}
