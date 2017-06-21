<style type="text/css">
.blog-post-tags {
	border: none;
}
.boone-honesty-list {
	border-bottom: 1px dashed #d0d9e7;
}
</style>
<?php foreach ( $blogData as $item ): ?>
<div class="card-bolck boone-honesty-list">
	<div class="media">
		<div class="media-left hidden-xs">
			<div class="boone-center-avater">
				<img class="boone-avater" data-src="/<?php echo $item->userAvatar ?>">		
				<small class="release-author">
					<?php echo $item->userDisplayName ?>
				</small>
			</div>
		</div>
		<div class="media-body boone-line-clamp">
			<h4 class="media-heading">
				<a href="<?php echo app_url('.', '/preview/' . $item->blogDomain . '/' . $item->slug) ?>">
					<?php if ( $item->featured ): ?>
						<span class="featured featured-danger">推荐</span>
					<?php endif ?>
					<?php echo $item->metaTitle ?>		
				</a>
			</h4>
			<p class="col-6"><?php echo $item->summary ?></p>

			<div class="honesty-preview-btn">
				<div class="btn-group" data-blogslug="<?php echo $item->blogDomain ?>" data-isuser="<?php echo isset($this->currentUser->id) ?>"  onclick="addHeart($(this))">
					<span class="btn btn-success">
						<i class="fa fa-heart"></i> | 添加关注
					</span>
					<span class="btn btn-success-outline" id="disable-button-hove">
						<?php if ( $item->blogConcern > 500 ): ?>
							<i id="blogHeart<?php echo $item->blogDomain ?>"><?php echo number_format($item->blogConcern / 1000, 2, '.', ' ') ?> K</i>
						<?php else: ?>
							<i id="blogHeart<?php echo $item->blogDomain ?>"><?php echo $item->blogConcern ?></i>
						<?php endif ?>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="blog-post-tags">
		<ul class="list-unstyled list-inline blog-info">
			<li> <i class="fa fa-calendar"></i>
				<?php echo timeTran($item->createOn) ?>
			</li>

			<li> <i class="fa fa-puzzle-piece"></i>
				<a href="<?php echo app_url('.', 'center/'. $item->blogDomain) ?>">
					<?php echo $item->userBlogName ?>
				</a>
			</li>

			<li> <i class="fa fa-eye"></i>
				阅读 <?php echo $item->previewCount ?>
			</li>

			<li> <i class="fa fa-comments"></i>
				评论 <?php echo $item->commentCount ?>
			</li>

			<li> <i class="fa fa-tags"></i>
				<?php echo unserialize($item->tags) ?>
			</li>
		</ul>
	</div>
</div>
<?php endforeach ?>