<div class="alert alert-success-outline alert-dismissible fade in" role="alert">
	<h4 class="text-danger"> <i class="fa fa-warning fa-1x"></i>
		投诉网团队成员申请
	</h4>
	<p><strong>您正在申请入驻投诉网, 您需要满足以下几个条件!</strong></p>
	<p>
		<ol>
			<li>你需要有良好的正义风范.</li>
			<li>你能接受公益性(免费)为广大群众服务.</li>
			<li>具备良好的心态和服务态度.</li>
			<li>支持加入身份 : 律师, 开发者, 行业专家, 作家等.</li>
		</ol>
	</p>
	<p>
		<button class="btn btn-success" id="onApprove">我要加入投诉网</button>
		<a href="/" class="btn btn-secondary-outline">暂时不加入</a>
	</p>
</div>
<script type="text/javascript">
$(function()
{
	$('#onApprove').on('click', function()
	{
		$('#user-approve').html('<input type="hidden" name="onApprove" value="1">');
		$('#onApprove').text('您已经同意并申请加入投诉网团度').attr('disabled', 'disabled');
	});

});
</script>