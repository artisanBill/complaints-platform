<div id="navigation">
    <ul class="nav nav-tabs">
        <?php foreach ( $menuOrder as $icon => $item ): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo ($item !== $this->uri->segment(1) ? : 'active') ?>" href="/<?php echo $item ?>">
                    <i class="fa fa-<?php echo $icon ?> "></i>&nbsp;
                    <?php echo lang('nav.' . $item) ?>
                </a>
            </li>
        <?php endforeach ?>

        <!-- <li class="nav-item">
            <a class="nav-link" data-toggle="push-menu" href="#">
                &bull;&bull;&bull;
            </a>
        </li> -->

    </ul>
</div>
