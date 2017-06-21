<div class="card card-container">
    <form method="GET" action="<?php echo current_url() ?>" accept-charset="UTF-8" id="filters" class="form-inline">
        <input type="hidden" name="view" value="all">
        <div class="form-group">
            <input class="form-control" placeholder="请输入关键词" name="keywords" type="text"></div>
        <div class="form-group">
            <select class="c-select form-control" name="group">
                <option value="" disabled="" selected="">群组</option>
                <?php foreach ( $groups as $group ): ?>
                <option value="<?php echo $group->id ?>"> <?php echo $group->name ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <button type="submit" class="btn btn-success"> <i class="fa fa-filter "></i>
            筛选
        </button>
        <a href="<?php echo current_url() ?>" class="btn btn-secondary-outline">
            清除
        </a>
    </form>
</div>