<?php if (isset($moduleDetails['sections']) ) : ?>
<ol class="breadcrumb" style="margin-bottom: 14px;">
    <?php foreach ( $moduleDetails['sections'] as $name => $section ): ?>
        <?php if(isset($section['name']) && isset($section['uri'])): ?>
            <li <?php echo ($section['uri'] == uri_string()) ? 'class="active"' : '' ?>>
                <?php echo anchor($section['uri'], $section['name']); ?>
            </li>
        <?php endif; ?>
    <?php endforeach ?>
</ol>
<?php endif; ?>