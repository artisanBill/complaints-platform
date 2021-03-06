$(function () {

    // Initialize date pickers
    $('input[data-provides="boone.datetime"].datepicker').each(function () {

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

    // Initialize time pickers
    $('input[data-provides="boone.datetime"].timepicker').each(function () {

        var input = $(this);

        input.prev('.icon').click(function () {
            input.focus();
        });

        $(this).timepicker({
            timeFormat: $(this).data('time-format'),
            step: $(this).data('step'),
            scrollDefault: 'now'
        });
    });
});
;