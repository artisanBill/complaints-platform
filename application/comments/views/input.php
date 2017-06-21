<?php if ( isset($this->currentUser->id) ): ?>
	<?php $viewId = isset($view) ? '-' . $view->id : '' ?>
	<?php echo form_open(app_url('.', 'comments/create/' . $this->module . $viewId),
		['id'=>'comments-boone'], [ 'honestyId'=> $view->id]
		) ?>
	<div class="from-group">
		<h5>内容 <span class="text-gander">*</span></h5>
		<small>请认真描述您的内容, 非相关话题请勿介入.</small><br>
		<small style="color: red;">留言不能包含图片, 视频, 音频等媒体文件. 只能纯文本留言，不能与话题无关的留言。如违反了相关规定可能会导致帐号冻结!</small>
		<textarea name="message"
		cols="40"
		rows="6"
		class="form-control" 
		id="message-create" 
		></textarea>
	</div>

	<div class="form-group" style="margin-top: 24px;">
		<button type="submit" id="comments-boone" class="btn btn-primary btn-lg btn-block"><strong>存储信息</strong></button>
	</div>
	<?php echo form_close() ?>
<?php else: ?>
	<h4 class="login text-danger">
		没有登录 ? 
		<a class="btn btn-success-outline" href="<?php echo app_url('.', 'login') ?>">立即登录</a>
	</h4>
<?php endif ?>