<?php
if(isset($_GET['action']))
    $action = $_GET['action'];
else
    $action = "voirMonCompte";

switch ($action)
{
    case 'voirMonCompte' :
        include("views/compte/v_VoirProfile.php");

        ; break;
    case 'editMDP' :

    ; break;

    case 'editAddr' :

    ; break;

}
