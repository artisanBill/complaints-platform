$(function () {

    // Initialize integers
    $('input[data-provides="boone.integer"]').each(function () {
        $(this).spinner({
            min: $(this).data('min'),
            max: $(this).data('max'),
            step: $(this).data('step')
        });
    });
});
;