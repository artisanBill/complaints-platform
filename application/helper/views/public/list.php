<div class="container">
	<div class="row">
		<div class="col-sm-8">
			<div class="card">
				<div class="card-bolck boone-bottom-border" id="boone-helper-content"></div>
			</div>
		</div>

		<div class="col-sm-4" id="boone-categories">
			<div class="card">
				<div class="handle card-label card-label-default"> <i class="<?php echo $categories->faIcon ?> fa-1x"></i>
					<?php echo $categories->title ?>
				</div>
				<div class="list-group" id="boone-helper-list">
					<?php if ( $resultData ): ?>
						<?php foreach ( $resultData as $item ): ?>
							<a href="" class="list-group-item" data-slug="<?php echo $item->slug ?>">
								<?php echo $item->metaTitle ?>
								<?php if ( $item->featured ): ?>
									<span class="featured featured-danger pull-right">重要</span>
								<?php endif ?>
							</a>
						<?php endforeach ?>

					<?php else: ?>
						<li class="list-group-item">该帮助信息查询到</li>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function()
{
	var helperContent = $('#boone-helper-content');
	var booneHelper = $('div#boone-helper-list a');
	var postUrl = "<?php echo app_url('.', 'helper/content') ?>";
	
	if ( typeof(helperContent.innerHTML) == 'undefined' )
	{
		var slug = $('div#boone-helper-list a:first').data('slug');
		$.post(postUrl + '/' + slug, 
		{
			token: $('meta[name="csrf-token"]').attr('content')
		},function(data)
		{
			setTimeout(function()
			{
				helperContent.html(data);
			}, 1000);
			
		}).error(function()
		{
			alertMessage('系统繁忙，请稍后再试');
		});
	}

	booneHelper.on('click', function(e)
	{
		e.preventDefault();
		$.post(postUrl + '/' + $(this).data('slug'), 
		{
			token: $('meta[name="csrf-token"]').attr('content')
		},function(data)
		{
			alertMessage('正在加载内容信息', 'success');
			setTimeout(function()
			{
				helperContent.html(data);
			}, 1000);
		}).error(function()
		{
			alertMessage('系统繁忙，请稍后再试');
		});
	});
	
});
</script>