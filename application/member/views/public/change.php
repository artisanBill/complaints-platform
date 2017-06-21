<?php echo form_open() ?>

<div class="form-group form-group-lg">
	<?php echo form_input([
		'type'			=> 'tel',
		'name'			=> 'mobile',
		'class'			=> 'form-control boone-mobileNumber',
		'id'			=> 'userMobile',
		'placeholder'	=> '请输入旧的手机号码',
		'value'			=> set_value('mobile'),
	]) ?>
</div>

<div class="form-group form-group-lg">
	<?php echo form_input([
		'type'			=> 'tel',
		'name'			=> 'card',
		'class'			=> 'form-control boone-mobileNumber',
		'id'			=> 'userCard',
		'placeholder'	=> '请输入您的认证身份证号码',
		'value'			=> set_value('card'),
	]) ?>
</div>

<div class="form-group form-group-lg">
	<input name="csrf-token" type="hidden" value="<?php echo $this->config->item('csrf_token_name') ?>" />
	<button type="submit" class="btn btn-success btn-lg btn-block" id="userValidation">
		验证身份信息
		<i class="fa fa-sign-in"></i>
	</button>
</div>

<?php echo form_close() ?>

<script type="text/javascript">
$(function()
{
	var userValidation = $('#userValidation');
	userValidation.on('click', function(event)
	{
		event.stopPropagation();
		event.preventDefault();

		//	validation user enter information.
		var userMobile = $('#userMobile').val();
		var userCard = $('#userCard').val();

		//	Set up your phone number validation rules
		var validation = /^1([38]\d|4[57]|5[0-35-9]|7[06-8]|8[89])\d{8}$/;

		if ( ! userMobile || ! validation.test(userMobile) )
		{
			alertMessage('请正确填写手机号码');
			return false;
		}

		if ( ! userCard )
		{
			alertMessage('请输入您的有效身份证号码');
			return false;
		}

		alertMessage('ok');
		return false;
	});
});
</script>