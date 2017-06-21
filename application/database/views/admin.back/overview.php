<div class="invoice">
	<div class="invoice-company"><?php echo lang('boone.database'); ?></div>
	<div class="invoice-header">
		<div class="invoice-from">
			数据库信息, 包涵数据库版本, 伺服器, 编码等等.
		</div>
	</div>
	<div class="invoice-content">
		<table class="table table-invoice table-hover dtr-inline">
			<tbody>
				<tr>
					<td><?php echo lang('boone.mysqlVersion'); ?></td>
					<td><?php echo mysqli_get_client_info(); ?></td>
				</tr>
				<tr>
					<td><?php echo lang('boone.mysqlHost'); ?></td>
					<td><?php echo mysqli_get_host_info($this->db->db_connect()); ?></td>
				</tr>
				<tr>
					<td><?php echo lang('boone.dbEncoding'); ?></td>
					<td><?php echo mysqli_character_set_name($this->db->db_connect()); ?></td>
				</tr>
				<tr>
					<td><?php echo lang('boone.mysqlProtocol'); ?></td>
					<td><?php echo mysqli_get_proto_info($this->db->db_connect()); ?></td>
				</tr>
				<?php foreach( $stats as $stat => $value ): ?>
				<tr>
					<td><?php echo $stat; ?></td>
					<td><?php echo $stat == 'Uptime' ? gmdate('H:i:s', $value) : $value; ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<br>
<div class="panel panel-shadow" >
	<div class="panel-heading panel-hidden-bottom">
		<h4 class="title">
			<?php echo lang('boone.dbProcesses'); ?>
		</h4>
	</div>
	<div class="panel-body">
		<table class="table table-invoice table-hover dtr-inline">
			<thead>
				<tr>
					<th><?php echo lang('boone.user');?></th>
					<th><?php echo lang('boone.host');?></th>
					<th><?php echo lang('boone.command');?></th>
					<th><?php echo lang('boone.time');?></th>
					<th><?php echo lang('boone.state');?></th>
					<th><?php echo lang('boone.info');?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($processes as $process ): ?>
				<tr>
					<td><?php echo $process->User; ?></td>
					<td><?php echo $process->Host; ?></td>
					<td><?php echo $process->Command; ?></td>
					<td><?php echo gmdate('H:i:s', $process->Time); ?></td>
					<td><?php echo $process->State; ?></td>
					<td><?php echo $process->Info; ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

