<link media="all" type="text/css" rel="stylesheet" href="/resources/app/tags/less/tagsinput.css">
<span class="handle card-label card-label-success">
	<?php echo $title ?>
</span>
<?php echo form_open($action, ['id'=>'booneBlog']) ?>
<input type="hidden" name="categories" value="<?php echo $categories->id ?>" id="getCategoriesid">
<div class="field-group">
	<div lang="cn" class="form-group metaTitle-field text-field_type">
		<label class="control-label">
			标题
			<span class="required text-danger">*</span>
		</label>
		<p class="text-muted">指定搜索引擎优化称号.</p>
		<p class="help-block">
            <span class="text-warning">
                <i class="fa fa-warning "></i>
                文章标题将默认使用.
            </span>
        </p>
		<div>
			<?php echo form_input([
				'value'				=> $blog->metaTitle,
				'name'				=> 'metaTitle',
				'data-max'			=> '200',
				'class'				=> 'form-control',
				'data-suggested'	=> '',
				'data-field'		=> 'metaTitle',
				'data-field_name'	=> 'metaTitle',
				'data-provides'		=> 'boone.text',
			]) ?>
			<small class="counter text-muted">
				<span class="count">200</span>
				剩余字符.
			</small>
		</div>
	</div>
</div>

<div class="field-group">
	<div lang="cn" class="form-group tags-field tags-field_type">
		<label class="control-label">
			Meta 关键词
			<span class="required text-danger">*</span>
		</label>
		<p class="text-muted">指定SEO关键字.</p>
		<div>
			<?php echo form_input([
                'name'				=> 'tags',
				'class'				=> 'form-control',
				'data-options'		=> '',
				'data-free_input'	=> '',
				'data-field'		=> 'tags',
				'data-field_name'	=> 'tags',
				'data-provides'		=> 'boone.tags',
				'value'				=> $blog->tags
			]) ?>
			<small class="text-muted">
                请使用逗号或回车键&quot;Enter&quot;.
            </small>
		</div>
	</div>
</div>

<div class="field-group">
	<div lang="cn" class="form-group post_title_en-field text-field_type">
		<label class="control-label">
			Meta 描述
			<span class="required text-danger">*</span>
		</label>
		<p class="text-muted">指定SEO描述.</p>
		<div>
			<?php echo form_textarea([
				'name'				=> 'summary',
				'value'				=> $blog->summary,
				'data-max'			=> '255',
				'rows'				=> '4',
				'class'				=> 'form-control',
				'data-slugify'		=> '',
				'data-suggested'	=> '',
				'data-field'		=> 'summary',
				'data-field_name'	=> 'summary',
				'data-provides'		=> 'boone.textarea',
			]) ?>
		</div>
	</div>
</div>

<link rel="stylesheet" type="text/css" href="/resources/site/script/textarea/wysiwyg.css">

<div class="from-group">
	<label class="control-label">
		内容
		<span class="required text-danger">*</span>
	</label>
	<textarea name="content"
	cols="40"
	rows="10"
	class="form-control"
	data-provides="boone.wysiwyg"
	data-height="340"
	data-folders=""
	data-disk="cn"
	data-locale=""
	data-buttons="formatting,bold,italic,deleted,unorderedlist,orderedlist,outdent,indent,alignment,horizontalrule,underline"
	data-plugins="table,fontfamily,fontsize,fontcolor,imagemanager,fullscreen"
	dir="ltr"><?php echo $blog->content ?></textarea>
</div>
<div class="modal remote" id="undefined-modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content"></div>
	</div>
</div>
<script src="/resources/app/text/jquery.charactercounter.js"></script>
<script src="/resources/app/text/input.js"></script>
<script src="/resources/app/tags/js/bootstrap-tagsinput.min.js"></script>
<script src="/resources/app/tags/js/bootstrap3-typeahead.min.js"></script>
<script src="/resources/app/tags/js/input.js"></script>
<script type="text/javascript" src="/resources/site/script/textarea/redactor.min.js"></script>
<script type="text/javascript" src="/resources/site/script/textarea/plugins/fontsize.js"></script>
<script type="text/javascript" src="/resources/site/script/textarea/plugins/fullscreen.js"></script>
<script type="text/javascript" src="/resources/site/script/textarea/plugins/imagemanager.js"></script>
<script type="text/javascript" src="/resources/site/script/textarea/plugins/table.js"></script>
<script type="text/javascript" src="/resources/site/script/textarea/plugins/video.js"></script>
<script type="text/javascript" src="/resources/site/script/textarea/plugins/definedlinks.js"></script>
<script type="text/javascript" src="/resources/site/script/textarea/plugins/fontcolor.js"></script>
<script type="text/javascript" src="/resources/site/script/textarea/plugins/fontfamily.js"></script>
<script type="text/javascript" src="/resources/site/script/textarea/plugins/codemirror.js"></script>
<script type="text/javascript" src="/resources/site/script/textarea/input.js"></script>

<script type="text/javascript">
$(function(){
    var modal = $('.modal');
    // Handle ajax forms in modals.
    modal.on('submit', 'form.ajax', function (e) {

        e.preventDefault();

        var wrapper = $(this).closest('.modal-content');

        wrapper.append('<div class="modal-loading"><div class="active loader"></div></div>');

        if ($(this).attr('method') == 'GET') {
            $.get($(this).attr('action'), $(this).serializeArray(), function (html) {
                wrapper.html(html);
            });
        } else {
            $.post($(this).attr('action'), $(this).serializeArray(), function (html) {
                wrapper.html(html);
            });
        }
    });
})
</script>

<div class="form-group form-group-lg">
	<h5>是否允许评论</h5>
	<div class="input-row form-switch">
		<?php echo form_checkbox([
			'name' => 'enableComment',
			'id'   => 'defaultLocation',
		], $blog->enableComment, $blog->enableComment) ?>
		<label for="defaultLocation" class="radius pull-left"></label>
	</div>
</div>
<br>

<div class="form-group form-group-lg">
	<h5>是否推荐该文章</h5>
	<div class="input-row form-switch">
		<?php echo form_checkbox([
			'name' => 'featured',
			'id'   => 'defaultLocation1',
		], $blog->featured, $blog->featured) ?>
		<label for="defaultLocation1" class="radius pull-left"></label>
	</div>
</div>
<Br>
<div class="form-group form-group-lg">
	<button type="submit" name="submit" value="exit-save" class="btn btn-primary btn-lg" id="create-execute">
		<i class="fa fa-save"></i>
		存储 & 离开
	</button>
</div>
<?php echo form_close() ?>
<script type="text/javascript">
var $serialize;
$(function() {
	$('#create-execute').on('click', function(event) 
	{
		event.stopPropagation();
		event.preventDefault();
		var $tokenVal = $('meta[name="itousu-token"]').attr('content');
		var $postData = $('#booneBlog').serialize();

		if ( $serialize != $postData )
		{
			$serialize = $postData;
			$.post($('#booneBlog').attr('action'), $postData, function (data)
			{
				$('#create-execute').attr('disabled', 'disabled');
				if ( data.type === 'success' )
				{
					alertMessage(data.message, 'success');

					loadList($('#getCategoriesid').val());
					//$('#blogRemove' + data.id).remove();
					/*setTimeout(function()
					{
						$('#create-execute').html('<i class="fa check-square-o"></i> 您已经成功创建投诉事件', 'success');
						window.location.href = data.url;
					}, 3000);
					return false;*/
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