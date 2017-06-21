<div class="card-bolck boone-post-top">
	<?php echo form_open('', ['method' => 'GET']) ?>
		<div class="form-group form-group-lg">
			<div class="select-group">
				<select name="data[typeid]" class="btn btn-default btn-lg btn-block">
					<option value="" selected="selected">排序</option>
					<option value="">最新发布</option>
					<option value="">最旧发布</option>
				</select> <b class="caret-line"></b>
			</div>
		</div>

		<div class="form-group form-group-lg">
			<input type="text" name="data[userkeyword]" value="" class="form-control" placeholder="请输入关键词">
		</div>

		<div class="form-group form-group-lg">
			<button type="submit" name="save-action" id="save-action" class="btn btn-primary btn-lg btn-block large"> <i class="glyphicon glyphicon-filter"></i>
				筛选
			</button>
		</div>
	<?php echo form_close() ?>
</div>