<?php if ( $complaintItems ): ?>
	<?php foreach ( $complaintItems as $item ): ?>
		<div class="col-sm-6">
			<div class="service-block-v1 md-margin-bottom-50">
				<img src="<?php echo $item->userAvatar ?>">
				<h3 class="title-v3-bg text-uppercase"> <?php echo mb_substr(trim($item->title), 0, 20) ?> </h3>
				
				<div class='tag-text-pos'>
					<div class="blog-post-tags">
						<ul class="list-unstyled list-inline blog-info">
							<li><span class="fa fa-calendar"></span> <?php echo timeTran($item->createdOn) ?></li>
							<li><span class="fa fa-user"></span> <?php echo $item->userDispaly ?></li>
							<li><span class="fa fa-comments"></span>
							<a href="<?php echo site_url('desc-credit/' . $item->id . '#project-comment') ?>"> 
								<?php echo $item->commentCount ?> 评论
								</a>
							</li>
							<li><span class="fa fa-eye"></span> <?php echo $item->previewCount ?> 预览 </li>
						</ul>
						<ul class="list-unstyled list-inline blog-tags">
							<li>
								<a href="#" data-toggle="tooltip" data-placement="top" title="事件发生地址">
									<span class="fa fa-map-marker"></span>
									<?php echo regionList($item->region) ?>
								</a>
								
								<a href="#" data-toggle="tooltip" data-placement="top" title="该事件类型" target="_blank">
									<span class="fa fa-tag"></span>
									<?php echo complainType($item->typeid) ?>
								</a>
								<a href="#" data-toggle="tooltip" data-placement="top" title="该事件状态">
									<span class="fa fa-gavel"></span>
									<?php echo currentCaseActive($item->caseActive) ?>
								</a>
								<a href="#" data-toggle="tooltip" data-placement="top" title="涉及金额">
									<span class="fa fa-cny"></span>
									<?php echo $item->amountAllegedly ?>
								</a>
								<a href="#" data-toggle="tooltip" data-placement="top" title="事件发生时间">
									<span class="fa fa-calendar"></span>
									<?php echo $item->caseeEventOn ?>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<a class="btn btn-primary btn-lg btn-block"
					href="<?php echo app_url('.', 'desc-credit/' . $item->id . '?itousu=' . $item->title) ?>">
					查看该事件详情
				</a>
			</div>
		</div>
	<?php endforeach ?>
<?php else: ?>
<div class="col-md-12">
	<div class="service-block-v1 md-margin-bottom-50">
	<h2>NO RESULT.</h2>
	</div>
</div>
<?php endif ?>