<?php foreach ( $users as $item ): ?>
<div class="col-sm-3 col-xs-6">
	<div class="thumbnail">
		<img class="img-responsive" src="<?php echo $item->userAvater ?>">
		<div class="caption">
			<h3><?php echo $item->userDisplayName ?></h3>
			<p>
				<?php if ( $item->countHelper ): ?>
					<span class="label label-sm label-success">已帮助 <?php echo $item->countHelper ?></span>
				<?php endif ?>
				<span class="label label-success">
					<?php echo teamJob($item->industrys) ?>
				</span>

				<span class="label label-danger">
					<?php echo $item->experience ?> 年经验
				</span>
			</p>
			<p><?php echo $item->userBio ?></p>
			<hr>
			<div class="row">
				<div class="col-sm-6">
					<a class="btn btn-success-outline btn-lg"
						href="<?php echo app_url('user', 'honesty/helper/' . $cryptor->encrypt($item->userId)) ?>">
						请求TA帮助
					</a>
				</div>
				<div class="col-sm-6">
					<a class="btn btn-info btn-success btn-lg"
						href="<?php echo app_url('user', 'advisory/problem/' . $cryptor->encrypt($item->userId)) ?>">
						咨询 TA
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endforeach ?>