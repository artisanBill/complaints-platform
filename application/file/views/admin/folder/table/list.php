<?php if ($folder): ?>
<table class="table">
    <thead>
        <tr>
            <th style="width: 30px;">
                <label class="c-input c-checkbox">
                    <input data-toggle="all" type="checkbox">
                    <span class="c-indicator"></span>
                </label>
            </th>
           	<th>名称</th>
			<th>描述</th>
			<th>位置</th>
			<th>格式</th>
			<th>创建时间</th>
            <th class="buttons"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($folder as $item ): ?>
        <tr id="<?php echo $item->id ?>">
            <td>
                <label class="c-input c-checkbox">
                    <input type="checkbox" name="id[]" value="<?php echo $item->id ?>"/>
                    <span class="c-indicator"></span>
                </label>
            </td>
           <td><?php echo $item->name ?></td>
			<td><?php echo $item->description ?></td>
			<td><label class="label label-danger"><?php echo $item->location ?></label></td>
			<td>
				<?php echo $item->format ?>
			</td>
			<td><?php echo date(Setting::get('dateFormat'), $item->createOn) ?></td>
            <td class="text-lg-right">
                <nobr>
                    <a class="btn btn-sm btn-warning  " href="/content/file/floder/edit/<?php echo $item->id ?>">
                    <i class="fa fa-pencil "></i>
                        编辑
                    </a>
                    <a class="btn btn-sm btn-success  " href="/content/file/upload/<?php echo $item->id ?>">
                        <i class="fa fa-upload "></i>
                        上传
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
                    <button class="btn btn-sm btn-danger " data-toggle="confirm" data-message="<h3>您确定要删除文件夹吗？</h3>
                        <p>目录下的文件也将被删除并且不可恢复.</p>
                        " name="action" value="delete" disabled="disabled"> <i class="fa fa-trash "></i>
                        删除
                    </button>
                </div>
                <?php echo $this->load->view('pagination') ?>
                <div style="clear: both;"></div>
            </th>
        </tr>
    </tfoot>
</table>
<?php else: ?>
<div class="card-block">
    当前没有文件夹存储
</div>
<?php endif ?>