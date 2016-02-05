<?php
if(isset($_GET['action']))
    $action = $_GET['action'];
else
    $action = "voirMonCompte";

switch ($action)
{
    case 'voirMonCompte' :
        try
        {
            $title = "Page principale";
            include("views/compte/v_GabCompte.php");
            include("views/compte/v_VoirProfile.php");
        }
        catch (Exception $e)
        {
            Connexion::setFlashMessage($e->getMessage(), "error");
            header("Location:?uc=index");
        }
        break;
    case 'edit' :
        try
        {
            if(isset($_POST['actualpwd']))
            {
                if(empty($_POST['pwd']) && empty($_POST['pwdconf']) && empty($_POST['name']) && empty($_POST['firstname']) && empty($_POST['cp']) && empty($_POST['city']) && empty($_POST['address']))
                {
                    throw new Exception ("Veuillez remplir au moins un champ à modifier.");
                }
                if(sha1($_POST['actualpwd']) == $_SESSION['Utilisateur']->getMdp())
                {
                    if(!empty($_POST['pwd']) && !empty($_POST['pwdconf']))
                    {
                        if($_POST['pwd'] && $_POST['pwdconf'])
                            $_SESSION['Utilisateur']->setMdp(sha1($_POST['pwd']));
                        else
                            throw new Exception ("Les mots de passe ne sont pas identiques.");
                    }
                    if(!empty($_POST['name']))
                    {
                        $_SESSION['Utilisateur']->setNom($_POST['name']);
                    }
                    if(!empty($_POST['firstname']))
                    {
                        $_SESSION['Utilisateur']->setPrenom($_POST['firstname']);
                    }
                    if(!empty($_POST['cp']) && !empty($_POST['city']) && !empty($_POST['address']))
                    {
                        if(is_numeric($_POST['cp']))
                        {
                            $_SESSION['Utilisateur']
                                ->setAdresse($_POST['address'])
                                ->setCp($_POST['cp'])
                                ->setVille($_POST['city']);
                        }
                        else
                        {
                            throw new Exception ("Le code postal doit être au format numérique.");
                        }
                    }
                    if(!empty($_POST['cp']))
                    {
                        if(!is_numeric($_POST['cp']))
                            throw new Exception ("Le code postal doit être au format numérique.");
                    }
                }
                else
                {
                    throw new Exception("Mot de passe incorrect.");
                }
                ConnexionSite::updateUser($_SESSION['Utilisateur']);
                Connexion::setFlashMessage("Données mise à jour avec succès", "valid");
                header("Location:?uc=monCompte&action=edit");
            }
            else
            {
                $title = "Modifier mes informations";
                include("views/compte/v_GabCompte.php");
                include("views/compte/v_EditProfile.php");
            }
        }
        catch (Exception $e)
        {
            Connexion::setFlashMessage($e->getMessage(), "error");
            header("Location:?uc=monCompte&action=edit");
        }
        break;
    case 'voirCommandes' :
        try
        {
            if(isset($_SESSION['Utilisateur']))
            {
                $lesCommandes = MCommande::getCommandes($_SESSION['Utilisateur']);
                if(isset($_GET['cde']))
                {
                    $uneCommande = MCommande::getUneCommande($_GET['cde']);
                }
                $title = "Mes commandes";
                include("views/compte/v_GabCompte.php");
                include("views/compte/v_VoirCommandes.php");
            }
            else
            {
                header("Location:?uc=connexion");
            }
        }
        catch (Exception $e)
        {
            Connexion::setFlashMessage($e->getMessage(), "error");
            header("Location:?uc=monCompte");
        }
        break;
}
