<?php if ( $viewItems ): ?>
<table class="table">
	<thead>
		<tr>
			<th>标题</th>
			<th>涉及金额</th>
			<th>受骗类型</th>
			<th>状态</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ( $viewItems as $item ): ?>
			<tr>
				<td><?php echo mb_substr($item->metaTitle, 0, 10) ?></td>
				<td><?php echo $item->involveAmount ?></td>
				<td><?php echo complainType($item->eventType) ?></td>
				<td><?php echo currentCaseActive($item->eventActive) ?></td>
				<td>
					<nobr class="pull-right">
					<a href="<?php echo app_url('.', 'honesty/preview/' . $item->segmentUrl) ?>" class="btn btn-success" target="_blank">
						<i class="fa fa-eye"></i>
						预览
					</a>
					<?php if ( isset($changeUser) ): ?>
						<a href="/message/send-to/<?php echo  $this->module . '@' . $crypter->encrypt($changeUser->id) . '@' . $item->segmentUrl ?>" 
						class="btn btn-info" 
						>
							<i class="fa fa-check"></i>
							选择
						</a>
					<?php endif ?>
					</nobr>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
<?php else: ?>
	您没有发起投诉事件
<?php endif ?>