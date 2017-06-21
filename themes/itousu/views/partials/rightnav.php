<?php if ( isset($this->currentUser->id) ): ?>
<ul class="nav navbar-nav navbar-right">
    <li>
        <a href="<?php echo app_url('user', 'honesty/create') ?>" class="active">发起投诉</a>
    </li>
    <li class="dropdown">
        <a href="javascript:void(0);" class="dropdown-toggle user-dropdown" data-toggle="dropdown">
            <span>
                <img src="/<?php echo $this->currentUser->avatar ?>" class="img-circle lazy-load" width="40" height="40" alt="">
            </span>
            <strong><?php echo $this->currentUser->displayName ?></strong>
            <b class="caret-line"></b>
        </a>
        <ul class="dropdown-menu user-dropdown-menu clearfix">
            <span class="arrow"></span>
            <li>
                <a href="<?php echo app_url('user', '') ?>"> <i class="fa fa-home"></i>
                    我的首页
                </a>
            </li>
            <li>
                <a href="<?php echo app_url('user', 'message') ?>"> <i class="fa fa-user"></i>
                    我的信件
                    <span class="label label-sm label-success boone-label">
                    <?php echo $this->db->where('acceptUser', $this->currentUser->id)->count_all_results($this->db->dbprefix('site_message')); ?>
                    </span>
                </a>
            </li>
            <li>
                <a href="<?php echo app_url('user', 'honesty') ?>"> <i class="fa fa-legal"></i>
                    投诉列表
                </a>
            </li>
            <?php if ( ! $this->member_teams_model->checkActive() ): ?>
                <li>
                    <a href="<?php echo app_url('user', 'join-team') ?>"> <i class="fa fa-star"></i>
                        加入团队
                    </a>
                </li>
            <?php endif ?>
            
            <li>
                <a href="<?php echo app_url('user', 'profile') ?>"> <i class="fa fa-user"></i>
                    我的资料
                </a>
            </li>
            <li>
                <a href="<?php echo app_url('.', 'logout') ?>">
                    <i class="fa fa-sign-out"></i>
                    登出
                </a>
            </li>
        </ul>
    </li>
</ul>
<?php else: ?>
    <ul class="nav navbar-nav navbar-right">
        <li>
            <a href="<?php echo app_url('.', 'login') ?>" class='active'>登录</a>
        </li>
    </ul>
<?php endif ?>
