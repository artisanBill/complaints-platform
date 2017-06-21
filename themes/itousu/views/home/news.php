<div class="boone-media-reports">
	<div class="container">
		<h2 class="modules-title">
			热点资讯
			<a href="<?php echo app_url('.', '/post') ?>" class="more">更多 &raquo;</a>
		</h2>
		<div class="row">

			<?php foreach ( $postData as $item ): ?>
				<div class="col-md-4 item boone-line-clamp">
					<div class="boone-media-reports-image">
						<img src="<?php echo $item->image ?>">
					</div>
					<h4>
						<?php if ( $item->featured ): ?>
								<span class="btn btn-danger-outline btn-xss">推荐</span>
							<?php endif ?>
						<?php echo mb_substr($item->metaTitle, 0, 12) ?>
					</h4>
					<p class="col-4">
						<?php echo $item->summary ?>
					</p>
					<div class="blog-post-tags details-tags">
						<ul class="list-unstyled list-inline blog-info">
							<li>
								<span class="fa fa-calendar"></span>
								<?php echo timeTran($item->createOn) ?>
							</li>
							<li>
								<span class="fa fa-user"></span>
								<?php echo $item->userDisplayName ?>
							</li>
							<li>
								<span class="fa fa-comments"></span>
								<a href="#"><?php echo $item->commentCount ?> 评论</a>
							</li>
						</ul>

						<ul class="list-unstyled list-inline blog-tags">
							<li>
								<span class="fa fa-tags"></span>
							</li>
							<?php if ( $item->tag ): ?>
								<?php foreach ( userTag($item->tag) as $val ): ?>
									<li>
										<?php echo $val ?>
									</li>
								<?php endforeach ?>
							<?php endif ?>
							
						</ul>
						
					</div>
					<a href="<?php echo app_url('.', 'post/preivew/' . $item->slug) ?>" class="btn btn-success-outline">
						<i class="fa fa-eye"></i>
						查看详情
					</a>
				</div>
			<?php endforeach ?>

		</div>
	</div>
</div>