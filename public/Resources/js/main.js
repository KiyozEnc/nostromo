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
    if ($(location).attr('href') === 'http://localhost/nostromo/?page=monCompte' || $(location).attr('href') === 'http://localhost/nostromo/?page=monCompte&action=voirMonCompte') {
        $.ajax({
            type: 'GET',
            url: 'index.php?page=monCompte&action=getTimer',
            timeout: 3000,
            success: function (data) {
                var timer = $(data).find('span#timer');
                var arr = timer.text().split(', ');
                var volLaunch = new Date((arr[0] < 10 ? '0': '') + arr[0], (arr[1] < 10 ? '0': '') + arr[1], (arr[2] < 10 ? '0': '') + arr[2], (arr[3] < 10 ? '0': '') + (arr[3] < 10 ? '0': '') + arr[3], (arr[4] < 10 ? '0': '') + arr[4], (arr[5] < 10 ? '0': '') + arr[5]);
                var setDate = function () {
                    var now = new Date();
                    var s = ((volLaunch.getTime() - now.getTime())/1000) - now.getTimezoneOffset()*60;
                    var month = Math.floor(s/(86400*30.5));
                    s -= month*(86400*30);
                    var d = Math.floor(s/86400);
                    s -= d*86400;
                    var h = Math.floor(s/3600);
                    s -= h*3600;
                    var m = Math.floor(s/60);
                    s -= m*60;
                    s = Math.floor(s);
                    $('span#time').html('<strong>' + (month>0?month:'') + (month>0?' Mois, ':'')  + (d>0?d:'') + (d>0?' jour':'')  + (d>1?'s, ':', ') + h + ' heure' + (h>1?'s, ':', ') + m + ' minute' + (m>1?'s et ':' et ') + s + ' seconde' + (s>1?'s ':' ') + '</strong>');

                    setTimeout(setDate, 1000);
                }
                if ($('span#time').length) {
                    setDate();
                }
            },
            error: function () {
                console.log('La requête a échouée');
            }
        })
    }
});