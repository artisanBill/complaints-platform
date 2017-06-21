<div class="field-group">
	<div lang="cn" class="form-group metaTitle-field text-field_type">
		<label class="control-label">
			标题
			<span class="required">*</span>
		</label>
		<p class="text-muted">指定搜索引擎优化称号.</p>
		<div>
			<?php echo form_input([
				'value'				=> $post->metaTitle,
				'name'				=> 'metaTitle',
				'data-max'			=> '200',
				'class'				=> 'form-control',
				'data-suggested'	=> '',
				'data-field'		=> 'metaTitle',
				'data-field_name'	=> 'metaTitle',
				'data-provides'		=> 'boone.text',
			]) ?>
			<small class="counter text-muted">
				<span class="count">200</span>
				剩余字符.
			</small>
		</div>
	</div>
</div>

<div class="field-group">
	<div lang="cn" class="form-group slug-field text-field_type">
		<label class="control-label">
			Slug
			<span class="required">*</span>
			<span class="label label-default">English</span>
		</label>
		<p class="text-muted">是创建后的URL中使用.</p>
		<div>
			<?php echo form_input([
				'value'				=> $post->slug,
				'name'				=> 'slug',
				'data-max'			=> '200',
				'class'				=> 'form-control',
				'data-slugify'		=> 'metaTitle',
				'data-type'			=> '-',
				'data-suggested'	=> '',
				'data-field'		=> 'slug',
				'data-field_name'	=> 'slug',
				'data-provides'		=> 'boone.slug',
			]) ?>
		</div>
	</div>
</div>

<div class="field-group">
	<div lang="cn" class="form-group metaKeyword-field tags-field_type">
		<label class="control-label">
			关键词
			<span class="required">*</span>
		</label>
		<p class="text-muted">指定SEO关键字.</p>
		<div>
			<?php echo form_input([
                'name'				=> 'metaKeyword',
				'value'				=> $post->metaKeyword,
				'class'				=> 'form-control',
				'data-options'		=> '',
				'data-free_input'	=> '',
				'data-field'		=> 'metaKeyword',
				'data-field_name'	=> 'metaKeyword',
				'data-provides'		=> 'boone.tags',
			]) ?>
			<small class="text-muted">
                请使用逗号或回车键&quot;Enter&quot;.
            </small>
		</div>
	</div>
</div>