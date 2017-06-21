<table class="table table-invoice table-hover dtr-inline">
	<thead>
		<tr>
			<th><?php echo lang('log.filename'); ?></th>
			<th><?php echo lang('log.date'); ?></th>
			<th><?php echo lang('log.size'); ?></th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($logs as $log) : 
		if ($log['name'] != 'index.html'): ?>
		<tr>
			<td><?php echo $log['name'] ?></td>
			<td><?php echo date(Settings::get('dateFormat'),$log['date']) ?></td>
			<td><?php echo $log['size'] ?></td>
			<td>
			<?php
				echo Html::tag('a', [
					'href'		=> site_url('logsInspector/logger/view/' .  str_replace('.php', '', $log['name'])),
					'class'		=> 'btn btn-xs r-b-5 btn-info',
				], '<i class="fa fa-eye fa-fw m-r-xs"></i>' . lang('button.preview')) . '&nbsp;' . 

				Html::tag('a', [
					'href'		=> site_url('logsInspector/logger/plain/' .  str_replace('.php', '', $log['name'])),
					'class'		=> 'btn btn-xs r-b-5 btn-warning',
					'target'	=> '_blank',
				], '<i class="fa fa-eye fa-fw m-r-xs"></i>' . lang('viewPlain')) . '&nbsp;' .

				Html::tag('a', [
					'href'		=> site_url('logsInspector/logger/download/' .  str_replace('.php', '', $log['name'])),
					'class'		=> 'btn btn-xs r-b-5 btn-success',
					'target'	=> '_blank',
				], '<i class="fa fa-arrow-down fa-fw m-r-xs"></i>' . lang('button.download')) . '&nbsp;' .

				Html::tag('a', [
					'href'		=> site_url('logsInspector/logger/delete/' .  str_replace('.php', '', $log['name'])),
					'class'		=> 'btn btn-xs r-b-5 btn-danger',
				], '<i class="fa fa-trash-o fa-fw m-r-xs"></i>' . lang('button.delete'))
			?>
			</td>
		</tr>
	<?php endif; ?>
	<?php endforeach; ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="7">
				<div class="inner"><?php $this->load->view('pagination'); ?></div>
			</td>
		</tr>
	</tfoot>
</table>