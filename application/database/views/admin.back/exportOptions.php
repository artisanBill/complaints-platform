<?php echo form_open('database/export'); ?>
<div class="invoice">
	<div class="invoice-company">
		<?php echo lang('brocade.export') ?>
	</div>
	<div class="invoice-header">
		<div class="invoice-from form-inline">
			<div class="form-group">
				<label class='control-label m-b-5'><?php echo lang('brocade.fileFormat') ?></label>
				<?php echo form_dropdown('format', $fileFormats, '', ['class'=>'form-control selectpicker', 'data-live-search'=>'true', 'data-style'=>'btn-white']); ?>
			</div>
			
			<div class="form-group">
				<label data-toggle="tooltip" data-placement="top" title="<?php echo lang('brocade.filenameInstructions') ?>" style='display:block'>
					<?php echo lang('brocade.filename') ?>
				</label>
				<input type="text" class="form-control" name="filename" />
			</div>

			<div class="form-group">
			<label class="control-label m-b-5">
				<?php echo lang('brocade.includeDrop'); ?>
			</label>
			<?php echo form_dropdown('addDrop', $trueFalse, '', ['class'=>'form-control selectpicker', 'data-live-search'=>'true', 'data-style'=>'btn-white']) ?>
			</div>

			<div class="form-group">
				<label class="control-label m-b-5">
					<?php echo lang('brocade.includeInsert') ?>
				</label>
			<?php echo form_dropdown('addInsert', $trueFalse, '', ['class'=>'form-control selectpicker', 'data-live-search'=>'true', 'data-style'=>'btn-white']); ?>
			</div>

			<div class="form-group">
				<label class="control-label m-b-5">
					<?php echo lang('brocade.newline'); ?>
				</label>
			<?php echo form_dropdown('newline', $newlines, '', ['class'=>'form-control selectpicker', 'data-live-search'=>'true', 'data-style'=>'btn-white']) ?>
			</div>

		</div>
	</div>

	<div class="invoice-content">
		<table class="table table-invoice table-hover dtr-inline">
			<thead>
				<tr>
					<th>
						<label class="checkbox">
		                    <input data-toggle="all" type="checkbox">
		                </label>
					</th>
					<th><?php echo lang('brocade.tableName') ?></th>
					<th><?php echo lang('brocade.rows') ?></th>
					<th><?php echo lang('brocade.size') ?></th>
					<th>Collation</th>
					<th><?php echo lang('brocade.comment') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($tables as $table): ?>
				<tr>
					<td>
						<label class="checkbox">
							<?php echo form_checkbox('actionTo[]', $table->Name);?>
						</label>
					</td>
					<td>
						<?php echo ucfirst(str_replace('brocade_', '', $table->Name)) ?>
					</td>
					<td><?php echo number_format($table->Rows) ?></td>
					<td><?php echo byte_format($table->Data_length) ?></td>
					<td><?php echo $table->Collation ?></td>
					<td><?php echo $table->Comment ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

	</div>

	<div class="invoice-footer">
		<button class="btn btn-success disabled "  data-toggle="confirm" data-message="<h3>数据库导出</h3><p>您确定要导出所选的数据库表吗？</p>" name="action" value="delete">
			<?php echo lang('brocade.export'); ?>
		</button>
	</div>
	
</div>
<?php echo form_close() ?>

