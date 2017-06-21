<?php foreach ($comments as $comment ): ?>
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

				<!-- <div class="btn btn-small btn-reply-user fa fa-reply" 
					data-member="222" 
					data-complain="333"
					>
					回复
				</div> -->

			</h6>
			<ul class="list-unstyled list-inline blog-info">
				<li><span class="fa fa-map-marker"></span><?php echo $comment->ipAddress ?></li>
				<li><span class="fa fa-calendar"></span> <?php echo timeTran($comment->createdOn) ?></li>
				<li class="tousu-vote mouse-active" 
					data-commentid="<?php echo $comment->id ?>" 
					data-guestid="<?php echo $comment->userId ?>" 
					data-exists="<?php echo isset($this->currentUser->id) ?? 0 ?>" 
					data-type='approval'>
					<span class="fa fa-thumbs-up"></span>
					<strong id="approval-<?php echo $comment->id ?>">
						<?php echo $comment->approvalCount ?>
					</strong> 
					赞同
				</li>

				<li class="tousu-vote mouse-active" 
					data-commentid="<?php echo $comment->id ?>" 
					data-guestid="<?php echo $comment->userId ?>" 
					data-exists="<?php echo isset($this->currentUser->id) ?? 0 ?>" 
					data-type='contra'>
					<span class="fa fa-thumbs-down"></span>
					<strong id="contra-<?php echo $comment->id ?>">
						<?php echo $comment->contraCount ?>
					</strong> 
					反对
				</li>
			</ul>
			<p class="timeline-item_content_talk">
				<?php echo $comment->content ?>
			</p>

			<!-- <div id="replyContentAll-2323">

				<div class="timeline-item_content_talk__comment" id="content_talk__comment">

					<article> <i class="icon-triangle"></i>
						<a> <strong>boone</strong>
							sfafasdfasdfsadfasdfs
						</a>
					</article>

				</div>
			</div> -->
			<div id="create-reply-view-23233">
			</div>
		</div>
	</div>
</div>
<?php endforeach ?>
<script type="text/javascript">
$(function()
{
	//	Users vote for
	$('.tousu-vote').click(function()
	{
		if ( $(this).data('exists') == 0 )
		{
			alertMessage('您还没有登录');
			return false;
		}

		var ajaxUrl = $('#itousuSupport').data('ajaxsupport') + '/' + $(this).data('type') + '-' + $(this).data('commentid');

		$.ajax({
			type : 'GET',
			url : ajaxUrl,
			data : {guestid : $(this).data('guestid')},
			dataType : 'json',
			success : function(voteData)
			{
				var strongId = voteData.vote + '-' + voteData.id;

				$('#' + strongId).text(voteData.allcount);
			}
		})
	});
});
</script>