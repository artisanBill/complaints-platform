<table class="table">
	<thead>
		<tr>
			<th style="width: 60px;">&nbsp;</th>
			<th>
				<nobr>
					<a href="users?order_by=display_name&amp;sort=asc">用户名</a>
					<i class="glyphicons glyphicons-sorting text-muted"></i>
				</nobr>
			</th>
			<th>
				<nobr>
					<a href="users?order_by=email&amp;sort=asc">手机号码</a>
					<i class="glyphicons glyphicons-sorting text-muted"></i>
				</nobr>
			</th>
			<th>姓名</th>
			<th>状态</th>
			<th class="buttons">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ( $users as $item ): ?>
			<tr id="<?php echo $item->id ?>">
				<td>
					<?php if ( $item->avatar ): ?>
						<img src="/<?php echo $item->avatar ?>" width="52">
					<?php else: ?>
						<img src="/resources/site/img/avater.png" width="52">
					<?php endif ?>
				</td>
				<td><?php echo $item->userDisplayName ?></td>
				<td><?php echo $item->mobile ?></td>
				<td><?php echo $item->userFirstName . ' ' . $item->userLastName ?></td>
				<td>
					<?php if ( $item->active ): ?>
						<span class="label label-sm label-success">正常</span>
					<?php else: ?>
						<span class="label label-sm label-danger">冻结</span>
					<?php endif ?>
				</td>
				<td class="text-lg-right">
					<nobr>
						<a class="btn btn-sm btn-success" href="">
							<i class="fa fa-eye "></i>
							显示
						</a>
					</nobr>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="6">
				<?php echo $this->load->view('pagination') ?>
			</td>
		</tr>
	</tfoot>
</table>