<?php if ( isset($jsFile)  && $jsFile === TRUE): ?>
 <script type="text/javascript" src="/resources/app/file/js/admin-input.js"></script>   
<?php endif ?>

<div class="field-group">
    <div lang="cn" class="form-group <?php echo $inputname ?>-field file-field_type">
        <label class="control-label">
            <?php echo $filename ?>
            <span class="required">*</span>
        </label>
        <p class="text-muted"><?php echo $fileDesc ?>.</p>
        <div>
            <a
                data-toggle="modal"
                data-target="#<?php echo $inputname ?>-modal"
                class="btn btn-info btn-xs"
                href="/content/file/upload-selected"
            >选择文件</a>

            <a
                data-toggle="modal"
                data-target="#<?php echo $inputname ?>-modal"
                href="/content/file/upload-file"
                class="btn btn-success btn-xs"
            >上传文件</a>

            <input
                type="hidden"
                name="<?php echo $inputname ?>"
                value="<?php echo isset($inputvalue) ? $inputvalue : '' ?>"
                data-field="<?php echo $inputname ?>"
                data-field_name="<?php echo $inputname ?>"
                data-provides="boone.file"
            >

            <div class="selected">
                当前没有选择文件选择
            </div>

            <div class="modal remote" id="<?php echo $inputname ?>-modal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content"></div>
                </div>
            </div>
        </div>
    </div>
</div>