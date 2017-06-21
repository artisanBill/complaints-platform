window.onload = function()
{
	$(function()
	{
		if ( VALIDATIONSMS > 1 )
		{
			countdown(VALIDATIONSMS);
		}
	});

	$('.boone-sms').on('click', function(event)
	{
		event.stopPropagation();
		event.preventDefault();

		//	Sending verification code already? Return false
		if ( $(this).attr('disabled') )
		{
			return false;
		}

		//	Being simple javascript form validation results
		$boone = BooneLogin.validation();

		if ( ! $boone )
		{
			return false;
		}

		//	Request server authentication
		$.post('/user-validation',
		{
			csrf: BooneLogin.tokenCode(),
			mobile: $boone.mobile.val()
		}, function(data)
		{
			//	Analyzing the results returned by the server
			if ( data.type == 'success' )
			{
				alertMessage(data.message, 'success');
				countdown(120);
				$('.boone-mobileNumber').attr('data-mobile', data.account);
				return false;
			}
			else
			{
				alertMessage(data.message);
				return false;
			}
		}, 'json').error(function()
		{
			alertMessage('系统繁忙，请稍后再试');
		});
	});

	//	User successfully send a verification code to begin execution of final landing verification.
	$('#subLoginForUser').on('click', function(event)
	{
		event.stopPropagation();
		event.preventDefault();
		
		$mobile = $('.boone-mobileNumber').data('mobile');

		//	Being simple javascript form validation results
		$boone = BooneLogin.validation();

		if ( ! $boone ) return false;

		if ( ! $mobile)
		{
			alertMessage('手机号码不正确!');
			return false;
		}

		//	Verify that your phone number is re-entered
		if ( $boone.mobile.val() != $mobile )
		{
			alertMessage('手机更换请重新发送验证码!');
			return false;
		}

		//	Request server authentication
		$.post('/login-execute',
		{
			csrf: BooneLogin.tokenCode(),
			mobile: $mobile,
			smscode: $('.smsNumber').val()
		}, function(data)
		{
			$('#subLoginForUser').attr('disabled', 'disabled');
			$('#subLoginForUser').html('<i class="fa fa-spinner fa-pulse text-white"></i> 正在登录中...');
			$('#subLoginForUser').removeClass('btn-danger').addClass('btn-primary');
			if ( data.type == 'success' )
			{
				alertMessage(data.message,'success');
				setTimeout(function()
				{
					$('#subLoginForUser').html('<i class="fa fa-sign-in"></i> 登录成功', 'success');
					window.location.href = data.url;
				}, 3000);
			}
			else
			{
				$('#subLoginForUser').removeAttr('disabled', 'disabled');
				$('#subLoginForUser').removeClass('btn-primary').addClass('btn-danger');
				$('#subLoginForUser').html('<i class="fa fa-times text-white"></i> 登录失败');
				alertMessage(data.message);
			}
			return false;
		}, 'json').error(function()
		{
			$('#subLoginForUser').removeAttr('disabled', 'disabled');
			$('#subLoginForUser').removeClass('btn-primary').addClass('btn-danger');
			$('#subLoginForUser').html('<i class="fa fa-times text-white"></i> 登录失败');
			alertMessage('系统繁忙，请稍后再试');
		});

		return false;
	});

	/**
	 * Countdown.
	 *
	 * @param  int times
	 * @return void
	 */
	function countdown(times)
	{
		var interval = setInterval(time, 1000);

		function time()
		{
			times--;
			$('.boone-sms').attr('disabled', 'disabled').text(times + '秒重新发送');
			if (times == 0)
			{
				$('.boone-sms').removeAttr('disabled').text('发送验证码');
				clearInterval(interval);
			}
		}
	}

	var BooneLogin = {
		validation : function()
		{
			//	Get user enter form input value.
			var $mobile = $('.boone-user-validation input[name="mobile"]');

			//	Set up your phone number validation rules
			var $validation = /^1([38]\d|4[57]|5[0-35-9]|7[06-8]|8[89])\d{8}$/;

			//	Check whether the phone is empty
			if ( ! $mobile.val() )
			{
				alertMessage('请输入手机号码');
				$mobile.focus();
				return false;
			}

			//	Detecting whether a legitimate phone number
			if ( ! $validation.test($mobile.val()) )
			{
				alertMessage('请正确填写手机号码');
				$mobile.focus();
				return false;
			}

			return {
				mobile : $mobile
			};
		},

		tokenCode : function()
		{
			//	Get boone token
			return $('meta[name="csrf-token"]').attr('content');
		}
	};

}