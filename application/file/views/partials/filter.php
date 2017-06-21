<form method='GET' action="<?php echo isset($isAjax) ? app_url('user', 'upload/choose') : current_url() ?>" 
    accept-charset="UTF-8" 
    id="filters" 
    class="<?php echo isset($isAjax) ? 'ajax' : '' ?> form-inline">
    <input type="hidden" name="view" value="all">
    <div class="form-group">
        <input class="form-control" placeholder="关键词搜索" name="userKeyword" type="text"></div>
    <div class="form-group">
        <select class="c-select form-control" name="folderName">
            <option value='' disabled='' selected="">文件夹</option>
            <?php foreach ( $folders as $folder ): ?>
                <option value="<?php echo $folder->id ?>" <?php echo ($folder->id == $selected) ? 'selected' : '' ?>> 
                    <?php echo $folder->name ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>
    <button type='submit' class='btn btn-success'> <i class='fa fa-filter'></i>
        筛选
    </button>
    <a href="" class='btn btn-secondary-outline'>
        清空
    </a>
</form>