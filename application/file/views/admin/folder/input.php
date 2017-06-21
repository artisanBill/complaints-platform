<link media="all" type="text/css" rel="stylesheet" href="/resources/app/tags/less/tagsinput.css">
<div class="container-fluid">
<?php echo form_open(current_url(), ['class'=>'form']) ?>
    <div class="card">
        <div class="card-block">
            <div class="field-group">
                <div lang='cn' class="form-group name_en-field text-field_type">
                    <label class="control-label">
                        名称
                        <span class="required">*</span>
                        <span class="label label-default">English</span>
                    </label>
                    <p class="text-muted">指定的文件夹一个简短描述性名称.</p>
                    <div>
                        <?php echo form_input([
                            'name'      => 'name',
                            'value'     => $input->name,
                            'data-max'  => 50,
                            'class'     => 'form-control',
                            'data-field'=> 'name',
                            'data-field_name'=> 'name',
                            'data-provides'=> 'boone.text',

                        ]) ?>
                        <small class="counter text-muted">
                            <span class="count"></span>
                            剩余字符.
                        </small>
                    </div>
                </div>
            </div>
            <div class="field-group">
                <div class="form-group slug-field slug-field_type ">
                    <label class="control-label">
                        Slug
                        <span class="required">*</span>
                        <span class="label label-default">English</span>
                    </label>
                    <p class="text-muted">Slug在构建的存储位置使用.</p>
                    <div>
                        <div>
                            <?php echo form_input([
                                'name'      => 'slug',
                                'value'     => $input->slug,
                                'class'     => 'form-control',
                                'data-type' => '_',
                                'data-slugify'=> 'name',
                                'data-field'=> 'slug',
                                'data-field_name'=> 'slug',
                                'data-provides'=> 'boone.slug',
                            ]) ?>
                        </div>

                    </div>
                </div>

            </div>
            <div class="field-group">
                <div class="form-group allowed_types-field tags-field_type">
                    <label class="control-label">
                        描述
                    </label>
                    <div>
                        <textarea
                            class="form-control"
                            name="description"
                            data-max=""
                            rows="6"
                            placeholder=""
                            data-field="description" data-field_name="description" data-provides="boone.textarea"></textarea>
                    </div>
                </div>
            </div>
            <div class="field-group">
                <div class="form-group fileType-field tags-field_type">
                    <label class="control-label">允许的类型</label>

                    <p class="text-muted">
                        指定允许此文件夹中的文件类型扩展名.
                    </p>

                    <p class="help-block">
                        <span class="text-warning"> <i class="fa fa-warning "></i>
                            注意像JPG和JPEG MIME类型之间的细微差别.
                        </span>
                    </p>
                    <div>
                        <?php echo form_input([
                            'name'      => 'fileType',
                            'value'     => '',
                            'class'     => 'form-control',
                            'data-options'=> '',
                            'data-free_input'=> '',
                            'data-field'    => 'fileType',
                            'data-field_name'    => 'fileType',
                            'data-provides'=> 'boone.tags',

                        ]) ?>
                        <small class="text-muted">
                            请使用逗号或回车键&quot;Enter&quot;.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="controls bottom card" data-spy="affix" data-offset-top="247">
        <div class="card-block">
            <div class="actions">
                <button class="btn btn-sm btn-success  "  name="action" value="save"> <i class="fa fa-save "></i>
                    存储
                </button>
                <button class="btn btn-sm btn-success  "  name="action" value="save_edit"> <i class="fa fa-save "></i>
                    存储 &amp; 离开
                </button>
            </div>
        </div>
    </div>
    <?php echo form_close() ?>
</div>
<script src="/resources/app/form/translations.js"></script>
<script src="/resources/app/text/jquery.charactercounter.js"></script>
<script src="/resources/app/text/input.js"></script>
<script src="/resources/app/slug/jquery.slugify.js"></script>
<script src="/resources/app/slug/input.js"></script>
<script src="/resources/app/textarea/jquery.charactercounter.js"></script>
<script src="/resources/app/textarea/input.js"></script>
<script src="/resources/app/tags/js/bootstrap-tagsinput.min.js"></script>
<script src="/resources/app/tags/js/bootstrap3-typeahead.min.js"></script>
<script src="/resources/app/tags/js/input.js"></script>
    