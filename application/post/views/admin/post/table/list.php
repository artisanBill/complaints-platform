<table class="table">
	<thead>
		<tr>
			<th style="width: 30px;">
				<label class="c-input c-checkbox">
					<input data-toggle="all" type="checkbox">
					<span class="c-indicator"></span>
				</label>
			</th>

			<th>标题</th>
			<?php $sort = ($sortPost == 'desc') ? 'desc' : 'asc' ?>
			<th>
				<nobr>
					<a href="?order_by=userId&sort=<?php echo $sort ?>">作者</a>
					<i class="glyphicons <?php echo ($orderBy === 'userId') ? $fontIcon : 'glyphicons-sorting' ?> text-muted"></i>
				</nobr>
			</th>
			<th>
				<nobr>
					<a href="?order_by=categories&sort=<?php echo $sort ?>">类别</a>
					<i class="glyphicons <?php echo ($orderBy === 'categories') ? $fontIcon : 'glyphicons-sorting' ?> text-muted"></i>
				</nobr>
			</th>
			<th>状态</th>
			<th class="buttons">&nbsp;</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ( $postData as $item ): ?>
		<tr id="<?php echo $item->id ?>">
			<td>
				<label class="c-input c-checkbox">
					<input type="checkbox" name="id[]" value="<?php echo $item->id ?>"/>
					<span class="c-indicator"></span>
				</label>
			</td>
			<td><?php echo $item->metaTitle ?></td>
			<td><?php echo $item->userDisplayName ?></td>
			<td><?php echo $item->categoriesName ?></td>
			<td>
				<?php if ( $item->status): ?>
					<span class="label label-sm label-success">在线</span>
				<?php else: ?>
					<span class="label label-sm label-danger">草稿</span>
				<?php endif ?>
			</td>
			<td class="text-lg-right">
				<nobr>
					<a class="btn btn-sm btn-warning  "  href="/edit/1">
						<i class="fa fa-pencil "></i>
						编辑
					</a>
					<a class="btn btn-sm btn-info " 
						target="_blank" 
						href="<?php echo app_url('.', 'post/preivew/' . $item->slug) ?>"
					>
						<i class="fa fa-eye "></i>
						预览
					</a>
				</nobr>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>

	<tfoot>
		<tr>
			<th colspan="50%" style="padding: 10px;">
				<div class="pull-left actions">
					<button class="btn btn-sm btn-danger" 
						data-toggle="confirm" 
						data-message="<h3>你确定你要删除？</h3><p>删除的文章讲不能恢复</p>" 
						name="action" 
						value="delete"
						disabled="disabled"
					>
						<i class="fa fa-trash "></i>
						删除
					</button>
				</div>
				<div style="clear: both;"></div>
			</th>
		</tr>
	</tfoot>
</table>