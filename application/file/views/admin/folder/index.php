<div class="container-fluid">
    <div class="card">
        <?php echo form_open(uri_string()) ?>
            <div class="table-responsive">
                <?php echo $this->load->view('admin/folder/table/list') ?>
            </div>
        <?php echo form_close() ?>
    </div>
</div>