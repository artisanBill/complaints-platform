<?php echo form_open(current_url()) ?>
	<div class="form-group credentials">
		<?php echo form_input([
			'class'			=> 'form-control',
			'placeholder'	=> '账号',
			'name'			=> 'account',
			'type'			=> 'email',
		]) ?>
		<i class="fa fa-envelope "></i>
		<?php echo form_password([
			'class'			=> 'form-control',
			'placeholder'	=> '密码',
			'name'			=> 'password',
			'type'			=> 'password',
		]) ?>
		<i class="fa fa-lock "></i>
	</div>
	<div class="form-group">
		<button type="submit" value="Login" class="btn btn-success btn-block">
		登录
		</button>
	</div>
<?php echo form_close() ?>