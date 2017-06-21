<link type="text/css" rel="stylesheet" href="/resources/app/files-module/less/upload.css">
<div class="modal-header">
	<button class="close" data-dismiss="modal">
	<span>&times;</span>
	</button>
	<h4 class="modal-title">
		<?php echo $folder->name ?>
		<br>
		<small class="text-muted"><?php echo $folder->description ?></small>
	</h4>

	<div>
		<span class="label label-info">Max: <?php echo Setting::get('filesUploadLimit') ?>MB</span>
		<?php foreach ( Files::formatArray($folder->format) as $format ): ?>
			<span class="label label-default"><?php echo $format ?></span>
		<?php endforeach ?>
	</div>
</div>

<div class="modal-body">
	<div id="upload">
		<?php echo $this->load->view('partials/input', ['listFile' => 'ajax/uploadedList']) ?>
	</div>
</div>
<script type="text/javascript" src="/resources/app/files-module/js/dropzone.min.js"></script>
<script type="text/javascript">
$(function () {
    var uploaded = [];

    var uploader = $('#upload');
    var element = $('.dropzone');
    var template = uploader.find('.template');
    var preview = template.html();

    template.remove();

    var dropzone = new Dropzone('.dropzone',
        {
            paramName: 'upload',
            url: '/recent-img/upload',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            sending: function (file, xhr, formData) {
                formData.append('folder', element.data('folder'));
            },

            autoQueue: true,
            thumbnailWidth: 24,
            thumbnailHeight: 24,
            previewTemplate: preview,
            previewsContainer: '.uploads',
            maxFilesize: element.data('max-size'),
            acceptedFiles: element.data('allowed'),
            parallelUploads: element.data('max-parallel'),
            dictDefaultMessage: element.data('icon') + ' ' + element.data('message'),
            uploadprogress: function (file, progress) {
                file.previewElement.querySelector("[data-dz-uploadprogress]").setAttribute('value', progress);
            }
        }
    );

    // While file is in transit.
    dropzone.on('sending', function () {
        uploader.find('.uploaded .card-block').html(element.data('uploading') + '...');
    });

    // When file successfully uploads.
    dropzone.on('success', function (file) {

        var response = JSON.parse(file.xhr.response);

        uploaded.push(response.id);

        file.previewElement.querySelector('[data-dz-uploadprogress]').setAttribute('class', 'progress progress-success');

        setTimeout(function () {
            file.previewElement.remove();
        }, 500);
    });

    // When file fails to upload.
    dropzone.on('error', function (file) {
        file.previewElement.querySelector("[data-dz-uploadprogress]").setAttribute('value', 100);
        file.previewElement.querySelector('[data-dz-uploadprogress]').setAttribute('class', 'progress progress-danger');
    });

    // When all files are processed.
    dropzone.on('queuecomplete', function () {

        uploader.find('.uploaded .card-block').html(element.data('loading') + '...');

        uploader.find('.uploaded').load('/uploaded/preview?uploaded=' + uploaded.join(','));
    });
});
;
</script>