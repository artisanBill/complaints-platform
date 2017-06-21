<h3 class="lead">
    信息
</h3>
<dl>
    <dt> VERSION </dt>
    <dd><?php echo $info['version'] ?></dd>

    <dt>PATH</dt>
    <dd><?php echo $info['path'] ?></dd>
    <dt>是否核心</dt>
    <dd>
        <?php if ( $info['isCore'] ): ?>
            <span class="label label-success">YES</span>
        <?php else: ?>
            <span class="label label-default">NO</span>
        <?php endif ?>   
    </dd>

</dl>
