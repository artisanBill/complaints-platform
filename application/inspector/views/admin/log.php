<div class="invoice">
	<div class="invoice-company"><?php echo lang('log.inspectorTitle') ?></div>
	<div class="invoice-header">
		<div class="invoice-from">
			<?php echo $this->load->view('admin/form/filter') ?>
		</div>
	</div>
	<div class="invoice-note label-type" style="margin-top:0">
		<?php foreach ($types as $itemKey => $ammount): ?>
			<li data-toggle="tooltip" data-placement="top" class="btn btn-default btn-xs m-r-5 m-b-5 label-<?php echo str_replace(' ','-',strtolower($itemKey)) ?>" >
				<b class="badge badge-inverse pull-left m-r-5"><?php echo $ammount ?></b>
				<span><?php echo $itemKey?></span>
			</li>
		<?php endforeach?>
	</div>
	<div class="invoice-content">
		<table class="table table-invoice table-hover dtr-inline errors">
			<thead>
				<tr>
					<th><?php echo lang('log.type'); ?></th>
					<th><?php echo lang('log.level'); ?></th>
					<th><?php echo lang('log.message'); ?></th>
					<th><?php echo lang('log.date'); ?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="7">
						<div ><?php $this->load->view('pagination'); ?></div>
					</td>
				</tr>
			</tfoot>
			<tbody>
				<?php $this->load->view('admin/tables/log_table'); ?>
			</tbody>
		</table>
	</div>
</div>