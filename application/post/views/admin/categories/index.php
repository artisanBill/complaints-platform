<div class="container-fluid">
    <div class="card">
        <?php echo form_open('content/post/categories/delete') ?>
            <div class="table-responsive">
                <?php echo $this->load->view('admin/categories/list') ?>
            </div>
        <?php echo form_close() ?>
    </div>
</div>