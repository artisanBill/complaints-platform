<div class="container-fluid">
	<div class="card card-container">
		<?php echo $this->load->view('partials/filter') ?>
	</div>
	<div class="card">
		<?php echo form_open('content/file/delete') ?>
			<div class="table-responsive">
				<?php echo $this->load->view('partials/list') ?>
			</div>
		<?php echo form_close() ?>
	</div>
</div>