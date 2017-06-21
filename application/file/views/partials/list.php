<div class="uploaded">
	<div class="card">
		<?php if (isset($fileItems)): ?>
		<table class="table">
			<thead>
				<tr>
					<th style="width: 30px;">
						<label class="c-input c-checkbox">
							<input data-toggle="all" type="checkbox">					
							<span class="c-indicator"></span>
						</label>
					</th>
					<th>预览</th>
					<th>名称</th>
					<th>大小</th>
					<th>Mime Type</th>
					<th>文件夹</th>
					<th class="buttons">&nbsp;</th>
				</tr>
			</thead>

			<tbody>
				<?php foreach ($fileItems as $item): ?>
				<tr>
					<td>
						<label class="c-input c-checkbox">
							<input type="checkbox" name="deletes[]" value="<?php echo $item->id ?>"/>
							<span class="c-indicator"></span>
						</label>
					</td>
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
					<td><?php echo $item->mimetype ?></td>
					<td><?php echo $item->folderName ?></td>
					<td class="text-lg-right">
						<?php $this->load->view(isset($button) ? $button : 'partials/button/file', ['item' => $item]) ?>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
			<tfoot>
				<th colspan="50%" style="padding: 10px;">
					<div class="pull-left actions">
						<button class="btn btn-sm btn-danger" 
							data-toggle="confirm" 
							data-message="<h3>你确定你要删除？</h3><p>删除的文件讲不能恢复</p>" 
							name="action" 
							value="delete"
							disabled="disabled"
						>
							<i class="fa fa-trash "></i>
							删除
						</button>
					</div>

					<?php echo $this->load->view('pagination') ?>
					<div style="clear: both;"></div>
				</th>
				
			</tfoot>
		</table>
		<?php else: ?>
			<div class="card-block">没有文件已被上传.</div>
		<?php endif ?>
	</div>	
</div>