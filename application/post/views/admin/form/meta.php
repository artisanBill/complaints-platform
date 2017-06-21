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

<div class="field-group">
	<div lang="cn" class="form-group  tag-field tags-field_type">
		<label class="control-label">
			标签
		</label>
		<p class="text-muted">指定任何组织的标记，以帮助推荐其他文章.</p>
		<div>
			<?php echo form_input([
				'name'				=> 'tag',
				'value'				=> $post->tag,
                'class'				=> 'form-control',
                'data-options'		=> '',
                'data-free_input'	=> '',
                'data-field'		=> 'tag',
                'data-field_name'	=> 'tag',
                'data-provides'		=> 'boone.tags',
			]) ?>
			<small class="text-muted">
                请使用逗号或回车键&quot;Enter&quot;.
            </small>
		</div>
	</div>
</div>

<div class="field-group">
	<div lang="cn" class="form-group post_title_en-field text-field_type">
		<label class="control-label">
			Meta 描述
			<span class="required">*</span>
		</label>
		<p class="text-muted">指定SEO描述.</p>
		<div>
			<?php echo form_textarea([
				'value'				=> $post->metaDescription,
				'name'				=> 'metaDescription',
				'data-max'			=> '255',
				'rows'				=> '6',
				'class'				=> 'form-control',
				'data-slugify'		=> '',
				'data-suggested'	=> '',
				'data-field'		=> 'metaDescription',
				'data-field_name'	=> 'metaDescription',
				'data-provides'		=> 'boone.textarea',
			]) ?>
		</div>
	</div>
</div>