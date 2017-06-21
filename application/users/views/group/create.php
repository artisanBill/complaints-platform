<div class="container-fluid">
	<?php echo form_open(current_url(), ['class' => 'form']) ?>
		<div class="card">
			<div class="card-block">
				<?php echo $this->load->view('group/form/team') ?>
			</div>
		</div>
		<?php echo $this->load->view('submit') ?>
	<?php echo form_close() ?>
</div>
<script src="/resources/app/text/jquery.charactercounter.js"></script>
<script src="/resources/app/text/input.js"></script>