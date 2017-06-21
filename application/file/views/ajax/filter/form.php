<form class="ajax form-inline" role="form" action="<?php echo current_url() ?>" method="GET">
		<select name="folderName" class="c-select form-control">
			<option value selected disabled>目录</option>
			<?php foreach ($folders as $item): ?>
				<option value="<?php echo $item->id ?>" <?php echo ($item->id == $selected) ? 'selected' : '' ?>> 
					<?php echo $item->name ?>
				</option>
			<?php endforeach ?>
		</select>

		<input type="text" name="userKeyword" value="<?php echo isset($baseWhere['userKeyword']) ? $baseWhere['userKeyword'] : NULL ?>" class="form-control" placeholder="请输入关键词查询">


	<button type="submit" class="btn btn-success btn-addon">
		<i class="fa fa-filter"></i>
		筛选
	</button>
	<a href="<?php echo current_url() ?>" class="btn btn-default ajax">
        <i class=" "></i>
        Clear
    </a>
</form>