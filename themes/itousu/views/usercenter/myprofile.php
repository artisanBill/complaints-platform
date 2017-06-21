<div class="card-bolck">
	<div class="user-avatar" id="upload" data-uploadurl="/upload/avatar">
		<img class="user-avatar-img" 
		  id="boone-avatar" 
		  src="<?php echo $this->currentUser->avatar ? : '/resources/site/img/avater.png' ?>">
		<div class="btn btn-success-outline btn-xs dropzone"
			 data-folder="1"
			 data-icon="<i class='fa fa-upload'></i>"
			 data-max-size="200"
			 data-message="上传头像 "
			 data-loading="Loading"
			 data-uploading="Uploading"
			 data-max-parallel="1"
			 data-allowed=".jpg,.png,.bmp,.jpeg"></div>
		<div class="uploads"></div>
		<div class="template hidden">
			<div class="upload">
				<small data-dz-name></small>
				<progress class="progress" data-dz-uploadprogress value="0" max="100">0%</progress>
			</div>
		</div>
	</div>
	<div id="uploaded"></div>

	<div class="row">
		<div class="user-profile-support">
			<?php if ( $this->currentUser->card ): ?>
				<span class="btn btn-success btn-xss"><i class="fa fa-check"></i> 实名认证</span>
			<?php else: ?>
				<span class="btn btn-danger-outline btn-xss"><i class="fa fa-times"></i> 未认证</span>
			<?php endif ?>

			<?php if ( $this->currentUser->job ): ?>
				<span class="btn btn-secondary-outline btn-xss">
					<?php echo $this->currentUser->job ?>
				</span>
			<?php endif ?>

			<?php if ( $this->currentUser->birthday ): ?>
				<span class="btn btn-secondary-outline btn-xss">
					<?php echo userConstellation($this->currentUser->birthday) ?>
				</span>

				<span class="btn btn-secondary-outline btn-xss">
					<?php echo userBirthday($this->currentUser->birthday) ?>岁
				</span>
			<?php endif ?>
		</div>
	</div>

	<span class="card-corner card-corner-success"></span>
</div>

<script type="text/javascript" src="/resources/app/file/js/dropzone.min.js"></script>
<script type="text/javascript" src="/resources/site/script/app/upload/avatar.js "></script>