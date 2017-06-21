<div class="container">
	<div class="card">
	<div class="card-bolck">
		<h2 class="modules-title text-center"><?php echo $view->metaTitle ?></h2>

		<div class="honesty-event-list">
			<li class="btn-group">
				<span class="btn btn-success-outline btn-xss">
					<i class="fa fa-user"></i>
					受害人
				</span>
				<span class="btn btn-success-outline btn-xss">
					<?php echo $view->memberDisplayName ?>
				</span>
			</li>
		
			<?php if ( $view->involveAmount > 1 ): ?>
			<li class="btn-group">
				<span class="btn btn-success-outline btn-xss">
					<i class="fa fa-user"></i>
					涉嫌金额
				</span>
				<span class="btn btn-success-outline btn-xss">
					<?php echo $view->involveAmount ?>
				</span>
			</li>
			<?php endif ?>

			<li class="btn-group">
				<span class="btn btn-success-outline btn-xss">
					<i class="fa fa-calendar"></i>
					时间
				</span>
				<span class="btn btn-success-outline btn-xss">
					<?php echo $view->eventDateOn ?>
				</span>
			</li>

			<li class="btn-group">
				<span class="btn btn-success-outline btn-xss">
					<i class="fa fa-gavel"></i>
					期望
				</span>
				<span class="btn btn-success-outline btn-xss">
					<?php echo currentCaseActive($view->eventActive) ?>
				</span>
			</li>

			<li class="btn-group">
				<span class="btn btn-success-outline btn-xss">
					<i class="fa fa-map-marker"></i>
					地点
				</span>
				<span class="btn btn-success-outline btn-xss">
					<?php echo regionList($view->eventRegion) ?>
				</span>
			</li>

			<li class="btn-group">
				<span class="btn btn-success-outline btn-xss">
					<i class="fa fa-tag"></i>
					类型
				</span>
				<span class="btn btn-success-outline btn-xss">
					<?php echo complainType($view->eventType) ?>
				</span>
			</li>

		</div>

		<div class="view-body">
			<?php echo htmlspecialchars_decode($view->bodyContent) ?>
		</div>
	</div>
	</div>
</div>

<div class="boone-project-publish user-profile">
	<div class="container">
		<div class="card">
			<span class="handle card-label card-label-success"> <i class="fa fa-user fa-1x"></i>
				投诉人信息
			</span>
			<div class="card-bolck">
				<div class="row">
					<div class="col-sm-8">
						<div class="media">
							<div class="media-left">
								<div class="boone-center-avater">
									<img class="media-boone-img" src="/<?php echo $view->memberAvatar ?>">
								</div>
							</div>
							<div class="media-body">
								<h4 class="media-heading">
									<?php echo $view->memberDisplayName ?>
								</h4>
								<p><strong><?php echo $view->memberFirstName . ' ' . userSex($view->memberGender) ?></strong></p>
								<p>
									<?php echo $view->memberProfile ?>
								</p>
							</div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="pull-right">
							<a href="" class="btn btn-success-outline btn-lg">我要帮助 TA</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo $commnets->memberForm([
	'title'		=> '发表建议',
]) ?>
<?php echo $commnets->memberDisplay([
	'title'		=> '大家给TA的建议'
]) ?>