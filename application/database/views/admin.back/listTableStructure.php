<div class="invoice">
	<div class="invoice-company">
		<a href="<?php echo site_url('database/tables'); ?>"><?php echo lang('brocade.tables'); ?></a> &rarr; <?php echo $tableName; ?>
	</div>
	<div class="invoice-header">
		<div class="invoice-from">
			<?php echo lang($this->moduleDetails['slug'] . '.details.description') ?>
		</div>
	</div>
	<div class="invoice-content">
		<table class="table table-invoice table-hover dtr-inline">
			<thead>
				<tr>
					<th><?php echo lang('brocade.colName'); ?></th>
					<th><?php echo lang('brocade.colType'); ?></th>
					<th><?php echo lang('brocade.constraint'); ?></th>
					<th><?php echo lang('brocade.notes'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($fields as $field): ?>
				<tr>
					<td><?php echo $field->name; ?></td>
					<td><?php echo $field->type; ?></td>
					<td><?php echo $field->max_length; ?></td>
					<td><?php if($field->primary_key == "1") { echo lang('brocade.primaryKey'); } ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>