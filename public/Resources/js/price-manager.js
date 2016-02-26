$(document).ready(function () {
    var price = $('#price');
    var priceContainer = $('#priceContainer');
    var qte = $('#qte');
    var formatToEuro = function(x) {
        var decimal = x.toFixed(2);
        var parts = decimal.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        var part = parts.join(",");
        return part + ' €';
    }
    qte.change(function () {
        priceContainer.text(formatToEuro(parseInt(price.val()) * parseInt($(this).val())));
    });
});