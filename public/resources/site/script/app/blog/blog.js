function loadList(loader)
{
	//var loader =loadId.data('categories');
	$.ajax({
		url : '/blog/list/' + loader,
		type : 'get',
		cache : false,
		dataType : 'html',
		success : function(dataHtml)
		{
			$('#contentPerview').addClass('animated fadeInDown').html(dataHtml);
			setTimeout(function()
			{
				$('#contentPerview').removeClass();
			}, 772);
		},
		error : function()
		{
			alertMessage('系统繁忙，请稍后再试');
		}
	});
	return false;
}
function loadFromCategories()
{
	$('#loadFromCategories').hide();
	$('#createCategories').addClass('animated fadeInUp').show();
}
function startCreateCotegories()
{
	var cotegoriesNmae = $('#cotegoriesNmae');

	if ( ! cotegoriesNmae.val() )
	{
		alertMessage('文集不能为空');
		return false;
	}

	var token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		url : '/categorie/create',
		type : 'post',
		data : {cotegories : cotegoriesNmae.val()},
		cache : false,
		dataType : 'json',
		success : function(resultHtml)
		{
			var viewHtml = '<li id="delete'+resultHtml.id
				+ '"><a onclick="loadList($(this).data(\'categories\'))" data-categories="' 
				+ resultHtml.id +'" class="cursorOn" id="updateConent' 
				+ resultHtml.id+'">'
				+ resultHtml.name
				+ "</a><div class='pull-right'>" 
				+ '<span class="label label-sm label-success cursorOn" onclick="loadContent($(this))" data-categories="' 
				+ resultHtml.id
				+ '"><i class="fa fa-pencil"></i></span>&nbsp;'
				+ '<span class="label label-sm label-default cursorOn" onclick="cotegoriesUpdate($(this))" data-update="' 
				+ resultHtml.id
				+ '"><i class="fa fa-edit"></i></span>&nbsp;'
				+ '<span class="label label-sm label-danger cursorOn" onclick="cotegoriesDelete($(this))" data-categories="' 
				+ resultHtml.id
				+ '"><i class="fa fa-trash"></i></span></div></li>';
			$('#createNew').prepend(viewHtml);
			$('#loadFromCategories').addClass('animated fadeInUp').show();
			$('#createCategories').hide();
			cotegoriesNmae.val('')
		},
		error : function()
		{
			alertMessage('系统繁忙，请稍后再试');
		}
	});

	return false;
}
function cotegoriesUpdate(updateId)
{
	var $id = updateId.data('update');
	$.ajax({
		url : '/categorie/update/' + $id,
		type : 'post',
		data : {tokenJs : $('meta[name="csrf-token"]').attr('content')},
		cache : false,
		dataType : 'json',
		success : function(data)
		{
			if ( data.type === 'success' )
			{
				$('#cotegoriesNmae').attr('data-thisvalue', data.name).val(data.name);
				loadFromCategories();
				$('#updateRemove').attr('onclick', 'updateExecute($(this))').attr('data-editer', data.id).text('编辑文集');
			}
			alertMessage(data.message, data.type);
		},
		error : function()
		{
			alertMessage('系统繁忙，请稍后再试');
		}
	});
	delete $id;
	return false;
}
function updateExecute(executeId)
{	
	var $ider = $('#updateRemove').data('editer');

	var cotegoriesNmae = $('#cotegoriesNmae');

	if ( ! cotegoriesNmae.val() )
	{
		alertMessage('文集不能为空');
		return false;
	}
	if ( cotegoriesNmae.data('thisvalue') === cotegoriesNmae.val() )
	{
		alertMessage('您没有更新文集名称');
		return false;
	}

	$.ajax({
		url : '/categorie/editer/' + $ider,
		type : 'post',
		data : {cotegories : cotegoriesNmae.val(), cotegoriesId : $ider},
		cache : false,
		dataType : 'json',
		success : function(dataResult)
		{
			alertMessage(dataResult.message, dataResult.type);
			if ( dataResult.type === 'success' )
			{
				$('#updateConent' + dataResult.id).text(dataResult.name);
			}
			$('#loadFromCategories').addClass('animated fadeInUp').show();
			$('#createCategories').hide();
			cotegoriesNmae.val('');
			$('#updateRemove').attr('onclick', 'startCreateCotegories()').removeAttr('data-editer').text('存储文集');
		},
		error : function()
		{
			alertMessage('系统繁忙，请稍后再试');
		}
	});

	delete $ider;

	return false;
}
function cotegoriesDelete(deleteId)
{
	var id = deleteId.data('categories');
	$.ajax({
		url : '/categorie/delete/' + id,
		type : 'post',
		data : {tokenJs : $('meta[name="csrf-token"]').attr('content')},
		cache : false,
		dataType : 'json',
		success : function(data)
		{
			alertMessage(data.message, data.type);
			if ( data.type === 'success' )
			{
				$('li#delete' + id).remove();
			}
		},
		error : function()
		{
			alertMessage('系统繁忙，请稍后再试');
		}
	});
	return false;
}
function loadContent(contentId)
{
	var id = contentId.data('categories');
	$.ajax({
		url : '/blog/loader/' + id,
		type : 'post',
		data : {tokenJs : $('meta[name="csrf-token"]').attr('content')},
		cache : false,
		dataType : 'html',
		success : function(data)
		{
			$('#contentPerview').addClass('animated fadeInDown').html(data);
			setTimeout(function()
			{
				$('#contentPerview').removeClass();
			}, 772);
		},
		error : function()
		{
			alertMessage('系统繁忙，请稍后再试');
		}
	});
	return false;

}

function editerBlog()
{
	var blog = $('#blogInfo');
	var ider = blog.data('blogslug'), categories = blog.data('categories');
	if ( ! ider || ! categories )
	{
		alertMessage('为找到您要编辑的文章');
		return false;
	}
	$.ajax({
		url : '/blog/editer/' + ider + '/' + categories,
		type : 'post',
		data : {token : $('meta[name="csrf-token"]').attr('content')},
		cache : false,
		dataType : 'html',
		success : function(dataHtml)
		{
			$('#contentPerview').addClass('animated fadeInDown').html(dataHtml);
			setTimeout(function()
			{
				$('#contentPerview').removeClass();
			}, 772);
		},
		error : function()
		{
			alertMessage('系统繁忙，请稍后再试');
		}
	});
	return false;
}
function blogRemove()
{
	var blog = $('#blogInfo');
	var ider = blog.data('blogslug'), categories = blog.data('categories');
	if ( ! ider || ! categories )
	{
		alertMessage('为找到您要编辑的文章');
		return false;
	}

	$.ajax({
		url : '/blog/remove/' + ider + '/' + categories,
		type : 'post',
		data : {token : $('meta[name="csrf-token"]').attr('content')},
		cache : false,
		dataType : 'json',
		success : function(data)
		{
			alertMessage(data.message, data.type);
			if ( data.type === 'success' )
			{
				$('#blogRemove' + data.id).remove();
			}
		},
		error : function()
		{
			alertMessage('系统繁忙，请稍后再试');
		}
	});
	return false;
}
