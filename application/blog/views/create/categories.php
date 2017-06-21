<span class="handle card-label card-label-success">
	文集管理
</span>
<div class="boone-help-list">
	<ul class="clearfix" id="createNew">
		<li>
			<a class="cursorOn" onclick="loadList($(this).data('categories'))" data-categories="0">
				全部文章
			</a>
		</li>
		<?php if ( $categories ): ?>
			<?php foreach ( $categories as $item ): ?>
				<li id="delete<?php echo $item->id ?>">
					<a class="cursorOn" onclick="loadList($(this).data('categories'))" id="updateConent<?php echo $item->id ?>" data-categories="<?php echo $item->id ?>">
						<?php echo $item->name ?>
					</a>
					<div class="pull-right">
						<span class="label label-sm label-success cursorOn" onclick="loadContent($(this))" data-categories="<?php echo $item->id ?>"><i class="fa fa-pencil"></i></span>
						<span class="label label-sm label-default cursorOn" onclick="cotegoriesUpdate($(this))" data-update="<?php echo $item->id ?>"><i class="fa fa-edit"></i></span>
						<span class="label label-sm label-danger cursorOn" onclick="cotegoriesDelete($(this))" data-categories="<?php echo $item->id ?>">
							<i class="fa fa-trash"></i>
						</span>
					</div>
				</li>
			<?php endforeach ?>

		<?php endif ?>
		<div class="btn btn-success-outline btn-lg btn-block" id="loadFromCategories" onclick="loadFromCategories()">创建文章集</div>
	</ul>
</div>
<div id="createCategories" style="display: none">
	<div class="form-group form-group-lg">
		<?php echo form_input([
			'name'			=> 'cotegories',
			'class'			=> 'form-control',
			'id'			=> 'cotegoriesNmae',
			'placeholder'	=> '请输入您的文集名称',
			'value'			=> '',
		]) ?>
	</div>

	<div class="form-group form-group-lg">
		<div class="btn btn-success btn-lg btn-block" onclick="startCreateCotegories()" id="updateRemove">
			存储文集
		</div>
	</div>
</div>