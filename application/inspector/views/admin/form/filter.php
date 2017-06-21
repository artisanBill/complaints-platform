<?php echo form_open_multipart(uri_string(), 'class="crud form-inline"') ?>
	<div class="form-group input event">
		<?php echo form_input('textFilter', NULL, 'id="textFilter" class="form-control"'); ?>
		<?php if (isset($textFilter) && trim($textFilter)!= ''): ?>
			<a id="log_clear_filter" href="<?php echo current_url()?>" alt="<?php echo lang('log.clearFilter')?>" ><?php echo lang('log_clear_filter')?></a>
		<?php endif;?>
		<label for="textFilter"><?php echo lang('log.textFilter'); ?></label>
	</div>
	<button type="submit" class="btn btn-success btn-sm">
		<i class="fa fa-filter"></i>
		<?php echo lang('button.filter') ?>
	</button>
	<a href="<?php echo site_url(uri_string()) ?>" class='btn btn-default btn-sm'><?php echo lang('button.cancel') ?></a>
	<?php if (isset($textFilter) && trim($textFilter)!= ''): ?>
	<?php echo anchor('logsInspector/logger/downloadFilter/' . $filename . '_' . $textFilter, lang('log.download.filtered.log'), ' class="btn m-b-xs btn-sm btn-warning" target="_blank"'); ?>
	<?php else: ?>
	<?php echo anchor('logsInspector/logger/download/' . $filename, '<i class="glyphicon glyphicon-download-alt m-r-5"></i>' . lang('button.download'), ' class="btn m-b-xs btn-sm btn-warning" target="_blank"'); ?>
	<?php endif; ?>
<?php echo form_close(); ?>