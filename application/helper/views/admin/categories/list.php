<?php if ($views): ?>
<table class="table">
    <thead>
        <tr>
            <th style="width: 30px;">
                <label class="c-input c-checkbox">
                    <input data-toggle="all" type="checkbox">
                    <span class="c-indicator"></span>
                </label>
            </th>
            <th>类别名称</th>
            <th>状态</th>
            <th>描述</th>
            <th class="buttons">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ( $views as $item ): ?>
        <tr id="<?php echo $item->id ?>">
            <td>
                <label class="c-input c-checkbox">
                    <input type="checkbox" name="id[]" value="<?php echo $item->id ?>"/>
                    <span class="c-indicator"></span>
                </label>
            </td>
            <td>
                <?php echo $item->parent > 0 ? '<span class="label label-sm label-success">Child</span>' : '' ?>
                <?php if ( $item->faIcon): ?>
                    <span class="<?php echo $item->faIcon ?>"></span>
                <?php endif ?>
                <?php echo $item->title ?>
            </td>
            <td>
                <?php if ( $item->isDisplay ): ?>
                    <span class="label label-sm label-success">显示</span>
                <?php else: ?>
                    <span class="label label-sm label-danger">隐藏</span>
                <?php endif ?>
            </td>
            <td><?php echo $item->description ?></td>
            <td class="text-lg-right">
                <nobr>
                    <a class="btn btn-sm btn-warning" 
                        href="/content/helper/categories/edit/<?php echo $item->id ?>" 
                        data-toggle="modal" 
                        data-target="#modal">
                        <i class="fa fa-pencil "></i>
                        编辑
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
                    data-message="<h3>您确定要删除该分类吗？</h3><p>该分类下的文章也将被删除并且不可恢复.</p>" 
                    name="action" 
                    value="delete"
                    disabled
                    >
                        <i class="fa fa-trash "></i>
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
    文章没有类别存在
</div>
<?php endif ?>