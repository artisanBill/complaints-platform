<div class="form-group form-group-lg">
	<h5>博客网址</h5>
	<small>请填写博客网址, 如果有.</small>
	<p class="help-block">
        <span class="text-warning">
            <i class="fa fa-warning "></i>
            其它如淘宝、公司、商城、项目以盈利为主的网址会导致您的账户被冻结.
        </span>
    </p>
	<?php echo form_input([
		'rows'			=> 5,
		'name'			=>'website', 
		'class'			=> 'form-control', 
		'placeholder'	=> '您的网址', 
		'value'			=> $this->currentUser->website,
		]) ?>
</div>

<div class="form-group form-group-lg">
	<h5>工作</h5>
	<small>当前从事相关工作!</small>
	<?php echo form_input([
		'name'			=>'job', 
		'class'			=> 'form-control', 
		'value'			=> $this->currentUser->job
		]) ?>
</div>

<div class="form-group form-group-lg">
	<h5>简介</h5>
	<small>您的签名, 公开显示资料!</small>
	<?php echo form_textarea([
		'rows'			=> 5,
		'name'			=>'bio',
		'row'			=> 4,
		'class'			=> 'form-control', 
		'value'			=> $this->currentUser->bio,
		]) ?>
</div>