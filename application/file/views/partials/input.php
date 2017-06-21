<div class="card">
	<div class="card-block">
		<div class="dropzone"
			 data-folder="<?php echo $folder->id ?>"
			 data-icon="<i class='fa fa-upload'></i>"
			 data-max-size="<?php echo Setting::get('filesUploadLimit') ?>"
			 data-message="点击这里或文件拖放上传."
			 data-loading="Loading"
			 data-uploading="Uploading"
			 data-max-parallel="<?php echo Setting::get('filesMaxParallel') ?>"
			 data-allowed="<?php echo Files::extJs($folder->format) ?>"></div>
		<div class="uploads"></div>
	</div>
</div>

<div class="template hidden">
	<div class="upload">
		<small data-dz-name></small>
		<progress class="progress" data-dz-uploadprogress value="0" max="100">0%</progress>
	</div>
</div>
<?php echo $this->load->view($listFile ?? 'partials/list') ?>