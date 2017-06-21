<div class="card-bolck">
	<?php echo form_open('/honesty/execute', ['id'=>'boone-honesty']) ?>
	<input type='hidden' name="token" value="<?php echo sha1($this->currentUser->id) ?>">
	<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
		<ul id="myTabs" class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active">
				<a href="#basic" id="basic-tab" role="tab" data-toggle="tab" aria-controls="basic" aria-expanded="true">
					基础信息
				</a>
			</li>
			<li role="presentation">
				<a href="#event-info" role="tab" id="event-info-tab" data-toggle="tab" aria-controls="event-info">
					事件信息
				</a>
			</li>
			<li role="presentation">
				<a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">
					描述
				</a>
			</li>
		</ul>
		<div id="myTabContent" class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active" id="basic" aria-labelledBy="basic-tab">
				<?php echo $this->load->view('create/form/basic') ?>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="event-info" aria-labelledBy="event-info-tab">
				<?php echo $this->load->view('create/form/event') ?>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledBy="profile-tab">
				<?php echo $this->load->view('create/form/profile') ?>
			</div>
		</div>

	</div>
	<br>
	<hr>
	<div class="form-group">
		<button type="submit" name="submit" value="exit-save" class="btn btn-primary btn-lg" id="create-execute">
			<i class="fa fa-save"></i>
			存储 & 离开
		</button>
		<a href="/" class="pull-right btn btn-secondary-outline btn-lg">暂时不填写 & 返回主页</a>
	</div>
	<?php echo form_close() ?>
</div>

<script type="text/javascript">
var $serialize;
$(function() {
	$('#create-execute').on('click', function(event) 
	{
		event.stopPropagation();
		event.preventDefault();
		var $tokenVal = $('meta[name="itousu-token"]').attr('content');
		var $postData = $('#boone-honesty').serialize();

		if ( $serialize != $postData )
		{
			$serialize = $postData;
			$.post($('#boone-honesty').attr('action'), $postData, function (data)
			{
				$('#create-execute').attr('disabled', 'disabled');
				if ( data.type === 'success' )
				{
					alertMessage(data.message, 'success');
					setTimeout(function()
					{
						$('#create-execute').html('<i class="fa check-square-o"></i> 您已经成功创建投诉事件', 'success');
						window.location.href = data.url;
					}, 3000);
					return false;
				}
				else
				{
					$('#create-execute').removeAttr('disabled', 'disabled');
					$('#create-execute').removeClass('btn-primary').addClass('btn-danger');
					alertMessage(data.message);
					return false;
				}

			}, 'json').error(function()
			{
				alertMessage('系统繁忙，请稍后再试');
			});
		}
		alertMessage('您的表单没有更改内容, 请勿重复提交', 'notice');
		return false;
	});
});
</script>
