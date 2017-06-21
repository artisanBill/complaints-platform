<?php $viewId = (isset($view) && is_object($view)) ? '-' . $view->id : '' ?>
<div class="boone-project-publish user-profile">
	<div class="container">
		<div class="card" id="createComment" data-inserturl="<?php echo app_url('.', '/comments/prepend/' . $this->module . $viewId) ?>">
			<span class="handle card-label card-label-success"> <i class="fa fa-comments fa-1x"></i>
				<?php echo $title ?? '发表评论' ?>
			</span>
			<div class="card-bolck">
				<?php echo $this->load->view('input') ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function()
{
	$('#comments-boone').submit(function(e)
	{
		e.preventDefault();

		if ( ! $('#message-create').val() )
		{
			alertMessage('留言内容不能为空');
		}

		$.post($(this).attr('action'), $(this).serialize(), function(resultData)
		{
			$('#message-create').val('')
			alertMessage(resultData.message, resultData.type);
			if ( resultData.type == 'success' )
			{
				$('#commentsAll').text(resultData.countall);
				var comments = $('#loaderCommentList');
				$.get($('#createComment').data('inserturl') + '/?comment=' + resultData.comment,function(htmlData)
				{
					if( htmlData )
					{
						comments.prepend(htmlData);
					}
				});
			}

		}, 'json').error(function()
		{
			alertMessage('系统繁忙，请稍后再试');
		});
		return false;
	});
});
</script>