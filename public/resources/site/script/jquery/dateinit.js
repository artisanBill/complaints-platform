
$(function () {

// Initialize date pickers
$('input[data-provides="boone.field_type.datetime"].datepicker').each(function () {

    var input = $(this);

    input.prev('.icon').click(function () {
        input.focus();
    });

    $(this).datepicker({
        dateFormat: $(this).data('date-format'),
        yearRange: $(this).data('year-range'),
        minDate: $(this).data('min'),
        maxDate: $(this).data('max'),
        selectOtherMonths: true,
        showOtherMonths: true,
        changeMonth: true,
        changeYear: true
    });
});
});
