<?php if ( $data ): ?>
<?php foreach ( $data as $item ): ?>
<div class="boone-post-list item boone-line-clamp boone-post-bottom" id="blogRemove<?php echo $item->id ?>">
	<h4 data-categories="<?php echo $item->categories ?>" data-blogslug="<?php echo $item->id ?>" id="blogInfo">
		<?php if ( $item->featured ): ?>
			<span class="featured featured-danger">推荐</span>
		<?php endif ?>
		<a href="<?php echo app_url('.', '/preview/' . $item->blogDomain . '/' . $item->slug) ?>">
			<?php echo $item->metaTitle ?>
		</a>
	</h4>
	<p>
		<?php echo $item->summary ?>
	</p>
	<div class="blog-post-tags details-tags">
		<ul class="list-unstyled list-inline blog-info">
			<li> <i class="fa fa-calendar"></i>
				<?php echo timeTran($item->createOn) ?>
			</li>
			<li>
				<span class="fa fa-comments"></span>
				<?php echo $item->commentCount ?>
			</li>
			<li>
				<span class="fa fa-eye text-white"></span>
				<?php echo $item->previewCount ?>
			</li>
			<li class="cursorOn text-info" onclick="editerBlog()">
				<span class="fa fa-edit"></span>
				编辑
			</li>
			<li class="cursorOn text-danger" onclick="blogRemove()">
				<span class="fa fa-trash"></span>
				删除
			</li>
		</ul>
	</div>
</div>
<?php endforeach ?>
<?php else: ?>
<h4>No result</h4>
<?php endif ?>
