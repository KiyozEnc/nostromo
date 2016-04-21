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

    var isChecked = function (elem) {
        return elem.prop('checked');
    };

    var generatePercent = function () {
        var reduc = 0;
        for (var i = 0; i < parseInt(points.val()); i += parseInt(step.text())) {
            reduc += parseFloat(percent.text())/100;
        }
        if (parseInt(points.val()) < parseInt(step.text())) {
            reduc = 1;
        }
        return parseFloat(reduc);
    };
    if (isChecked(reduction)) {
        remise.text(percentFormate(generatePercent()));
    } else {
        points.val('');
        points.attr('value', '');
        remise.text('0%');
    }
    reduction.change(function () {
        if (isChecked($(this))) {
            remise.text(percentFormate(generatePercent()));
        } else {
            points.val('');
            remise.text('0%');
        }
    });
    points.change(function () {
        remise.text(percentFormate(generatePercent()));
    });
});