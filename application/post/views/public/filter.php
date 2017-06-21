<?php echo form_open(current_url(), [
	'method'	=> 'GET'
]) ?>
<div class="input-group input-group-lg">
		<?php echo form_input([
			'name'			=> 'data[userkeyword]', 
			'class'			=> 'form-control', 
			'placeholder'	=> '请输入关键词',
			'value'			=> $_GET['data']['userkeyword'] ?? ''
			]) ?>
		<span class="input-group-btn">
			<button class="btn btn-primary" type="submit"> <i class="fa fa-search"></i>
				搜索
			</button>
		</span>
	</div>
<?php echo form_close() ?>