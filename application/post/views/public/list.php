<?php if ( $postData ): ?>
<?php $keywordPlus = $_GET['data']['userkeyword'] ?? ''  ?>
<?php foreach ( $postData as $item): ?>
<div class="boone-post-list item boone-line-clamp boone-post-bottom">
	<div class="front-cover">
		<img class="boone-news" data-src="<?php echo $item->image ?>">
	</div>
	<h4>
		<?php if ( $item->featured ): ?>
			<span class="featured featured-danger">推荐</span>
		<?php endif ?>
		<a href="<?php echo app_url('.', 'post/preview/' . $item->slug) ?>">
			<?php if ( isset($titleNumber) ): ?>
				<?php echo str_replace($keywordPlus, sprintf('<span class="text-danger">%s</span>', $keywordPlus), mb_strcut($item->metaTitle, 0, 32)) ?>
			<?php else: ?>
				<?php echo str_replace($keywordPlus, sprintf('<span class="text-danger">%s</span>', $keywordPlus), $item->metaTitle) ?>
			<?php endif ?>
		</a>
	</h4>
	<p class="col-4">
		<?php echo str_replace($keywordPlus, sprintf('<span class="text-danger">%s</span>', $keywordPlus), $item->summary) ?>
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
				<a href="<?php echo app_url('.', 'post/preview/' . $item->slug) ?>#loaderCommentList">
					<?php echo $item->commentCount ?> 
					评论
				</a>
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
	<a href="<?php echo app_url('.', 'post/preview/' . $item->slug) ?>" class="btn btn-success-outline" style="margin-bottom: 24px;">
		<i class="fa fa-eye"></i>
		查看详情
	</a>
</div>
<?php endforeach ?>
<?php else: ?>
	该类别没有资讯!
<?php endif ?>