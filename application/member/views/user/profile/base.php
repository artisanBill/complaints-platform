<link rel="stylesheet" type="text/css" href="/resources/site/stylesheet/datepicker.css">
<div class="form-group form-group-lg">
	<h5>显示名称</h5>
	<small>其他用户也可见的呢称, 不是您的真实姓名.</small>
	<?php echo form_input([
		'name'=>'displayName', 
		'class'=> 'form-control', 
		'placeholder' => '请输入您呢称', 
		'value' => $this->currentUser->displayName
		]) ?>
</div>

<div class="form-group form-group-lg">
	<h5>贵姓</h5>
	<small>请填写您的真实贵姓, 虚假信息会导致您的帐户被停用.</small>
	<?php echo form_input([
		'name'			=>'firstName', 
		'class'			=> 'form-control', 
		'placeholder'	=> '请输入您贵姓', 
		'value'			=> $this->currentUser->firstName
		]) ?>
</div>

<div class="form-group form-group-lg">
	<h5>名字</h5>
	<small>请填写您的真实名字, 虚假信息会导致您的帐户被停用.</small>
	<?php echo form_input([
		'rows'			=> 5,
		'name'			=>'lastName', 
		'class'			=> 'form-control', 
		'placeholder'	=> '请输入您名字', 
		'value'			=> $this->currentUser->lastName,
		]) ?>
</div>

<div class="form-group form-group-lg">
	<h5>性别</h5>
	<div class="select-group">
		<?php echo form_dropdown('gender', [
				'male'		=> '男士',
				'female'	=> '女士',
			], 
			$this->currentUser->gender, 
			['class' => 'btn btn-default btn-lg btn-block']) ?>
		<b class="caret-line"></b>
	</div>
</div>

<div class="form-group form-group-lg">
	<h5>生日</h5>
	<?php echo form_input([
	    'name'             => 'birthday',
	    'class'            => 'form-control datepicker',
	    'placeholder'      => '',
	    'data-date-format' => 'yy-mm-dd',
	    'data-provides'    => 'boone.field_type.datetime',
	    'value'            => $this->currentUser->birthday ?: date('Y-m-d'),
	]) ?>
</div>

<script type="text/javascript" src="/resources/site/script/jquery/datepicker.js"></script>
<script type="text/javascript" src="/resources/site/script/jquery/dateinit.js"></script>