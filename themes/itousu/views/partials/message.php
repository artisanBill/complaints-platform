
<!-- Success Messages -->
<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success fade in m-b-15">
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
      <?php echo $this->session->flashdata('success') ?>
    </div>
<?php endif ?>

<!-- Informational Messages -->
<?php if ($this->session->flashdata('info')): ?>
    <div class="alert alert-info fade in m-b-15">
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
        <?php echo $this->session->flashdata('info') ?>
    </div>
<?php endif ?>

<!-- Warning Messages -->
<?php if ($this->session->flashdata('notice')): ?>
    <div class="alert alert-warning fade in m-b-15">
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
       <?php echo $this->session->flashdata('notice') ?>
    </div>
<?php endif ?>

<!-- Error Messages -->
<?php if (validation_errors()): ?>
    <div class="alert alert-danger fade in m-b-15">
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
       <?php echo validation_errors() ?>
    </div>
<?php endif ?>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger fade in m-b-15">
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
       <?php echo $this->session->flashdata('error') ?>
    </div>
<?php endif ?>