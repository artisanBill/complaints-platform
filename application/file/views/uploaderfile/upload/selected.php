<?php if ($fileItem): ?>
<div class="panel-table">
    <div class="table-responsive">
        <table class="table">
            <tbody>
                <tr id="<?php echo $fileItem->id ?>">
                    <td class="" >
                        <img src="<?php echo $fileItem->path ?>" height="52"></td>
                    <td class="" >
                    <strong><?php echo $fileItem->name ?></strong>
                        <br>
                        <span>
                            <span class="label label-info label-sm">
								<?php echo $fileItem->width ?> x <?php echo $fileItem->height ?>
                            </span>
                        </span>
                    </td>
                     <td><?php echo byte_format($fileItem->filesize * 1000) ?></td>
                        <td><?php echo $fileItem->mimetype ?></td>
                    <td class="text-lg-right">
                        <nobr>
                            <a class="btn btn-sm btn-danger" data-dismiss="file"> <i class="fa fa-ban"></i>
                                移除
                            </a>
                        </nobr>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php endif ?>