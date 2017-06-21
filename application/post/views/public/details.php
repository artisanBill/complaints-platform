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

							<?php if ( $tags ): ?>
							<ul class="list-unstyled list-inline blog-tags">
								<li><span class="fa fa-tags"></span></li>
								<?php foreach ( $tags as $item ): ?>
								<li>
									<a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $item ?>">
										<?php echo $item ?>
									</a>
								</li>
								<?php endforeach ?>
							</ul>
							<?php endif ?>
						</div>
					</div>

					<div class="view-body">
						<?php echo htmlspecialchars_decode($view->bodycontent) ?>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-4 hidden-xs" id="boone-categories">
			<div class="card">
				<?php if ( isset($childCategories) ): ?>
					<div class="handle card-label card-label-default">
						<i class="fa fa-reorder fa-1x"></i> 资讯类别
					</div>
					<?php echo $this->load->view('public/categories') ?>
				<?php endif ?>

				<div class="handle card-label card-label-default">
					<i class="fa fa-reorder fa-1x"></i> 推荐文章
				</div>
				<div class="card-bolck">
					<?php echo $this->load->view('public/list', ['postData' => $newPost, 'titleNumber' => 14 ]) ?>
				</div>
			</div>
		</div>

	</div>
</div>

<?php echo $commnets->memberForm([
	'title'			=> '发表评论',
]) ?>
<?php echo $commnets->memberDisplay([
	'title'	=> '大家的观点'
]) ?>
