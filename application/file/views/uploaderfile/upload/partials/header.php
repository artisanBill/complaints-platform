<div class="modal-header">

    <button class="close" data-dismiss="modal">
        <span>&times;</span>
    </button>

    <h4 class="title">
       <?php echo $folderData->name ?>

        <?php if ( $folderData->description ): ?>
            <br>
            <small class="text-muted"><?php echo $folderData->description ?></small>
        <?php endif ?>
    </h4>

    <div>
        <span class="label label-info"><?php echo Setting::get('filesUploadLimit') ?>MB</span>

        <?php foreach ( Files::formatArray($folderData->format) as $format ): ?>
            <span class="label label-default"><?php echo $format ?></span>
        <?php endforeach ?>
    </div>

</div>
