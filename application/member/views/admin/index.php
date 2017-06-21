<div class="container-fluid">
	<?php echo $this->load->view('admin/filter/form') ?>

	<?php if ( $users ): ?>
	<div class="card">
		<form method="POST" action="users" accept-charset="UTF-8">
			<div class="table-responsive">
				<?php echo $this->load->view('admin/filter/list') ?>
			</div>
		</form>
	</div>
	<?php endif ?>
</div>