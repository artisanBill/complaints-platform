<div class="modal-header">
	<button class="close" data-dismiss="modal">
		<span>&times;</span>
	</button>
	<h4 class="modal-title"><?php echo $template['title'] ?></h4>
</div>

<div class="modal-body">
	<ul class="nav nav-pills nav-stacked">
		<?php if ($folder): ?>

		<?php foreach ($folder as $item): ?>
			<li class="nav-item">
					<a 
						href="/content/file/upload/<?php echo $item->id ?>" 
						class="nav-link <?php echo isset($ajax) ? 'ajax' : '' ?>"
					>
					<strong>
						<i class="fa fa-folder-open text-info"></i> <?php echo $item->name ?>
					</strong>
					<br>
					<small>
						<?php echo $item->description ?>
						<label class="label label-danger m-l-xs"><?php echo $item->location ?></label>
						<span class="pull-right">
							<?php foreach ( Files::formatArray($item->format) as $format ): ?>
								<span class="label label-default"><?php echo $format ?></span>
							<?php endforeach ?>
						</span>
					</small>
				</a>
			</li>
		<?php endforeach ?>

		<?php else: ?>
			<li class="nav-item">
				<a href="" class="ajax nav-link">
					<strong>NO RESULT</strong>
				</a>
			</li>
		<?php endif ?>
	</ul>
</div>