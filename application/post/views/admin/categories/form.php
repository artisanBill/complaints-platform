<div class="modal-header">
	<button class="close" data-dismiss="modal">
		<span>&times;</span>
	</button>
	<h4 class="modal-title"> <?php echo $title ?> </h4>
</div>

<div class="modal-body">	
	<?php echo form_open('content/post/categories/' . $action . $uri, ['class' => 'form']) ?>
	<?php if ( $action == 'edit' ): ?>
		<input type="hidden" name="parentId" value="<?php echo $item->parent ?>">
	<?php endif ?>
	<div class="field-group">
		<div class="form-group name-field text-field_type">
			<label class="control-label">类别名称</label>
			<p class="text-muted">如何让客人查看需要的文章, 类别名称特别重要.</p>
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
		<div class="form-group name-field text-field_type">
			<label class="control-label">选择布局</label>
			<p class="text-muted">
				该分类文章呈现方式
			</p>
			<div>
				<select name="layout" class="c-select form-control" data-live-search="true" data-style="btn-white">
					<option value="default" selected="selected">默认</option>
				</select>
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
			存储 & 创建文章
		</button>
	</div>
	<?php echo form_close() ?>
</div>