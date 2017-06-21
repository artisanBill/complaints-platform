<div class="invoice">
	<div class="invoice-company"><?php echo lang($this->moduleDetails['slug'] . '.details.name')?></div>
	<div class="invoice-header">
		<div class="invoice-from">
			<?php echo lang($this->moduleDetails['slug'] . '.details.description') ?>
		</div>
	</div>
	<div class="invoice-content">
		<?php echo $this->load->view('admin/tables/list'); ?>
	</div>
</div>