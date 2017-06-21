<div class="boone-help">
	<div class="boone-help-search">
		<div class="container">

			<div class="form-group form-group-lg">
				<div class="user-avatar uploader-list">
					<img src="/<?php echo $userBlog->userAvater ?>" width="120" height="120" class="user-avatar-blog">
				</div>
			</div>

			<h2 class="modules-title text-center blog-title"><?php echo $userBlog->blogName ?></h2>
			<p class="text-center">
				<?php echo $userBlog->bio ?>
			</p>

			<div class="honesty-preview-btn blogheart">
				<div class="btn-group" data-blogslug="<?php echo $userBlog->domain ?>" data-isuser="<?php echo isset($this->currentUser->id) ?>"  onclick="addHeart($(this))">
					<span class="btn btn-danger">
						<i class="fa fa-heart"></i> | 添加关注
					</span>
					<span class="btn btn-danger-outline" id="disable-button-hove">
						<?php if ( $userBlog->concern > 500 ): ?>
							<i id="blogHeart<?php echo $userBlog->domain ?>"><?php echo number_format($userBlog->concern / 1000, 2, '.', ' ') ?> K</i>
						<?php else: ?>
							<i id="blogHeart<?php echo $userBlog->domain ?>"><?php echo $userBlog->concern ?></i>
						<?php endif ?>
					</span>
				</div>

				<div class="btn-group" style="margin-left: 4px;">
					<span class="btn btn-success">
						<?php echo teamJob($userBlog->industrys) ?>
					</span>
					<span class="btn btn-success-outline" id="disable-button-hove">
						<?php echo $userBlog->experience ?>
					</span>
				</div>
			</div>

			<div class="help-search-form">
				<div class="col-sm-8 col-sm-offset-2">
					<form method="get" accept-charset="utf-8">
						<div class="input-group input-group-lg">
							<input type="text" name="data[userkeyword]" class="form-control search-blog" placeholder="请输入您的关键字">
							<span class="input-group-btn">
								<button class="btn btn-primary" type="submit"> <i class="fa fa-search"></i>
									搜索
								</button>
							</span>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>