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
        include("views/inscription/v_VoirInscription.php"); break;

    case 'inscrire' :
        try
        {
            if(isset($_POST['mailUser']))
            {
                $unUser = ConnexionSite::getUser($_POST['mailUser']);
                if($_POST['mailUser'] == $unUser->getMail())
                {
                    Connexion::setFlashMessage('Cette e-mail est déjà utilisée.', "error");
                    header("Location:?uc=inscription");
                }
                elseif(strlen($_POST['nomUser']) > 20)
                {
                    Connexion::setFlashMessage('Le nom entré est trop long',"error");
                    header("Location:?uc=inscription");
                }
                elseif(strlen($_POST['prenUser']) > 20)
                {
                    Connexion::setFlashMessage('Le prénom entré est trop long',"error");
                    header("Location:?uc=inscription");
                }
                elseif(strlen($_POST['cpUser']) != 5)
                {
                    Connexion::setFlashMessage("Le code postal entré n'est pas au bon format (ex: 30000)","error");
                    header("Location:?uc=inscription");
                }
                elseif($_POST['mdpUser'] != $_POST['mdpConfUser'])
                {
                    Connexion::setFlashMessage('Les mots de passes ne sont pas identiques',"error");
                    header("Location:?uc=inscription");
                }
                else
                {
                    $unUser = new Utilisateur();
                    $unUser
                        ->setNom($_POST['nomUser'])
                        ->setPrenom($_POST['prenUser'])
                        ->setAdresse($_POST['adrUser'])
                        ->setCp($_POST['cpUser'])
                        ->setVille($_POST['villeUser'])
                        ->setMdp(sha1($_POST['mdpUser']))
                        ->setMail($_POST['mailUser'])
                        ->setPoints(10)
                    ;
                    ConnexionSite::setAjoutUser($unUser);
                    Connexion::setFlashMessage("Inscription réussie, vous pouvez désormais vous connecter.","valid");
                    header("Location:?uc=index");
                }
            }
            else
            {
                header("Location:?uc=index");
            }
        }
        catch (Exception $e)
        {
            Connexion::setFlashMessage($e->getMessage(),"error");
            header("Location:?uc=inscription");
        } break;

    default : header("Location:?uc=index");
}
