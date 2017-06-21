(function($)
{
	$.fn.BooneAjaxScroll = function(settings)
	{
		var defaultSettings = {
			restrict : 0,
			currentPage : 1,
			requestNum : 0,
		};
	}
})(jQuery);


$(function()
{
	var restrict = 0;
	var currentPage = 1;
	var comments = $('#loaderCommentList');

	if ( ! comments.data('allnumber') )
	{
		return false;
	}

	var requestNum = 0;
	$(window).scroll(function ()
	{
		var condition = ($(this).scrollTop() + $(window).height() + 520 >= $(document).height() && $(this).scrollTop()) > 520;
		if( condition && restrict == 0 && requestNum !== currentPage)
		{
			requestNum = currentPage;
			alertMessage('正在加载回应信息中...', 'success');

			$.get(comments.data('ajaxurl') + '/?per_page=' + currentPage,function(htmlData)
			{
				if( htmlData )
				{
					comments.append(htmlData);
					currentPage++;
				}
				else
				{
					restrict = 1;
					alertMessage('已经全部加载完毕');
					return false; 
				}
			});
			//
		}
	});
});