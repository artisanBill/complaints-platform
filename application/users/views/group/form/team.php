<div class="field-group">
	<div lang="cn" class="form-group name-field text-field_type">
		<label class="control-label">
			名称
			<span class="required">*</span>
		</label>
		<p class="text-muted">设置名称与该团队工作相关.</p>
		<p class="help-block">
            <span class="text-warning">
                <i class="fa fa-warning "></i>
                对象每个团队设置不同的权限.
            </span>
        </p>
		<div>
			<?php echo form_input([
				'value'				=> '',
				'name'				=> 'name',
				'data-max'			=> '100',
				'class'				=> 'form-control',
				'data-suggested'	=> '',
				'data-field'		=> 'name',
				'data-field_name'	=> 'post_title',
				'data-provides'		=> 'boone.text',
			]) ?>
			<small class="counter text-muted">
				<span class="count">100</span>
				剩余字符.
			</small>
		</div>
	</div>
</div>

<div class="field-group">
	<div lang="cn" class="form-group description-field text-field_type">
		<label class="control-label">
			描述
			<span class="required">*</span>
		</label>
		<div>
			<?php echo form_input([
				'value'				=> '',
				'name'				=>	'description',
				'data-max'			=> '200',
				'class'				=> 'form-control',
				'data-suggested'	=> '',
				'data-field'		=> 'description',
				'data-field_name'	=> 'description',
				'data-provides'		=> 'boone.textarea',
			]) ?>
		</div>
	</div>
</div>