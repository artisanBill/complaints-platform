<?php
$loggerLevel = [
	'debug'			=> 'warning',
	'info'			=> 'info',
	'Message'		=> 'default',
	'error'			=> 'danger',
];
 ?>
<?php foreach ($lines as $row) : ?>
	<tr>
		<td><span class="label label-<?php echo $loggerLevel[strtolower($row[0])] ?>" ><?php echo $row[0] ?></span></td>
		<td><span class="label label-default <?php echo str_replace(' ','-',strtolower($row[2])) ?>" ><?php echo $row[2] ?></span></td>
		<td><?php echo $row[3] ?></td>
		<td><?php echo $row[1] ?></td>
	</tr>
<?php endforeach; ?>