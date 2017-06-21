<div class="modal-body">
    <div class="dropzone"
         data-folder="<?php echo $folderData->id ?>"
         data-icon="<i class='fa fa-upload'></i>"
         data-max-size="<?php echo Setting::get('filesUploadLimit') ?>"
         data-message="点击这里或文件拖放上传."
         data-loading="Loading"
         data-uploading="Uploading"
         data-max-parallel="<?php echo Setting::get('filesMaxParallel') ?>"
         data-allowed="<?php echo Files::extJs($folderData->format) ?>">
    </div>
    <div class="uploads"></div>
</div>