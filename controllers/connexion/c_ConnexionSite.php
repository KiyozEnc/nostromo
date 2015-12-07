<?php
require_once('models/m_Connexion.php');
require_once('models/m_ConnexionSite.php');

if(isset($_GET['action']))
    $action = $_GET['action'];
else
    $action = "voirForm";

switch($action)
{
    case 'voirForm' :
        include("views/connexion/v_VoirForm.php"); break;
    case 'seConnecter' :
        try
        {
            if(isset($_POST['mailUser']))
            {
                $unUtilisateur = ConnexionSite::getUser($_POST['mailUser']);
                if($_POST['mailUser'] == $unUtilisateur->getMail() && sha1($_POST['mdpUser']) == $unUtilisateur->getMdp())
                {
                    $_SESSION['Utilisateur'] = new Utilisateur();
                    $_SESSION['Utilisateur'] = $unUtilisateur;
                    $_SESSION['Reservation'] = MVol::reservationExistante($_SESSION['Utilisateur']);
                    if(empty($_SESSION['Reservation']->getId()))
                        unset($_SESSION['Reservation']);
                    Connexion::setFlashMessage("Connecté avec succès", "valid");
                    header("Location:?uc=index");
                }
                else
                {
                    Connexion::setFlashMessage("E-mail ou mot de passe incorrecte", "error");
                    header("Location:?uc=connexion");
                }
            }
            else
            {
                Connexion::setFlashMessage("Erreur 404 : Page introuvable", "error");
                header("Location:?uc=index");
            }
        }
        catch (Exception $e)
        {
            Connexion::setFlashMessage($e->getMessage(), "error");
        } break;

    default : header("Location:?uc=index"); break;
}
