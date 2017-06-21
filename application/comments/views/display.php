<?php $allnumber = (isset($view) && is_object($view)) ? $view->commentCount : 0 ?>
<div class="boone-project-publish user-profile">
	<div class="container">
		<div class="card" id="itousuSupport" 
			data-ajaxsupport="<?php echo app_url('.', 'comments/vote') ?>" 
			>
			<span class="handle card-label card-label-success">
				<i class="fa fa-navicon fa-1x"></i>
				<?php echo $title ?? '评论' ?>
				<span class="badge badge-white"><?php echo $allnumber ?></span>
			</span>
			<?php $viewId = (isset($view) && is_object($view)) ? '-' . $view->id : '' ?>
			<div class="card-bolck" 
			id="loaderCommentList" 
			data-ajaxurl="<?php echo app_url('.', '/comments/loader/' . $this->module . $viewId) ?>" 
			data-allnumber="<?php echo $allnumber ?>" 
			>
			<?php if ( ! $allnumber ): ?>
				<h4 style="color: #7C808C">暂时没有人发起回应噢... ！ </h4>
			<?php endif ?>
			<!-- loader contents -->
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="/resources/site/script/app/comment/comment.js"></script>