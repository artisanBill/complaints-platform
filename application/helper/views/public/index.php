<div class="wrapper">
    <div class="boone-help">
        <div class="boone-help-search">
            <div class="container">
                <h2 class="modules-title text-center">您需要什么服务?</h2>
                <div class="help-search-form">
                    <div class="col-sm-8 col-sm-offset-2">
                        <?php echo form_open('/helper') ?>
                            <div class="input-group input-group-lg">
                                <input type="text" name="userKeyword" class="form-control" placeholder="请输入您的问题关键字">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i>
                                        搜索
                                    </button>
                                </span>
                            </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
                <div class="help-search-footer clearfix">
                    <div class="item col-sm-3 col-xs-6 col-sm-offset-2">
                    <i class="fa fa-envelope text-success"></i>
                        发送邮件
                        <small>help@itousu.net</small>
                    </div>
                    <div class="item col-sm-3 col-xs-6 col-sm-offset-2">
                        <a href="">
                            <i class="fa fa-book text-success"></i>
                            问题反馈
                            <small>投诉网希望聆听您的声音</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="background: white;margin-bottom: -20px;">
<div class="container">
    <div class="boone-help-category">

        <?php foreach ($helperData as $item ): ?>
        <div class="col-sm-3 col-xs-6 item">
            <a href="<?php echo app_url('.', 'helper/list/' . $item['id']) ?>">
                <i class="icon <?php echo $item['faIcon'] ?> fa-lg text-success"></i>
                <h6><?php echo $item['title'] ?></h6>
                <p><?php echo $item['description'] ?></p>
            </a>
        </div>
        <?php endforeach ?>

    </div>
</div>
</div>