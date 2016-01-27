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
            include("views/compte/v_EditProfile.php");
        }
        catch (Exception $e)
        {
            Connexion::setFlashMessage($e->getMessage(), "error");
            header("Location:?uc=monCompte");
        }
        break;
    case 'voirCommandes' :
        try
        {
            $lesCommandes = MCommande::getCommandes($_SESSION['Utilisateur']);
            if(isset($_GET['cde']))
            {
                $uneCommande = MCommande::getUneCommande($_GET['cde']);
            }
            include("views/compte/v_VoirCommandes.php");
        }
        catch (Exception $e)
        {
            Connexion::setFlashMessage($e->getMessage(), "error");
            header("Location:?uc=monCompte");
        }
        break;
}
