$(document).ready(function () {
    var points = $('#pointsUtilise');
    var remise = $('#remise');
    var percent = $('#percent');
    var step = $('#step');
    var reduction = $('#reduction');

    var percentFormate = function (number) {
        number = parseFloat(number);
        number *= 100;
        return Math.round(number * 100)/100+ '%';
    };

    var generatePercent = function () {
        var reduc = 0;
        if (points.val() == null || points.val() == '') {
            points.val(25);
        }
        for (var i = 0; i < parseInt(points.val()); i += parseInt(step.text())) {
            reduc += parseFloat(percent.text())/100;
        }
        if (parseInt(points.val()) < parseInt(step.text())) {
            reduc = 1;
        }
        return parseFloat(reduc);
    };
    reduction.change(function () {
        if ($(this).prop('checked')) {
            remise.text(percentFormate(generatePercent()));
        } else {
            remise.text('0%');
        }
    });
    points.change(function () {
        remise.text(percentFormate(generatePercent()));
    });
});