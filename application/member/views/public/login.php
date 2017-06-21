<?php echo form_open('login', [
	'class' => 'boone-user-validation'
]) ?>
	<div class="form-group form-group-lg has-success">
		<?php echo form_input([
			'type'			=> 'tel',
			'name'			=> 'mobile',
			'class'			=> 'form-control boone-mobileNumber',
			'data-mobile'	=> '',
			'placeholder'	=> '请输入手机号码',
			'value'			=> set_value('mobile'),
		]) ?>
	</div>

	<div class="form-group has-success">
		<div class="input-group input-group-lg">
		<?php echo form_input([
			'name'			=> 'sms',
			'class'			=> 'form-control smsNumber',
			'placeholder'	=> '请输入5位验证码',
		]) ?>
		    <span class="input-group-btn">
		        <button class="btn btn-success form-control boone-sms" type="button">
					<i class="fa fa-send"></i>
					发送验证
				</button>
		    </span>
		</div>
	</div>

	<div class="form-group form-group-lg">
		<input name="csrf-token" type="hidden" value="<?php echo $this->config->item('csrf_token_name') ?>" />
		<button type="submit" class="btn btn-success btn-lg btn-block" id="subLoginForUser">
			登录
			<i class="fa fa-sign-in"></i>
		</button>
	</div>

	<div class="form-group form-group-lg">
		<a href="<?php echo app_url('.', 'account/change') ?>" class="btn btn-danger-outline btn-lg btn-block">
			手机号码已更换 
			<i class="fa fa-question fa-1x"></i>
		</a>
	</div>
<?php echo form_close() ?>
<p class="user-agreement">
	<i class="fa fa-check-square"></i> <span>温馨提示: 未注册投诉网账号的手机号, 登录时将自动注册且代表您已同意
	<a href="<?php echo app_url('.', 'page/user-registration-agreement') ?>" class="text-success">《投诉网用户注册条款》</a></span>
</p>
<script type="text/javascript" src="/resources/site/script/app/user/login.js"></script>