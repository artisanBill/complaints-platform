<div class="container">
	<div class="row">
		<div class="col-sm-8 col-xs-12">
			<div class="card">
				<div class="card-bolck">
					<h2 class="modules-title text-center"><?php echo $view->metaTitle ?></h2>

					<div class='tag-text-pos'>
						<div class="blog-post-tags details-tags">
							<ul class="list-unstyled list-inline blog-info">
								<li><span class="fa fa-calendar"></span> <?php echo timeTran($view->createOn) ?></li>
								<li><span class="fa fa-user"></span> <?php echo $view->userDisplayName ?></li>
								<li><span class="fa fa-comments"></span><a href="#"> <?php echo $view->commentCount ?> 评论</a></li>
							</ul>
						</div>
					</div>

					<div class="view-body">
						<?php echo htmlspecialchars_decode($view->content) ?>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-4 hidden-xs" id="boone-categories">
			<div class="card">
				<div class="card-bolck">

					<div class="honesty-preview-btn">
						<div class="btn-group" data-blogslug="<?php echo $userBlog->domain ?>" data-isuser="<?php echo isset($this->currentUser->id) ?>"  onclick="addHeart($(this))">
							<span class="btn btn-success">
								<i class="fa fa-heart"></i> | 添加关注
							</span>
							<span class="btn btn-success-outline" id="disable-button-hove">
								<?php if ( $userBlog->concern > 500 ): ?>
									<i id="blogHeart<?php echo $userBlog->domain ?>"><?php echo number_format($userBlog->concern / 1000, 2, '.', ' ') ?> K</i>
								<?php else: ?>
									<i id="blogHeart<?php echo $userBlog->domain ?>"><?php echo $userBlog->concern ?></i>
								<?php endif ?>
							</span>
						</div>
					</div>

				</div>
			</div>
		</div>

	</div>
</div>
<script type="text/javascript" src="/resources/site/script/app/blog/public.js"></script>
<?php echo $commnets->memberForm([
	'title'			=> '发表评论',
]) ?>
<?php echo $commnets->memberDisplay([
	'title'	=> '大家的观点'
]) ?>