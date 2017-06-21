<div id="upload">
	<div class="container-fluid">
		<div class="card">
			<div class="card-block">

				<h4 class="title">
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
		</div>
		<?php echo $this->load->view('partials/input') ?>
	</div>
</div>
<script type="text/javascript" src="/resources/app/files-module/js/dropzone.min.js"></script>
<script type="text/javascript" src="/resources/app/files-module/js/upload.js"></script>