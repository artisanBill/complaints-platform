<div class="modal-header">
    <button class="close" data-dismiss="modal">
        <span>&times;</span>
    </button>
    <h4 class="modal-title">您想使用哪个文件？</h4>
</div>


<div class="modal-body">
    <?php echo $this->load->view('partials/filter') ?>
</div>

<div class="table-responsive">
    <?php echo $this->load->view('ajax/uploadedList') ?>
</div>

<script type="text/javascript">
    $(function (){
    //  Toggle all table actions
    $('[data-toggle="all"]').on('change', function () {

        $(this).closest('table').find(':checkbox').prop('checked', $(this).is(':checked'));
    });

    // Only allow actions if rows are selected.
    $('table').find(':checkbox').on('change', function () {
        if ($(this).closest('form').find(':checkbox:checked').length)
        {
            $(this).closest('form').find('.actions').find('button:not([data-ignore])').removeClass('disabled');
        } else {
            $(this).closest('form').find('.actions').find('button:not([data-ignore])').addClass('disabled');
        }
    });
});
</script>