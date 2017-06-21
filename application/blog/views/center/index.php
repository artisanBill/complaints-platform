<?php echo $this->load->view('center/profile') ?>

<?php if ( $blogData ): ?>
<div class="container">
	<div class="card">
		<div class="card-bolck">
			
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
					<div class="media-body boone-line-clamp">
						<h4 class="media-heading">
							<a href="<?php echo app_url('.', '/preview/' . $item->blogDomain . '/' . $item->slug) ?>">
								<?php if ( $item->featured ): ?>
									<span class="featured featured-danger">推荐</span>
								<?php endif ?>
								<?php echo $item->metaTitle ?>		
							</a>
						</h4>
						<p><?php echo $item->summary ?></p>
					</div>
				</div>
				<div class="blog-post-tags">
					<ul class="list-unstyled list-inline blog-info">
						<li> <i class="fa fa-calendar"></i>
							<?php echo timeTran($item->createOn) ?>
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


		</div>
	</div>
</div>
<script type="text/javascript" src="/resources/site/script/app/blog/public.js"></script>
<?php else: ?>
	<h4>该博主还没有写文章</h4>
<?php endif ?>