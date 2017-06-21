<?php echo form_open(current_url(), [
    'id'    => 'filters',
    'class' => 'form-inline'
]) ?>
    <div class="form-group">
        <input class="form-control" placeholder="关键词搜索" name="userKeyword" type="text">
    </div>

    <div class="form-group">
        <select class="c-select form-control" name="categories">
            <option value='' disabled='' selected="">类别</option>
            <?php foreach ( $categoriesData as $item ): ?>
                <option value='<?php echo $item->id ?>'><?php echo $item->name ?></option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="form-group">
        <select class="c-select form-control" name="status">
            <option value='' disabled='' selected="">状态</option>
            <option value='on'>在线</option>
            <option value='off'>草稿</option>
        </select>
    </div>

    <button type='submit' class='btn btn-success'> <i class='fa fa-filter'></i>
        筛选
    </button>
    <a href="" class='btn btn-secondary-outline'>
        清空
    </a>
<?php echo form_close() ?>