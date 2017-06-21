<div class="form-group form-group-lg">
	<?php echo form_input([
		'name'			=> 'cotegories',
		'class'			=> 'form-control',
		'id'			=> 'cotegoriesNmae',
		'placeholder'	=> '请输入您的文集名称',
		'value'			=> '',
	]) ?>
</div>

<div class="form-group form-group-lg">
	<button class="btn btn-success btn-lg btn-block" id="startCreateCotegories">创建文集</button>
</div>
<script type="text/javascript">
$(function()
{
	var cotegoriesNmae = $('#cotegoriesNmae');
	$('#startCreateCotegories').on('click', function(event)
	{
		event.stopPropagation();
		event.preventDefault();

		if ( ! cotegoriesNmae.val() )
		{
			alertMessage('文集不能为空');
			return false;
		}

		var token = $('meta[name="csrf-token"]').attr('content');
		$.post('/categorie/create', {cotegories : cotegoriesNmae.val()}, function(resultHtml)
		{
			$('#createNew').prepend(resultHtml);
			$('#loadFromCategories').addClass('animated fadeInUp').show();
			$('#createCategories').hide();
		}).error(function()
		{
			alertMessage('系统繁忙，请稍后再试');
		});
		return false;
	});
})
</script>