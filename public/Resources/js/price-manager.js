$(document).ready(function () {
    var price = $('#price');
    var priceContainer = $('#priceContainer');
    var qte = $('#qte');
    var points = $('#pointsUtilise');
    var reduction = $('#reduction');
    var percent = $('#percent');
    var step = $('#step');
    var formatToEuro = function(x) {
        var x = parseFloat(x);
        var decimal = x.toFixed(2);
        var parts = decimal.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        var part = parts.join(",");
        return part + ' €';
    };
    var genererPercent = function () {
        var reduc = 1;
        if (points.val() == null || points.val() == '') {
            points.val(25);
        }
        for (var i = 0; i < parseInt(points.val()); i += parseInt(step.text())) {
            reduc -= parseFloat(percent.text())/100;
        }
        return parseFloat(reduc);
    };
    var isChecked = function (elem) {
        return elem.prop('checked');
    };
    var calculPrix = function () {
        return parseFloat(price.val()) * parseInt(qte.val());
    };
    var genererPrix = function () {
        console.log(calculPrix());
        if (isChecked(reduction)) {
            return formatToEuro(calculPrix() * genererPercent());
        } else {
            return formatToEuro(calculPrix());
        }
    };
    qte.change(function () {
        priceContainer.text(genererPrix());
    });
    points.change(function () {
        priceContainer.text(genererPrix());
    });
    reduction.change(function () {
        priceContainer.text(genererPrix());
    })
});
