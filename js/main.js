/**
 * Created by Kiyoz on 24/01/2016.
 */

function voirCommande(form)
{
    var cde = form.elements["cde"].value;
    document.location.href = "?uc=monCompte&action=voirCommandes&cde="+cde;
}