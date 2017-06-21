<div class="uploaded">
	<div class="card">
		<?php if (isset($fileItems)): ?>
		<table class="table">
			<thead>
				<tr>
					<th>预览</th>
					<th>名称</th>
					<th>大小</th>
					<th class="buttons">&nbsp;</th>
				</tr>
			</thead>

			<tbody>
				<?php foreach ($fileItems as $item): ?>
				<tr>
					<td>
						<img src="<?php echo base_url(Files::typeImg($item->type)) ?>" height="34">
					</td>
					<td> <strong><?php echo $item->name ?></strong>
						<br>
						<small class="text-muted">
							<?php echo $item->folderLocation ?>://<?php echo $item->folderSlug ?>/<?php echo $item->filename ?>
						</small>
						<?php if ($item->width): ?>
						<br>
						<span>
							<span class="label label-info label-sm">
								<?php echo $item->width ?> x <?php echo $item->height ?>
							</span>
						</span>
						<?php endif ?>
					</td>
					<td><?php echo byte_format($item->filesize * 1000) ?></td>
					<td class="text-lg-right">
						<a class="btn btn-sm btn-success" 
                            data-select="<?php echo changefileType($item->mimetype) ?>" 
                            data-entry="<?php echo $item->path ?>">
                            <i class="fa fa-check "></i>
                            选择
                      	</a>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		<?php else: ?>
			<div class="card-block">没有文件已被上传.</div>
		<?php endif ?>
	</div>	
</div>