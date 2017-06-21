<link rel="stylesheet" type="text/css" href="/resources/site/script/textarea/wysiwyg.css">

<div class="from-group">
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
	data-plugins="table,fontfamily,fontsize,fontcolor,filemanager,imagemanager,fullscreen"
	dir="ltr" value=""></textarea>
</div>
<div class="modal remote" id="undefined-modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content"></div>
	</div>
</div>

<script type="text/javascript" src="/resources/site/script/textarea/redactor.min.js"></script>
<script type="text/javascript" src="/resources/site/script/textarea/plugins/filemanager.js"></script>
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
