<div class="invoice">
	<div class="invoice-company"><?php echo lang('brocade.dbTables'); ?></div>
	<div class="invoice-header">
		<div class="invoice-from">
			<?php echo lang($this->moduleDetails['slug'] . '.details.description') ?>
		</div>
	</div>
	<div class="invoice-content">
		<?php echo form_open('database/tables'); ?>
		<table class="table table-invoice table-hover dtr-inline">
			<thead>
				<tr>
					<th>
						<label class="checkbox">
		                    <input data-toggle="all" type="checkbox">
		                </label>
					</th>
					<th>
						<?php echo lang('brocade.tableName'); ?>
						<span class="badge badge-danger"><?php echo count($tables) ?></span>
					</th>
					<th><?php echo lang('brocade.engine'); ?></th>
					<th><?php echo lang('brocade.rows'); ?></th>
					<th><?php echo lang('brocade.size'); ?></th>
					<th>Collation</th>
					<th><?php echo lang('brocade.comment'); ?></th>
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
						<?php echo anchor('database/tables/table/'.$table->Name, ucfirst(str_replace('brocade_', '', $table->Name))); ?>
					</td>
					<td><span class='label label-success'><?php echo $table->Engine; ?></span></td>
					<td><?php echo number_format($table->Rows); ?></td>
					<td><span class='label label-warning'><?php echo byte_format($table->Data_length);?></span></td>
					<td><span class='label label-info'><?php echo $table->Collation ?></span></td>
					<td><?php echo $table->Comment; ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<div class="invoice-footer">
				<button class="btn btn-warning disabled "  data-toggle="confirm" data-message="<h3>数据库表修复</h3><p>您确定要操作吗？</p>" name="action" value="delete">
					修复表
				</button>				

				<button class="btn btn-info disabled "  data-toggle="confirm" data-message="<h3>数据库表优化</h3><p>您确定要操作吗？</p>" name="action" value="delete">
					优化表
				</button>			
		</div>
		<?php echo form_close() ?>
	</div>
</div>
