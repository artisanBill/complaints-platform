<div class="field-group">
	<div lang="cn" class="form-group text-field_type">
		<label class="control-label">
			名称
			<span class="required">*</span>
		</label>
		<p class="text-muted">方便阅读, 禁止重复创建.</p>
		<div>
			<?php echo form_input([
				'value'				=> '',
				'name'				=> 'name',
				'data-max'			=> '100',
				'class'				=> 'form-control',
				'data-suggested'	=> '',
				'data-field'		=> 'title',
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
	<div lang="cn" class="form-group text-field_type">
		<label class="control-label">
			Slug
			<span class="required">*</span>
			<span class="label label-default">English</span>
		</label>
		<p class="text-muted">使用的模组Slug.</p>
		<div>
			<?php echo form_input([
				'value'				=> '',
				'name'				=>	'slug',
				'data-max'			=> '100',
				'class'				=> 'form-control',
				'data-slugify'		=> 'title',
				'data-type'			=> '-',
				'data-suggested'	=> '',
				'data-field'		=> 'slug',
				'data-field_name'	=> 'post_slug',
				'data-provides'		=> 'boone.slug',
			]) ?>
		</div>
	</div>
</div>

<div class="field-group">
	<div lang="cn" class="form-group text-field_type">
		<label class="control-label">
			Placeholder
		</label>
		<p class="text-muted">如果支持，占位符会当没有输入输入输入显示.</p>
		<div>
			<?php echo form_input([
				'value'				=> '',
				'name'				=> 'placeholder',
				'data-max'			=> '200',
				'class'				=> 'form-control',
				'data-slugify'		=> 'placeholder',
				'data-suggested'	=> '',
				'data-field'		=> 'placeholder',
				'data-field_name'	=> 'post_placeholder',
				'data-provides'		=> 'boone.text',
			]) ?>
		</div>
	</div>
</div>

<div class="field-group">
	<div lang="cn" class="form-group textarea-field_type">
		<label class="control-label">
			说明
		</label>
		<p class="text-muted">现场说明会显示在表格来帮助用户.</p>
		<div>
			<?php echo form_textarea([
				'value'				=> '',
				'name'				=> 'instructions',
				'data-max'			=> '200',
				'class'				=> 'form-control',
				'data-slugify'		=> 'instructions',
				'rows'				=> 6,
				'data-suggested'	=> '',
				'data-field'		=> 'instructions',
				'data-field_name'	=> 'post_instructions',
				'data-provides'		=> 'boone.textarea',
			]) ?>
		</div>
	</div>
</div>

<div class="field-group">
	<div lang="cn" class="form-group text-field_type">
		<label class="control-label">
			警告
		</label>
		<p class="text-muted">警告有助于使人们关注到的重要信息.</p>
		<div>
			<?php echo form_input([
				'value'				=> '',
				'name'				=> 'warning',
				'data-max'			=> '200',
				'class'				=> 'form-control',
				'data-slugify'		=> 'warning',
				'data-suggested'	=> '',
				'data-field'		=> 'warning',
				'data-field_name'	=> 'post_warning',
				'data-provides'		=> 'boone.text',
			]) ?>
		</div>
	</div>
</div>