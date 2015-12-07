<?php
require_once('models/m_Connexion.php');
require_once('classes/produit.classe.php');

if (isset($_REQUEST['action']))
    $action = $_REQUEST['action'];
else
    $action = "voirReservation";

switch ($action)
{
    case 'voirReservation' :
        include ('views/maReservation/v_VoirReservation.php'); break;

    case 'annulerReservation' :
        if(isset($_SESSION['Reservation']))
        {
            //$_SESSION['Reservation']->setNonValid();
            unset($_SESSION['Reservation']);
            $_SESSION['valid'] = "Réservation annulée avec succès.";
        }
        header("Location:?uc=maReservation"); break;

    case 'validerReservation' :
        try
        {
            if(isset($_SESSION['Reservation']))
            {
                $_SESSION['Reservation']->setValid(true);
                $_SESSION['Reservation']->flushValid();
                $_SESSION['valid'] = "Réservation validée avec succès.";
            }
            header("Location:?uc=maReservation");
        }
        catch (PDOException $e)
        {
            Connexion::setFlashMessage($e->getMessage(), "error");
            header("Location:?uc=maReservation");
        } break;
}

