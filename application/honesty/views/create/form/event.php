<link rel="stylesheet" type="text/css" href="/resources/site/stylesheet/datepicker.css">
<div class="form-group form-group-lg">
	<h5>投诉类别 <small class="text-danger">*</small></h5>
	<small>您在那些类别发生的事件 ?</small>
	<div class="select-group">
		<?php echo form_dropdown('eventType', complainType(), '', ['class' => 'btn btn-default btn-lg btn-block']) ?>
		<b class="caret-line"></b>
	</div>
</div>
<hr>

<div class="form-group form-group-lg">
	<h5>网址</h5>
	<small>如该时间是在互联网发生的, 请输入网址. </small>
	<?php echo form_input([
    'name'        => 'siteUrl',
    'class'       => 'form-control',
    'placeholder' => '请正确输入网址. 如 : http://boone.ren',
    'value'       => '',
]) ?>
</div>
<hr>

<div class="form-group form-group-lg">
	<h5>事件发生的地区 <small class="text-danger">*</small></h5>
	<small>请正确选择地区 ?</small>
	<div class="select-group">
		<?php echo form_dropdown('eventRegion', regionList(), '', ['class' => 'btn btn-default btn-lg btn-block']) ?>
		<b class="caret-line"></b>
	</div>
</div>
<hr>

<div class="form-group form-group-lg">
	<h5>事件状态 <small class="text-danger">*</small></h5>
	<small>除了曝光之外，您可能已经做了以下操作 ?</small>
	<div class="select-group">
		<?php echo form_dropdown('eventActive', currentCaseActive(), '', ['class' => 'btn btn-default btn-lg btn-block']) ?>
		<b class="caret-line"></b>
	</div>
</div>
<hr>

<div class="form-group form-group-lg">
	<h5>回执</h5>
	<small>如您已经报案, 请输入案件回执! 其他选项请忽略. </small>
	<?php echo form_input([
    'name'        => 'casesReceipt',
    'class'       => 'form-control',
    'placeholder' => '',
    'value'       => '',
]) ?>
</div>
<hr>

<div class="form-group form-group-lg">
	<h5>涉及金额 <small class="text-danger">*</small></h5>
	<small>单价以“人民币（元）”, 保留两位小数. </small>
	<?php echo form_input([
    'name'        => 'involveAmount',
    'class'       => 'form-control',
    'placeholder' => '比如:100.00',
    'value'       => '',
]) ?>
</div>
<hr>

<div class="form-group form-group-lg">
	<h5>发生时间 <small class="text-danger">*</small></h5>
	<?php echo form_input([
    'name'             => 'eventDateOn',
    'class'            => 'form-control datepicker',
    'placeholder'      => '',
    'data-date-format' => 'yy-mm-dd',
    'data-provides'    => 'boone.field_type.datetime',
    'value'            => date('Y-m-d'),
]) ?>
</div>

<script type="text/javascript" src="/resources/site/script/jquery/datepicker.js"></script>
<script type="text/javascript" src="/resources/site/script/jquery/dateinit.js"></script>