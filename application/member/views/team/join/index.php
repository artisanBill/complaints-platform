<?php echo $this->load->view('team/join/message') ?>
<?php echo form_open() ?>
<input type="hidden" name="userAvater" id="userphoto" value="<?php echo $userInfo->userAvater ?>">
<div id="user-approve"></div>
<div class="card">
	<span class="handle card-label card-label-success">
		<i class="fa fa-plus fa-1x"></i> 加入投诉网
	</span>
	<div class="card-bolck">
		<div class="form-group form-group-lg">
			<h5>姓名<span class="text-danger"> * </span></h5>
			<p>申请虚假信息, 将被投诉网永久冻结！没有例外, 请填写真实有效资料.</p>
			<?php echo form_input([
				'name'			=> 'fullname', 
				'class'			=> 'form-control', 
				'value' 		=> $this->currentUser->firstName . $this->currentUser->lastName,
				'data-fullname'	=> $this->currentUser->firstName . $this->currentUser->lastName,
			]) ?>
		</div>

		<div class="form-group form-group-lg">
			<h5>身份证号码<span class="text-danger"> * </span></h5>
			<p>申请虚假信息, 将被投诉网永久冻结！没有例外, 请填写真实有效资料.</p>
			<?php echo form_input([
				'name'				=> 'cardNumber', 
				'class'				=> 'form-control', 
				'value' 			=> $userInfo->cardNumber,
				'data-cardNumber'	=> '',
			]) ?>
		</div>

		<div class="form-group form-group-lg">
			<div class="row">
				<div class="col-sm-8">
					<h5>照片<span class="text-danger"> * </span></h5>
					<h5 class="text-danger">
						上传照片请满足以下条件,请参考提供照片
					</h5>
					<ol class="text-danger">
						<li>本人真人照片，确保照片清晰</li>
						<li>非上传艺术照</li>
						<li>非法使用他人照片</li>
						<li>宽度:340像素，高度:420像素</li>
						<li>不超过<span class="label label-sm label-default">100kb</span></li>
						<li>支持格式:
							<span class="label label-sm label-default">jpg</span>
							<span class="label label-sm label-default">jpeg</span>
							<span class="label label-sm label-default">bmp</span>
							<span class="label label-sm label-default">png</span>
						</li>
					</ol>
					<div class="user-avatar" id="upload" data-uploadurl="/upload/reality" style="margin-top: 20px;">
						<div class="btn btn-success btn-lg btn-block dropzone"
							 data-folder="1"
							 data-icon="<i class='fa fa-upload'></i>"
							 data-max-size="200"
							 data-message="上传本人真实照片 "
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
				</div>
				<div class="col-sm-4">
					<div style="max-width: 192px;margin: 0px auto;padding: 6px;border: 1px solid #F7F7F7;">
						<img class="img-responsive" 
						  id="boone-avatar" 
						  <?php if ( $userInfo->userAvater ): ?>
						  	src="<?php echo $userInfo->userAvater ?>"
						  <?php else: ?>
						  	src="/resources/images/itousu/reality.jpg"
						  <?php endif ?>
						  >
					</div>
				</div>
			</div>
		</div>

		<div class="form-group form-group-lg">
			<h5>身份<span class="text-danger"> * </span></h5>
			<p>您的擅长领域.</p>
			<div class="select-group">
				<?php echo form_dropdown('industrys', teamJob(), 
				$userInfo->industrys,
				[
					'class' 			=> 'btn btn-default btn-lg btn-block',
					'data-industrys'	=> ''
				]) ?>
				<b class="caret-line"></b>
			</div>
		</div>

		<div class="form-group form-group-lg">
			<h5>经验<span class="text-danger"> * </span></h5>
			<p>涉足行业年限.</p>
			<div class="select-group">
				<?php echo form_dropdown('experience', [
					'无经验', '1年', '2年', '3年', '4年', '5年', '6年', '7年', '8年', '9年', '10年及以上',
				],
				$userInfo->experience,
				[
					'class' 			=> 'btn btn-default btn-lg btn-block',
					'data-experience'	=> ''
				]) ?>
				<b class="caret-line"></b>
			</div>
		</div>

		<div class="form-group form-group-lg">
			<h5>加入理由<span class="text-danger"> * </span></h5>
			<p>请详细描述你的优势.</p>
			<?php echo form_textarea([
				'name'				=> 'reasons', 
				'class'				=> 'form-control', 
				'value' 			=> $userInfo->reasons,
				'row'				=> 6,
				'data-reasons'		=> '',
			]) ?>
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-success btn-lg btn-block" id="onSubmitTeam">提交申请 [加入团队]</button>
		</div>

	</div>
</div>
<?php echo form_close() ?>
<script type="text/javascript" src="/resources/app/file/js/dropzone.min.js"></script>
<script type="text/javascript" src="/resources/site/script/app/upload/avatar.js "></script>