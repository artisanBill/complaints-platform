<link rel="stylesheet" type="text/css" href="/resources/app/file/less/upload.css">
<div id="upload">
    <?php echo $this->load->view('uploaderfile/upload/partials/header') ?>
    <?php echo $this->load->view('uploaderfile/upload/partials/body') ?>
    <?php echo $this->load->view('uploaderfile/upload/partials/template') ?>
    <div class="uploaded">
        <?php echo $this->load->view('uploaderfile/upload/list') ?>
    </div>
</div>
<script type="text/javascript" src="/resources/app/file/js/dropzone.min.js"></script>
<script type="text/javascript" src="/resources/app/file/js/upload.js"></script>