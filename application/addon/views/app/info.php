<div class="modal-header">
    <button class="close" data-dismiss="modal">
        <span>&times;</span>
    </button>
    <h4 class="modal-title"> <?php echo $info['name'] ?> </h4>
</div>

<div class="modal-body">
    <?php echo $this->load->view('app/info/details') ?>
    <hr>
    <?php echo $this->load->view('app/info/authors') ?>
    <hr>
    <?php echo $this->load->view('app/info/support') ?>
</div>