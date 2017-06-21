<div class="form-group form-group-lg">
	<h5>标题 <small class="text-danger">*</small></h5>
	<small>请简单描述事件名称. </small>
	<?php echo form_input([
    'name'        => 'metaTitle',
    'class'       => 'form-control',
    'placeholder' => '请输入标题名称',
]) ?>
</div>
<hr>

<div class="form-group form-group-lg">
	<h5>关键词</h5>
	<small>让搜索引擎收录该事件, 关键词是必不可少!. </small>
	<?php echo form_input([
    'name'        => 'metaKeyword',
    'class'       => 'form-control',
    'placeholder' => '请输入关键词',
    'value'       => '',
]) ?>
</div>
<hr>

<div class="form-group form-group-lg">
	<h5>描述</h5>
	<small>请简单阐述该事件. </small>
	<?php echo form_input([
    'name'        => 'metaDescription',
    'class'       => 'form-control',
    'placeholder' => '',
    'value'       => '',
]) ?>
</div>
<hr>

<div class="form-group form-group-lg">
    <h5>是否允许评论</h5>
    <small>可能你期望其他的朋友给到您一些建议，如果需要请选择开启</small>
    <div class="input-row form-switch">
        <?php echo form_checkbox([
            'name' => 'allowComment',
            'id'   => 'defaultLocation',
        ], 1, 1) ?>
        <label for="defaultLocation" class="radius pull-left"></label>
    </div>
</div>