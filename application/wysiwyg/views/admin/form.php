<link rel="stylesheet" type="text/css" href="/resources/app/boolean/less/bootstrap-switch.css">
<link media="all" type="text/css" rel="stylesheet" href="/resources/app/tags/less/tagsinput.css">
<link media="all" type="text/css" rel="stylesheet" href="/resources/app/integer/less/spinner.css">
<div class="container-fluid">
<?php echo form_open('', ['class' => 'form']) ?>
    <div class="card">
        <div class="card-block">
            <?php echo $this->load->view('admin/input') ?>
        </div>
    </div>

    <div class="card">
        <div class="card-block">
            <?php echo $this->load->view('admin/body') ?>
        </div>
    </div>
    <div class="controls top card affix" data-spy="affix" data-offset-top="247">
        <div class="card-block">
            <div class="actions">
                <button  type="submit" class="btn btn-sm btn-success" name="action" value="save">
                    <i class="fa fa-save "></i>
                    存储
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
<script src="/resources/app/form/translations.js"></script>
<script src="/resources/app/text/jquery.charactercounter.js"></script>
<script src="/resources/app/integer/js/input.js"></script>
<script src="/resources/app/integer/js/jquery-ui.spinner.min.js"></script>
<script src="/resources/app/text/input.js"></script>
<script src="/resources/app/slug/jquery.slugify.js"></script>
<script src="/resources/app/slug/input.js"></script>
<script src="/resources/app/textarea/jquery.charactercounter.js"></script>
<script src="/resources/app/textarea/input.js"></script>
<script src="/resources/app/tags/js/bootstrap-tagsinput.min.js"></script>
<script src="/resources/app/tags/js/bootstrap3-typeahead.min.js"></script>
<script src="/resources/app/tags/js/input.js"></script>
<script src="/resources/app/boolean/js/bootstrap-switch.js"></script>
<script src="/resources/app/boolean/js/input.js"></script>