<div class="container-fluid">
	<?php echo form_open(current_url(), ['class' => 'form']) ?>
		<?php echo $this->load->view('group/form/rules') ?>
		<?php echo $this->load->view('submit') ?>
	<?php echo form_close() ?>
</div>