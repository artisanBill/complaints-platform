<div class="project-timeline clearfix">
		<div class="timeline-item update">
		<div class="time">
			<div class="timeline-item_user">
				<img src="/<?php echo $comment->userAvatar ?>" width="100%" alt=""> 
				<i class="icon-progress icon-progress_update fa fa-circle"></i>
			</div>
		</div>
		<div class="timeline-item_content">
			<h6 class="timeline-item_content_user">
				<?php echo $comment->userDisplayName ?>

				<div class="btn btn-small btn-reply-user fa fa-reply" 
					data-usermain="222" 
					data-commentId="222" 
					data-complain="333"
					>
					回复
				</div>

			</h6>
			<ul class="list-unstyled list-inline blog-info">
				<li><span class="fa fa-map-marker"></span><?php echo $comment->ipAddress ?></li>
				<li><span class="fa fa-calendar"></span> <?php echo timeTran($comment->createdOn) ?></li>
				<li class="tousu-vote mouse-active" data-id="sss" data-type='ON'>
					<span class="fa fa-thumbs-up"></span>
					<strong id="tousuON444"><?php echo $comment->approvalCount ?></strong> 赞同
				</li>
				<li class="tousu-vote mouse-active" data-id="333" data-type='OFF'>
					<span class="fa fa-thumbs-down"></span>
					<strong id="tousuOFF33"><?php echo $comment->contraCount ?></strong> 反对
				</li>
			</ul>
			<p class="timeline-item_content_talk">
				<?php echo $comment->content ?>
			</p>
			<div id="create-reply-view-23233">
			</div>

		</div>
	</div>
</div>