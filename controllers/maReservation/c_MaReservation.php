<?php
require_once('models/m_Connexion.php');
require_once('classes/produit.classe.php');

$action = array_key_exists('action', $_REQUEST) ? $_REQUEST['action'] : 'voirReservation';

switch ($action)
{
    case 'voirReservation' :
        include_once('views/maReservation/v_VoirReservation.php');
        break;

    case 'annulerReservation' :
        if (array_key_exists('Reservation', $_SESSION)) {
            unset($_SESSION['Reservation']);
            $_SESSION['valid'] = 'Réservation annulée avec succès.';
        }
        header('Location:?uc=maReservation');
        break;

    case 'validerReservation' :
        try
        {
            if (array_key_exists('Reservation', $_SESSION)) {
                $_SESSION['Reservation']->setValid(true);
                $_SESSION['Reservation']->flushValid();
                $_SESSION['valid'] = 'Réservation validée avec succès.';
            }
            header('Location:?uc=maReservation');
        }
        catch (PDOException $e)
        {
            Connexion::setFlashMessage($e->getMessage(), 'error');
            header('Location:?uc=maReservation');
        }
        break;
}

