/**
 * Created by Kiyoz on 24/01/2016.
 */
function voirCommande(form) {
    'use strict';
    var cde = form.elements.cde.value;
    document.location.href = '?page=monCompte&action=voirCommandes&cde=' + cde;
}

function etesVousSur(message) {
    'use strict';
    return confirm(message);
}

function setQte(article, oldQte) {
    'use strict';
    var qte = $('.sr-only[data-attr=' + article + ']').parent().find('#qte option:selected').val();
    if (qte === '0') {
        if (etesVousSur("Êtes-vous sûr de vouloir supprimer cet article du panier ?")) {
            $(location).attr('href', '?page=monPanier&action=choisirQte&article=' + article + '&qte=' + qte);
        } else {
            $('.sr-only[data-attr=' + article + ']').parent().find('#qte option[value=' + oldQte + ']').prop('selected', true);
        }
    } else {
        $(location).attr('href', '?page=monPanier&action=choisirQte&article=' + article + '&qte=' + qte);
    }
}

$(document).ready(function () {
    'use strict';
    $('.alert').click(function () {
        $(this).fadeOut(300, function () {
            $(this).remove();
        });
    });
});