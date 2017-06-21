<section id="footer">
    <ul>
        <li class="logo">
            <a href="http://boone.ren" target="_blank">
                <img src="<?php echo base_url('/resources/admin/images/logo-text.svg') ?>">
            </a>
        </li>
        <li class="copyright">
            &copy; <?php date('Y') ?> Boone Inc
        </li>
        <li class="footprint">
            {elapsed_time} <span>|</span> {memory_usage}
        </li>
        <li class="version">
            v1.0.0-beta1
        </li>
    </ul>

    <ul class="pull-right">
        <li class="language">
            <select class="c-select" onchange="window.location = '?_locale=' + this.value;">
                <option value="{{ iso }}" {{ config('app.locale') == iso ? 'selected' }}>
                    简体中文
                </option>
            </select>
        </li>
        <li class="help">
            <a class="btn btn-danger btn-inverse btn-sm" data-toggle="modal" data-target="#modal-help">
                <i class="fa fa-question-circle "></i> Help
            </a>
        </li>
    </ul>

</section>

<div class="modal" id="modal-help">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <div class="container">
                    哈哈
                </div>
            </div>

        </div>
    </div>
</div>
<script src="<?php echo base_url('resources/admin/action.js') ?>"></script>