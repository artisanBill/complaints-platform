<?php if ( isset($jsFile)  && $jsFile === TRUE): ?>
    <script type="text/javascript" src="/resources/app/file/js/admin-input.js"></script>  
<?php else: ?>
    <script type="text/javascript" src="/resources/app/file/js/user-input.js"></script>
<?php endif ?>
<div class="field-group">
    <div lang="cn" class="form-group <?php echo $inputname ?>-field file-field_type">
        <label class="control-label">
            <?php echo $filename ?>
        </label>
        <?php if ( isset($fileDesc) ): ?>
        <p class="text-muted"><?php echo $fileDesc ?>.</p>
        <?php endif ?>
        <div>
            <a
                data-toggle="modal"
                data-target="#<?php echo $inputname ?>-modal"
                class="btn btn-info btn-xs"
                <?php if ( isset($choose) && $choose): ?>
                    href="/<?php echo $choose ?>"
                <?php else: ?>
                    href="/content/file/upload-choose"
                <?php endif ?>
               
            >选择文件</a>

            <a
                data-toggle="modal"
                data-target="#<?php echo $inputname ?>-modal"
                <?php if ( isset($upload) && $upload): ?>
                    href="/<?php echo $upload ?>"
                <?php else: ?>
                    href="/content/file/upload-file"
                <?php endif ?>
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