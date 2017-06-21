<div class="card">
<div class="card-bolck">
		<?php foreach ( $message as $item ): ?>
		<?php $sendUser = unserialize($item->senderUser); ?>

		<div class="media">
			<div class="media-left">
				<div class="boone-center-avater">
					<img class="media-boone-img" src="<?php echo $sendUser['avatar'] ?>">
					<?php if ( $item->isAdmin ): ?>
						<i class="icon-progress fa fa-chevron-down" data-toggle="tooltip" data-placement="top" title="系统信件"></i>
					<?php endif ?>
				</div>
			</div>
			<div class="media-body boone-line-clamp">
				<h4 class="media-heading text-success">
					<?php echo $item->title ?>
				</h4>
				<p>
					<!--// echo htmlspecialchars_decode($item->content) -->
				</p>
				<div>
					<a href='' class='btn btn-secondary-outline btn-xss'>
						<i class="fa fa-user"></i>
						<?php echo $sendUser['displayName'] ?>
					</a>
					<a href='' class='btn btn-secondary-outline btn-xss'>
						<i class="fa fa-eye"></i>
						查看
					</a>
					<a href='' class='btn btn-secondary-outline btn-xss'>
						<i class="fa fa-times"></i>
						<?php echo date(Setting::get('dateFormat'), $item->createdOn) ?>
					</a>
				</div>
			</div>
		</div>
		<?php endforeach ?>

	<span class="card-corner card-corner-success"></span>
</div>
</div>