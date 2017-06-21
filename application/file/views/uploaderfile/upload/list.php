<div class="panel-table">

   <?php if ( isset($fileItems) && $fileItems ): ?>
        <div class="table-responsive">
            <table class="table-condensed table ajax">
                <thead>
                    <tr>
                        <th>Preview</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="buttons">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $fileItems as $item ): ?>
                    <tr id="<?php $item->id ?>">
                        <td class="">
                            <img src="<?php echo $item->path ?>" height="34">
                        </td>
                        <td>
                            <strong><?php echo $item->name ?></strong>
                            <br>
                            <span>
                                <span class="label label-info label-sm">
                                    <?php echo $item->width ?> x <?php echo $item->height ?>
                                </span>
                            </span>
                        </td>
                        <td><?php echo byte_format($item->filesize * 1000) ?></td>
                        <td><?php echo $item->mimetype ?></td>
                        <td class="text-lg-right">
                            <nobr>
                                <a class="btn btn-sm btn-success" 
                                    data-file="<?php echo $item->id ?>" 
                                    data-fileSrc="<?php echo $item->path ?>" 
                                >
                                    <i class="fa fa-check "></i>
                                    选择
                                </a>
                            </nobr>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    <?php else: ?>

        <div class="card-block">没有文件已被上传.</div>

    <?php endif ?>

</div>