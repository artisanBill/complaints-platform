<link rel="stylesheet" type="text/css" href="/resources/app/boolean/less/bootstrap-switch.css">
<link media="all" type="text/css" rel="stylesheet" href="/resources/app/tags/less/tagsinput.css">
<div class="container-fluid">
<div class="card">
	<div class="card-block">
	<?php echo form_open('content/helper/categories/' . $action . $uri, ['class' => 'form']) ?>
	<input type="hidden" name="parentId" value="<?php echo $uri ?>">

	<div class="field-group">
		<div class="form-group name-field text-field_type">
			<label class="control-label">类别名称</label>
			<p class="text-muted">如何让客人查看需要的帮助, 类别名称特别重要.</p>
			<div>
				<?php echo form_input([
					'name'	=> 'categoriesName',
					'class'	=> 'form-control',
					'value'	=> isset($item) ? $item->name : set_value('categoriesName')
				]) ?>
			</div>
		</div>
	</div>

	<div class="field-group">
		<div lang="cn" class="form-group keywords-field tags-field_type">
			<label class="control-label">
				关键词
				<span class="required">*</span>
			</label>
			<p class="text-muted">指定SEO关键字.</p>
			<div>
				<?php echo form_input([
	                'name'				=> 'keywords',
					'value'				=> isset($item) ? $item->keywords : set_value('keywords'),
					'class'				=> 'form-control',
					'data-options'		=> '',
					'data-free_input'	=> '',
					'data-field'		=> 'keywords',
					'data-field_name'	=> 'keywords',
					'data-provides'		=> 'boone.tags',
				]) ?>
				<small class="text-muted">
	                请使用逗号或回车键&quot;Enter&quot;.
	            </small>
			</div>
		</div>
	</div>

	<div class="field-group">
		<div class="form-group name-field text-field_type">
			<label class="control-label">描述</label>
			<p class="text-muted">简单描述该分类.</p>
			<div>
				<?php echo form_input([
					'name'	=> 'description',
					'class'	=> 'form-control',
					'value'	=> isset($item) ? $item->description : set_value('description')
				]) ?>
			</div>
		</div>
	</div>

	<div class="field-group">
		<div class="form-group name-field text-field_type">
			<label class="control-label">ICON 字体图标</label>
			<p class="text-muted">faIcon
				<a href="http://fontawesome.dashgame.com" target="_blank">填写ICON请点击</a>
			</p>
			<div>
				<?php echo form_input([
					'name'	=> 'faIcon',
					'class'	=> 'form-control',
					'value'	=> isset($item) ? $item->faIcon : set_value('faIcon')
				]) ?>
			</div>
		</div>
	</div>

	<div class="field-group">
		<div class="form-group isDisplay-field  boolean-field_type ">
			<label class="control-label">是否在栏目现实?</label>
			<div>
				<label>
				<input
					type="checkbox"
					value="<?php echo isset($item) ? $item->isDisplay  : set_value('isDisplay') ?>"
					name="isDisplay"
					data-on-text="YES"
					data-off-text="NO"
					data-disabled="false"
					data-on-color="success"
					data-off-color="danger"
					data-field="isDisplay" 
					data-field_name="isDisplay" 
					data-provides="boone.boolean"
				>
				</label>
			</div>
		</div>
	</div>

	<div class="actions">
		<button  type="submit" class="btn btn-sm btn-success" name="action" value="save">
			<i class="fa fa-save "></i>
			存储
		</button>

		<button  type="submit" class="btn btn-sm btn-success" name="action" value="save-exit">
			<i class="fa fa-save "></i>
			存储 & 创建帮助
		</button>
	</div>
	<?php echo form_close() ?>
</div>
</div>
</div>
<script src="/resources/app/boolean/js/bootstrap-switch.js"></script>
<script src="/resources/app/boolean/js/input.js"></script>
<script src="/resources/app/tags/js/bootstrap-tagsinput.min.js"></script>
<script src="/resources/app/tags/js/input.js"></script>