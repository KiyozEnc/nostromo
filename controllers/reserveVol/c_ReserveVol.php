<?php
if(isset($_GET['action']))
    $action = $_GET['action'];
else
    $action = "voirVols";

switch($action)
{
    case 'voirVols' :
        $lesVols = MVol::getVols();
        include("views/reserveVol/v_VoirVols.php"); break;
    case 'reserverVol' :
        try
        {
            if(!Connexion::sessionOuverte())
                throw new Exception ("Invalid arguments");
            $vol = MVol::getUnVol($_GET['vol']);
            $nbPlaceRestante = MVol::getPlaceRestante($vol);
            include("views/reserveVol/v_VoirFormulaire.php");
        }
        catch (Exception $e)
        {
            Connexion::setFlashMessage($e->getMessage(), 'error');
            header("Location:?uc=reserver");
        }
        break;
    case 'validReserverVol' :
        try
        {
            if(isset($_GET['vol'],$_POST['nbPers']) && !empty($_GET['vol']))
            {
                if(!isset($_SESSION['Reservation']))
                {
                    $unVol = MVol::getUnVol($_GET['vol']);
                    if($_POST['nbPers'] <= MVol::getPlaceRestante($unVol) && $_POST['nbPers'] != 0)
                    {
                        $_SESSION['Reservation'] = new Reservation();
                        $_SESSION['Reservation']
                            ->setNbPers($_POST['nbPers'])
                            ->setValid(false)
                            ->setUnClient($_SESSION['Utilisateur'])
                            ->setUnVol($unVol)
                        ;
                    }
                    else
                    {
                        Connexion::setFlashMessage("Il n'y a plus assez de place pour ce vol, veuillez réduire le nombre de personnes", "error");
                        if($_POST['nbPers'] == 0)
                            Connexion::setFlashMessage("La valeur ne peut être zéro, veuillez recommencer", "error");
                        $numVol = $unVol->getNumVol();
                        header("Location:?uc=reserver&action=reserverVol&vol=$numVol");
                    }
                    if(isset($_SESSION['Reservation']))
                        header("Location:?uc=maReservation");
                }
                else
                {
                    if($_SESSION['Reservation']->isValid() == false)
                        Connexion::setFlashMessage("Vous avez déjà une réservation. Vous pouvez l'annuler via le bouton ci-dessous.","error");
                    else
                        Connexion::setFlashMessage("Vous avez déjà une réservation. Veuillez contacter Nostromo pour annuler votre réservation.","error");
                    header("Location:?uc=maReservation");
                }
            }
            else
            {
                Connexion::setFlashMessage("Le vol demandé n'existe pas.","error");
                header("Location:?uc=reserver");
            }
        }
        catch (Exception $e)
        {
            Connexion::setFlashMessage($e->getMessage(),"error");
            header("Location:?reserver");
        } break;

    default :
        Connexion::setFlashMessage("Erreur 404 : page introuvable","error");
        header("Location:?uc=index"); break;
}
