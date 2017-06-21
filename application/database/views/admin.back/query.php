<div class="invoice">
	<div class="invoice-company"><?php echo lang('brocade.query'); ?></div>
	<div class="invoice-header">
		<div class="invoice-from">
			数据库查询, 正确使用mysql命令查询数据库数据
		</div>
	</div>
	<div class="invoice-content">
		<?php echo form_open(uri_string()); ?>

			<p><textarea class='form-control' id="html_editor" cols="150" rows="10" name="queryWindow"><?php echo $queryString;?></textarea></p>

			<div class="buttons">
				<button type="submit" name="query" value="Query" class="btn btn-info" /><?php echo lang('brocade.runQuery'); ?></button>
			</div>

		<?php echo form_close() ?>
	</div>
</div>
<br>
<?php if( $queryRun ): ?>
<div class="panel panel-shadow" >
	<div class="panel-heading panel-hidden-bottom">
		<h4 class="title">
			<?php echo lang('brocade.queryResults'); ?>
		</h4>
	</div>
	<div class="panel-body">
		<div class="form-group checkboxes-field_type ">
			
			<?php if ($mysqlResultError): ?>	

			<p><?php echo $mysqlResultError; ?></p>
				
			<?php elseif( $results ): ?>
				
			<table class="table table-invoice table-hover dtr-inline">
				<thead>
					<tr>
					<?php
						$keys = [];
						foreach( $results[0] as $key => $result ):
					?>
						<th><?php echo $keys[] = $key; ?></th>
					<?php endforeach; ?>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($results as $result): ?>
					<tr>
						<?php foreach ($keys as $key): ?>
							<td><?php echo $result[$key]; ?></td>
						<?php endforeach ?>
					</tr>			
					<?php endforeach ?>
				</tbody>
			</table>

			<?php else: ?>
				<p><?php echo lang('brocade.noResults') ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php endif; ?>
