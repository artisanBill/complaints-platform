<div class="row">
	<?php echo form_open(current_url(), [
		'method'	=> 'GET'
	]) ?>
	<br>
	<div class="col-md-2">
		<div class="form-group form-group-lg">
			<div class="select-group">
				<?php echo form_dropdown('data[eventRegion]', 
					regionList(), 
					$_GET['data']['eventRegion'] ?? '', 
					['class' => 'btn btn-default btn-lg btn-block']
					) ?>
				<b class="caret-line"></b>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-group-lg">
			<div class="select-group">
				<?php echo form_dropdown('data[eventType]', 
					complainType(), 
					$_GET['data']['eventType'] ?? '', 
					['class' => 'btn btn-default btn-lg btn-block']) ?>
				<b class="caret-line"></b>
			</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group form-group-lg">
			<div class="select-group">
				<?php echo form_dropdown('data[eventActive]', 
					currentCaseActive(), 
					$_GET['data']['eventActive'] ?? '', 
					['class' => 'btn btn-default btn-lg btn-block']) ?>
				<b class="caret-line"></b>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group form-group-lg">
			<?php echo form_input([
				'name'			=> 'data[userkeyword]', 
				'class'			=> 'form-control', 
				'placeholder'	=> '请输入关键词',
				'value'			=> $_GET['data']['userkeyword'] ?? ''
				]) ?>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group form-group-lg">
			<button type="submit" name="save-action" id="save-action" class="btn btn-primary btn-lg btn-block large">
				<i class="glyphicon glyphicon-filter"></i>
				筛选
			</button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>