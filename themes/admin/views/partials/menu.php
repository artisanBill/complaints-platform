<ul id="menu">
    <li>
        <a href="<?php echo app_url('.') ?>" target="_blank" class="btn btn-secondary-outline btn-sm">
            预览站点
        </a>
    </li>

    <li class="dropdown">
        <a href="#" data-toggle="dropdown">
            <?php echo $this->currentUser->displayName ?>
        </a>

        <div class="dropdown-menu">

            <div class="arrow"></div>

            <div class="media">
                <a class="media-left pull-left">
                    <img class="media-object user-avatar" src="<?php echo $this->currentUser->avatar ?>">
                </a>
                <div class="media-body">
                    <div class="media-heading">
                        <i class="fa fa-<?php echo $this->currentUser->gender ?>"></i>
                        <?php echo $this->currentUser->firstName . '&nbsp;' . $this->currentUser->lastName ?>
                    </div>
                    <div class="email"><?php echo $this->currentUser->account ?></div>
                    <a href="<?php echo site_url('logout') ?>" class="btn btn-primary btn-sm">
                        登出 &nbsp;<i class="fa fa-sign-out"></i>
                    </a>
                </div>
            </div>
            <hr>
            <a href="/root/users/profile/<?php echo $this->currentUser->id ?>" class="nav-item">查看我的资料</a>
            <br>
            <a href="/setting/settings" class="nav-item">系统便好设置</a>
        </div>
    </li>

</ul>
