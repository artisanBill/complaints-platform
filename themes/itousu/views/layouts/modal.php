<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="closeWindow">&times;</button>
	<h4 class="modal-title" id="modal-preview"><?php echo $template['title']; ?></h4>
</div>
<div class="modal-body">
	<?php echo $template['body'] ?></div>
<?php if ( !isset($disablefootere) ): ?>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
	<button type="button" class="btn btn-primary">确认</button>
</div>
<?php endif ?>