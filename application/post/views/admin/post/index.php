<div class="container-fluid">
	<div class="card card-container">
    	<?php echo $this->load->view('admin/post/filter/form') ?>
	</div>

    <div class="card">
    	<?php if ( $postData ): ?>
        <?php echo form_open('content/post/delete') ?>
            <div class="table-responsive">
                <?php echo $this->load->view('admin/post/table/list') ?>
            </div>
        <?php echo form_close() ?>
		<?php else: ?>
		<div class="card-block">
				No results.
		</div>
        <?php endif ?>
    </div>

    <?php echo $this->load->view('pagination') ?>
</div>