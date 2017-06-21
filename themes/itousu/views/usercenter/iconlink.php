<style type="text/css">
.boone-help-category .item .icon {
	padding: 20px;
}
</style>
<div class="user-left-info">
	<div class="row boone-help-category" style="padding: 0;margin-bottom: 0px;">
		<div class="col-xs-6 col-sm-2 item" style="margin-bottom:0">
			<a href="/profile">
				<i class="icon fa fa-edit fa-lg text-success"></i>
				<p>我的资料</p>
			</a>
		</div>

		<?php if ( ! $this->member_teams_model->checkActive() ): ?>
		<div class="col-xs-6 col-sm-2 item" style="margin-bottom:0">
			<a href="/join-team">
				<i class="icon fa fa-group fa-lg text-info"></i>
				<p>加入团队</p>
			</a>
		</div>
		<?php endif ?>

		<div class="col-xs-6 col-sm-2 item" style="margin-bottom:0">
			<a href="/honesty/create">
				<i class="icon fa fa-flag fa-lg text-danger"></i>
				<p>发起投诉</p>
			</a>
		</div>

		<div class="col-xs-6 col-sm-2 item" style="margin-bottom:0">
			<a href="<?php echo app_url('user', 'message') ?>">
				<i class="icon fa fa-comments fa-lg text-success"></i>
				<p>我的信件 <span class="label label-sm label-success boone-label">
					<?php echo $this->db->where('acceptUser', $this->currentUser->id)->count_all_results($this->db->dbprefix('site_message')); ?>
				</span></p>
			</a>
		</div>

		<?php if ( $this->member_teams_model->checkActive() ): ?>
		<div class="col-xs-6 col-sm-2 item" style="margin-bottom:0">
			<a href="<?php echo app_url('user', 'blog') ?>">
				<i class="icon fa fa-diamond fa-lg text-info"></i>
				<p>写篇文章 <span class="label label-sm label-info boone-label">
					<?php echo $this->db->where('userId', $this->currentUser->id)->count_all_results($this->db->dbprefix('blog')); ?>
				</span></p>
			</a>
		</div>

		<div class="col-xs-6 col-sm-2 item" style="margin-bottom:0">
			<a href="<?php echo app_url('user', 'setting') ?>">
				<i class="icon fa fa-gear fa-lg text-danger"></i>
				<p>偏好设置</p>
			</a>
		</div>
		<?php endif ?>
	</div>
</div>
