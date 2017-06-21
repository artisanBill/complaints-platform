(function ($) {
    $.Redactor.prototype.imagemanager = function () {
        return {
            init: function () {

                var editor = this;

                this.button.addDropdown(this.button.add('image', '插入图片'),
                {
                    select: {title: '选择图片', func: this.imagemanager.select},
                    upload: {title: '上传图片', func: this.imagemanager.upload}
                });

                $('#' + this.opts.element.data('field') + '-modal').on('click', '[data-select="image"]', function (e) {

                    e.preventDefault();

                    var urlimg = $(this).data('entry');

                    editor.file.insert('<img src="' + urlimg + '"/>');

                    $(this).closest('.modal').modal('hide');
                });
            },
            select: function () {

                var params = this.imagemanager.params();

                $('#' + this.opts.element.data('field') + '-modal').modal('show').find('.modal-content').load('/upload/choose?' + params);
            },
            upload: function () {

                var params = this.imagemanager.params();

                $('#' + this.opts.element.data('field') + '-modal').modal('show').find('.modal-content').load('/edite/upload?' + params);
            },
            params: function() {
                return $.param({
                    mode: 'image',
                    folders: this.opts.folders
                });
            }
        };
    };
})(jQuery);