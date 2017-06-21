<link rel="stylesheet" type="text/css" href="/resources/app/boolean/less/bootstrap-switch.css">
<link rel="stylesheet" type="text/css" href="/resources/app/datetime/less/datepicker.css">
<link rel="stylesheet" type="text/css" href="/resources/app/datetime/less/timepicker.css">
<link media="all" type="text/css" rel="stylesheet" href="/resources/app/tags/less/tagsinput.css">
<div class="container-fluid">
	<?php echo form_open('content/post/create/' . $categories->id, ['class' => 'form']) ?>
		<div class="card">
			<div class="card-block">
				<?php echo $this->load->view('admin/form/file') ?>
			</div>
		</div>

		<div class="card">
			<div class="card-block">
				<?php echo $this->load->view('admin/form/basic') ?>
			</div>
		</div>

		<div class="card">
			<div class="card-block">
				<?php echo $this->load->view('admin/form/meta') ?>
			</div>
		</div>

		<div class="card">
			<div class="card-block">
				<?php echo $this->load->view('public/editer/input', ['editer' => $editerWysiwyg, 'contentBody' => $post->post_content]) ?>
			</div>
		</div>

		<div class="card">
			<div class="card-block">
				<?php echo $this->load->view('admin/form/other') ?>
			</div>
		</div>

		<?php echo $this->load->view('submit') ?>
	<?php echo form_close() ?>
</div>
<script src="/resources/app/form/translations.js"></script>
<script src="/resources/app/text/jquery.charactercounter.js"></script>
<script src="/resources/app/text/input.js"></script>
<script src="/resources/app/slug/jquery.slugify.js"></script>
<script src="/resources/app/slug/input.js"></script>
<script src="/resources/app/textarea/jquery.charactercounter.js"></script>
<script src="/resources/app/textarea/input.js"></script>
<script src="/resources/app/tags/js/bootstrap-tagsinput.min.js"></script>
<script src="/resources/app/tags/js/bootstrap3-typeahead.min.js"></script>
<script src="/resources/app/tags/js/input.js"></script>
<script src="/resources/app/boolean/js/bootstrap-switch.js"></script>
<script src="/resources/app/boolean/js/input.js"></script>
<script src="/resources/app/datetime/js/jquery-ui.datepicker.min.js"></script>
<script src="/resources/app/datetime/js/jquery.timepicker.min.js"></script>
<script src="/resources/app/datetime/js/input.js"></script>