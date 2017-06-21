function addHeart(slug)
{
	var blogInfo = slug.data('blogslug');

	if ( ! slug.data('isuser') )
	{
		alertMessage('您没有登录');
		return false;
	}
	
	if ( ! blogInfo )
	{
		return false;
	}

	$.ajax({
		url : '/blog/heart/',
		type : 'post',
		cache : false,
		data : {blogslug : blogInfo},
		dataType : 'json',
		success : function(data)
		{
			$('#blogHeart' + data.blog).text(data.countnum);
		}
	});

	return false;
}