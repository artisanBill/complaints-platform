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
			<th>描述</th>
			<th class="buttons">&nbsp;</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ( $teams as $item ): ?>
		<tr id="<?php echo $item->id ?>">
			<td>
				<label class="c-input c-checkbox">
					<input type="checkbox" name="id[]" value="<?php echo $item->id ?>"/>
					<span class="c-indicator"></span>
				</label>
			</td>
			<td><?php echo $item->name ?></td>
			<td><?php echo $item->description ?></td>
			<td class="text-lg-right">
				<nobr>
					<a class="btn btn-sm btn-warning  "  href="/edit/1">
						<i class="fa fa-pencil "></i>
						编辑
					</a>
					<a class="btn btn-sm btn-info  " href="/root/users/teams/permissions/<?php echo $item->id ?>">
		                <i class="fa fa-lock "></i>
		                设定权限
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