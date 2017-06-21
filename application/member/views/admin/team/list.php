<table class="table">
	<thead>
		<tr>
			<th>姓名</th>
			<th>行业</th>
			<th>认证</th>
			<th>申请时间</th>
			<th class="buttons">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ( $users as $item ): ?>
		<tr id="<?php echo $item->id ?>">
			<td><?php echo $item->fullname ?></td>
			<td><?php echo teamJob($item->industrys) ?></td>
			<td>
				<?php if ( $item->isPass ): ?>
					<span class="label label-sm label-success">通过</span>
				<?php else: ?>
					<span class="label label-sm label-danger">审核</span>
				<?php endif ?>
			</td>
			<td><?php echo date(Setting::get('dateFormat'), $item->createdOn) ?></td>
			<td class="text-lg-right">
				<nobr>
					<a class="btn btn-sm btn-success" href="/root/member/profile/<?php echo $item->id ?>" data-toggle="modal" data-target="#modal">
						<i class="fa fa-eye "></i>
						显示
					</a>
					<?php if ( !$item->isPass ): ?>
					<a href="/root/member/pass/<?php echo $item->id ?>" class="btn btn-sm btn-danger">
						<i class="fa fa-check "></i>
						通过
					</a>
					<?php endif ?>
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