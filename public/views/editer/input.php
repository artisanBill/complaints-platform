<link rel="stylesheet" type="text/css" href="/resources/app/wysiwyg/less/input.css">
<link rel="stylesheet" type="text/css" href="/resources/app/wysiwyg/less/redactor.css">
<link rel="stylesheet" type="text/css" href="/resources/app/wysiwyg/js/plugins/alignment/alignment.css">
<div class="field-group">
    <div class="form-group <?php echo $editer->slug ?>-field wysiwyg-field_type">
        <label class="control-label"><?php echo $editer->name ?></label>
        <div>
            <textarea
                name="<?php echo $editer->slug ?>" 
                data-field="<?php echo $editer->slug ?>"
                data-disk="<?php echo $editer->disk ?>"
                data-height="<?php echo $editer->height ?>"
                placeholder="<?php echo $editer->placeholder ?>"
                data-folders="<?php echo $editer->slug ?>"
                data-locale="cn"
                data-buttons="<?php echo implode(',', json_decode($editer->buttons)) ?>"
                data-plugins="<?php echo implode(',', json_decode($editer->plugins)) ?>"
                data-available_buttons="<?php echo htmlspecialchars(json_encode($this->config->item('buttons'))) ?>"
                data-available_plugins="<?php echo htmlspecialchars(json_encode($this->config->item('plugins'))) ?>"
                data-provides="boone.wysiwyg"
                ><?php echo $editer->placeholder ?></textarea>

            <div class="modal remote" id="<?php echo $editer->slug ?>-modal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/resources/app/wysiwyg/js/redactor.min.js"></script>
<script type="text/javascript" src="/resources/app/wysiwyg/js/input.js"></script>
<script type="text/javascript" src="/resources/app/wysiwyg/js/plugins/filemanager.js"></script>
<script type="text/javascript" src="/resources/app/wysiwyg/js/plugins/fullscreen.js"></script>
<script type="text/javascript" src="/resources/app/wysiwyg/js/plugins/imagemanager.js"></script>
<script type="text/javascript" src="/resources/app/wysiwyg/js/plugins/inlinestyle.js"></script>
<script type="text/javascript" src="/resources/app/wysiwyg/js/plugins/source.js"></script>
<script type="text/javascript" src="/resources/app/wysiwyg/js/plugins/table.js"></script>
<script type="text/javascript" src="/resources/app/wysiwyg/js/plugins/video.js"></script>
<script type="text/javascript" src="/resources/app/wysiwyg/js/plugins/alignment/alignment.js"></script>