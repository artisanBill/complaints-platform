<div class="container-fluid">
<div class="card">
    <form method="POST" action="" accept-charset="UTF-8">
        <input name="_token" type="hidden" value="ZGiZtgV4oFtAuiYM3IZdzNUXjtlqOc1JwAQFoKev">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>名称</th>
                        <th>描述</th>
                        <th class="buttons">&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($coreModules as $module): ?>
                    <?php if ($module['slug'] === 'addon') continue ?>
                    <tr id="<?php echo $module['slug'] ?>">
                        <td class=""><?php echo $module['name'] ?></td>
                        <td class=""><?php echo $module['description'] ?></td>
                        <td class="text-lg-right">
                            <nobr>
                                <a class="btn btn-sm btn-info" href="<?php echo site_url('application/addon/info/' . $module['slug']) ?>" 
                                 data-toggle="modal" 
                                 data-target="#modal">
                                <i class="fa fa-info "></i>
                                    信息
                                </a>
                                <a class="btn btn-sm btn-danger" 
                                    data-toggle="confirm" 
                                    data-message="<h3>你确定要卸载？</h3><p>任何相关的数据都将丢失。</p>" 
                                    href="">
                                <i class="fa fa-times-circle "></i>
                                    卸载
                                </a>
                            </nobr>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>

                <tfoot>
                    <tr>
                        <th colspan="50%" style="padding: 10px;">

                            <div class="pull-left actions"></div>

                            <div style="clear: both;"></div>

                        </th>
                    </tr>
                </tfoot>

            </table>
        </div>
    </form>

</div>
    </div>