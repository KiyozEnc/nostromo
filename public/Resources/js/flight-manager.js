$(document).ready(function () {
    var reduction = $('#reduction');
    var points = $('#pointsUtilise');
    reduction.change(function () {
        if (this.checked) {
            points.prop('readonly', false);
            points.val(25);
        } else {
            points.prop('readonly', true);
            points.val('');
            points.attr('value', '');
        }
    });
});