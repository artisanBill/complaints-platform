<div class="container-fluid">
    <div class="card">
    	<?php if ( $teams ): ?>
        <?php echo form_open('root/users/teams/delete') ?>
            <div class="table-responsive">
                <?php echo $this->load->view('group/table/list') ?>
            </div>
        <?php echo form_close() ?>
		<?php else: ?>
		<div class="card-block">
				No results.
		</div>
        <?php endif ?>
    </div>
</div>