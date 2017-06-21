<nav class="navbar navbar-default boone-navbar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#boone-navbar" aria-expanded="false">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo app_url('.') ?>" target="_blank">
                <span>投诉网</span>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="boone-navbar">
            <ul class="nav navbar-nav">
                <?php foreach ($userNavigation as $name => $segment): ?>
                    <li <?php echo ($segment == $this->uri->segment(1)) ? 'class="active"' : '' ?>>
                        <a href="<?php echo site_url($segment) ?>"><?php echo $name ?></a>
                    </li>
                <?php endforeach ?>
            </ul>
            <?php filePartial('rightnav') ?>
        </div>
    </div>
</nav>