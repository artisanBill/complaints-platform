(function ($) {
    $.Redactor.prototype.filemanager = function () {
        return {
            init: function () {

                var editor = this;

                this.button.addDropdown(
                    this.button.add('file', '插入文件'),
                    {
                        select: {title: '选择文件', func: this.filemanager.select},
                        upload: {title: '上传文件', func: this.filemanager.upload}
                    }
                );

                $('#' + this.opts.element.data('field') + '-modal').on('click', '[data-select="file"]', function (e) {

                    e.preventDefault();

                   // var url = APPLICATION_URL + '/file/file/ajaxchoose/' + $(this).data('entry');
                    var url = $(this).data('entry');

                    var text = editor.selection.getText().length ? editor.selection.getText() : url;

                    editor.file.insert('<a href="' + url + '">' + text + '</a>');

                    $(this).closest('.modal').modal('hide');
                });
            },
            select: function () {

                var params = this.filemanager.params();

                $('#' + this.opts.element.data('field') + '-modal')
                    .modal('show')
                    .find('.modal-content')
                    .load('/file-ajaxchoose?' + params);
            },
            upload: function () {

                var params = this.filemanager.params();

                $('#' + this.opts.element.data('field') + '-modal')
                    .modal('show')
                    .find('.modal-content')
                    .load('/file-upload?' + params);
            },
            params: function () {
                return $.param({
                    mode: 'file',
                    folders: this.opts.folders
                });
            }
        };
    };
})(jQuery);