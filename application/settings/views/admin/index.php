<div class="container-fluid">
<?php echo form_open('setting/settings/update/' . $segmentSlug, ['class' => 'form']) ?>
    <div class="card">
        <div class="card-block">
            <?php echo $this->load->view('admin/form/list') ?>
        </div>
    </div>
    <div class="controls bottom card affix" data-spy="affix" data-offset-top="247">
        <div class="card-block">
            <div class="actions">
                <button  type="submit" class="btn btn-sm btn-success" name="action" value="update">
                    <i class="fa fa-save "></i>
                    更新
                </button>
                <button type="submit"  class="btn btn-sm btn-success" name="action" value="save_exit">
                    <i class="fa fa-save "></i>
                    存储 &amp; 离开
                </button>
                <a class="btn btn-sm btn-default " href="<?php echo site_url() ?>">Cancel</a>
            </div>
        </div>
    </div>
    <?php echo form_close() ?>
</div>