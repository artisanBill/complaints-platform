<div class="alert alert-success-outline alert-dismissible fade in" role="alert" id='alertDisabled'>
	<h4 class="text-danger"> <i class="fa fa-warning fa-1x"></i>
		创建您的投诉事件
	</h4>
	<p>
		<strong>以下被填写的信息均被公开访问!
		请认真阐述您的事件事实（<span class="text-danger">*</span>必须填写）</strong>
	</p>
	<ol>
		<li>您的年龄必须满18周岁!(没有达到年龄请让监护人填写)</li>
		<li>您的填写的事件是自己亲身经历</li>
		<li>请勿填写损坏他人的事件！包含（诽谤，恶意诋毁, 伪造事件，侵犯他人隐私）等虚假信息散布</li>
		<li>填写的内容真实有效！具有法律效应。</li>
		<li>请对您填写的信息真实性承担相应的责任。</li>
	</ol>
	<p>
		<a class="btn btn-success" id="user-agree">我同意并发起投诉</a>
		<a href="/" class="btn btn-secondary-outline">暂时不填写</a>
	</p>
<script type="text/javascript">
window.onload = function () {
	$(function() {
		$('#user-agree').on('click', function(event) 
		{
			event.stopPropagation();
			event.preventDefault();
			var $tokenVal = $('meta[name="itousu-token"]').attr('content');
			$.post("/honesty/viewinput", {token : $tokenVal}, function (data) {
				alertMessage('成功加载填写表单 !', 'success');
				$('#alertDisabled').addClass('animated fadeInDown').remove();
				$('#honestyHtml').addClass('animated fadeInUp');
				$('#honestyHtml').html(data);
			}, 'html').error(function()
			{
				alertMessage('系统繁忙，请稍后再试');
			});
		});
	});
}
</script>
</div>

<div class="card" id="honestyHtml">
</div>