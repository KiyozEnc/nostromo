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
    case 'edit' :
        include("views/compte/v_EditProfile.php");
    break;
    case 'voirCommandes' :
        $lesCommandes = MCommande::getCommandes($_SESSION['Utilisateur']);
        include("views/compte/v_VoirCommandes.php");

}
