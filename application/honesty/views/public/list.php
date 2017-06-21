<?php foreach ( $viewItems as $item ): ?>
<div class="col-md-6">
	<div class="card-bolck boone-honesty-list">
		<div class="media">
			<div class="media-left">
				<div class="boone-center-avater">
					<img class="boone-avater" 
						data-src="/<?php echo $item->memberAvatar ?>" 
					>
					<small class="release-author"><?php echo $item->memberDisplayName ?></small>
				</div>
			</div>
			<div class="media-body boone-line-clamp">
				<h4 class="media-heading">
					<a href="/honesty/preview/<?php echo $item->segmentUrl ?>">
						<?php echo mb_strcut($item->metaTitle, 0, 48) ?>
					</a>
				</h4>
				<p class="col-6">
					<?php echo $item->metaDescription ?>
				</p>

				<div class="honesty-preview-btn">
					<div class="btn-group">
						<span class="btn btn-success">
							<a href="/honesty/preview/<?php echo $item->segmentUrl ?>" style="color:white">
								我要帮助 TA
							</a>
						</span>
						<span class="btn btn-success-outline" id="disable-button-hove">
							<a href="/honesty/preview/<?php echo $item->segmentUrl . '#loaderCommentList' ?>">
								<?php echo $item->commentCount ?> 人
							</a>
						</span>
					</div>
					
				</div>
			</div>
		</div>
		<div class="blog-post-tags">
			<ul class="list-unstyled list-inline blog-info">
				<li>
					<i class="fa fa-user"></i>
					受害人 : <?php echo $item->memberFirstName . ' ' . userSex($item->memberGender) ?> 
				</li>

				<?php if ( $item->involveAmount > 1 ): ?>
				<li>
					<i class="fa fa-yen"></i>
					涉嫌金额 : <?php echo $item->involveAmount ?>
				</li>
				<?php endif ?>

				<li>
					<i class="fa fa-calendar"></i>
					事件发生时间 : 
					<?php echo $item->eventDateOn ?>
				</li>

				<li>
					<i class="fa fa-gavel"></i>
					事件状态 : <?php echo currentCaseActive($item->eventActive) ?>
				</li>

				<li>
					<i class="fa fa-map-marker"></i>
					事件发生地点 : <?php echo regionList($item->eventRegion) ?>
				</li>

				<li>
					<i class="fa fa-tag"></i>
					受骗类型 : <?php echo complainType($item->eventType) ?>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php endforeach ?>