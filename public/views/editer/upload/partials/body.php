<div class="modal-body">

    <div class="dropzone"
         data-folder="{{ folder.id }}"
         data-icon="{{ icon('upload')|escape }}"
         data-max-size="{{ max_upload_size() }}"
         data-mode="{{ input_get('mode', 'file') }}"
         data-message="{{ trans('anomaly.field_type.wysiwyg::message.upload') }}"
         data-loading="{{ trans('anomaly.field_type.wysiwyg::message.loading') }}"
         data-uploading="{{ trans('anomaly.field_type.wysiwyg::message.uploading') }}"
         data-max-parallel="{{ setting_value('anomaly.module.files::max_parallel_uploads', 3) }}"
         data-allowed="{{ folder.allowed_types.value ? '.' ~ folder.allowed_types.value|join(',.') }}"></div>

    <div class="uploads"></div>

</div>