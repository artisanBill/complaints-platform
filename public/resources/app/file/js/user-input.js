$(function () {
    // Initialize file pickers
    $('[data-provides="boone.file"]').each(function () {

        var input = $(this);
        var field = input.data('field_name');
        var wrapper = input.closest('.form-group');
        var modal = $('#' + field + '-modal');

        modal.on('click', '[data-file]', function (e) {

            e.preventDefault();

            modal.find('.modal-content').append('<div class="modal-loading"><div class="active loader"></div></div>');

            wrapper.find('.selected').load('/file/upload-selected?uploaded=' + $(this).data('file'), function () {
                modal.modal('hide');
            });

            input.val($(this).data('filesrc'));
        });

        $(wrapper).on('click', '[data-dismiss="file"]', function (e) {

            e.preventDefault();

            input.val('');

            wrapper.find('.selected').load('/file/upload-selected', function () {
                modal.modal('hide');
            });
        });
    });
});
;