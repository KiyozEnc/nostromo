<?php
if(isset($_GET['action']))
    $action = $_GET['action'];
else
    $action = "voirVols";

switch($action)
{
    case 'voirVols' :
        $tabVols = MVol::getVols();
        include("views/reserveVol/v_VoirVols.php"); break;
    case 'reserverVol' :
        $vol = MVol::getUnVol($_GET['vol']);
        include("views/reserveVol/v_VoirFormulaire.php"); break;
    case 'validReserverVol' :
        if(isset($_GET['vol'],$_POST['nbPers']) && !empty($_GET['vol']))
        {
            if(!isset($_SESSION['Reservation']))
            {
                $_SESSION['Reservation'] = new Produit($_GET['vol'],$_POST['nbPers']);
            }
            else
            {
                if($_SESSION['Reservation']->getValid() == false)
                    $_SESSION['error'] = "Vous avez déjà une réservation. Vous pouvez l'annuler via le bouton ci-dessous.";
                else
                    $_SESSION['error'] = "Vous avez déjà une réservation. Veuillez contacter Nostromo pour annuler votre réservation.";
            }
            header("Location:?uc=maReservation");
        }
        else
        {
            $_SESSION['error'] = "Le vol demandé n'existe pas.";
            header("Location:?uc=reserver");
        } break;

    default :
        $_SESSION['error'] = "Impossible d'accéder à la page demandé.";
        header("Location:?uc=index"); break;
}
